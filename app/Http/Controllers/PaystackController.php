<?php

namespace App\Http\Controllers;

use App\Models\AffiliateUser;
use App\Models\Plan;
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Utils\ResponseUtil;
use Illuminate\Http\Request;
use App\Repositories\SubscriptionRepository;
use AWS\CRT\HTTP\Response;
use Illuminate\Support\Facades\Mail;
use Exception;
use GeoIp2\Exception\HttpException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Stripe\Exception\ApiErrorException;
use Unicodeveloper\Paystack\Facades\Paystack;
use App\Mail\SubscriptionPaymentSuccessMail;

class PaystackController extends AppBaseController
{
    private SubscriptionRepository $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function redirectToGateway(Request  $request)
     {
        $clientId = getSelectedPaymentGateway('paystack_key');
        $clientSecret = getSelectedPaymentGateway('paystack_secret');
        config([
            'paystack.publicKey' => $clientId,
            'paystack.secretKey' => $clientSecret,
            'paystack.paymentUrl' => "https://api.paystack.co",
            'paystack.merchantEmail' => 'krupalinfyom@gmail.com',
        ]);
            $supportedCurrency = ['NGN', 'USD', 'GHS', 'ZAR', 'KES'];
            $plan = Plan::with('currency')->findOrFail($request->planId);

        if ($plan->currency->currency_code != null && !in_array(strtoupper($plan->currency->currency_code), getPayStackSupportedCurrencies())) {
            Flash::error(__('messages.placeholder.this_currency_is_not_supported_paystack'));
            return Redirect()->back();
        }
        $data = $this->subscriptionRepository->manageSubscription($request->all());

        if (!isset($data['plan'])) {
            if (isset($data['status']) && $data['status'] == true) {
                Flash::error(__('messages.subscription_pricing_plans.has_been_subscribed'));
                return Redirect()->back();
            } else {
                if (isset($data['status']) && $data['status'] == false) {
                    Flash::error(__('messages.placeholder.cannot_switch_to_zero'));
                    return Redirect()->back();
                }
            }
        }
        $subscriptionsPricingPlan = $data['plan'];
        $subscription = $data['subscription'];

        try {
            $request->merge([
                'email' => $request->user()->email,
                'orderID' => $subscription->id,
                'amount' => $data['amountToPay'] * 100,
                'quantity' => 1,
                'currency' => $plan->currency->currency_code,
                'reference' => Paystack::genTranxRef(),
                'metadata' => json_encode(['subscription_id' => $subscription->id]),
            ]);

            return Paystack::getAuthorizationUrl()->redirectNow();
        } catch (\Exception $e) {
            Flash::error(__('messages.setting.paystack_credential'));
            return Redirect()->back();
        }

    }

    public function handleGatewayCallback(Request $request)
    {
        $clientId = getSelectedPaymentGateway('paystack_key');
        $clientSecret = getSelectedPaymentGateway('paystack_secret');
        config([
            'paystack.publicKey' => $clientId,
            'paystack.secretKey' => $clientSecret,
            'paystack.paymentUrl' => "https://api.paystack.co",
            'paystack.merchantEmail' => 'krupalinfyom@gmail.com',
        ]);
        $response = Paystack::getPaymentData();
        $transactionID = $response['data']['id'];
        $transactionAmount = $response['data']['requested_amount'] / 100;
        $subscriptionId = $response['data']['metadata']['subscription_id'];

        try {
            Subscription::findOrFail($subscriptionId)->update([
                'payment_type' => Subscription::PAYSTACK,
                'status' => Subscription::ACTIVE
            ]);

            // De-Active all other subscription
            Subscription::whereTenantId(getLogInTenantId())
                ->where('id', '!=', $subscriptionId)
                ->where('status', '!=', Subscription::REJECT)
                ->update([
                    'status' => Subscription::INACTIVE,
                ]);

            $transaction = Transaction::create([
                'transaction_id' => $transactionID,
                'type' => Transaction::PAYSTACK,
                'amount' => $transactionAmount,
                'status' => Subscription::ACTIVE,
                'meta' => json_encode($response),
            ]);

            // updating the transaction id on the subscription table
            $subscription = Subscription::findOrFail($subscriptionId);
            $planName = $subscription->plan->name;
            $subscription->update(['transaction_id' => $transaction->id]);

            $affiliateAmount = getSuperAdminSettingValue('affiliation_amount');
            AffiliateUser::whereUserId(getLogInUserId())->where('amount', 0)->update(['amount' => $affiliateAmount]);

                $userEmail = getLogInUser()->email;
                $firstName = getLogInUser()->first_name;
                $lastName =  getLogInUser()->last_name;
                $emailData = [
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'planName' => $planName,
                ];
            Mail::to($userEmail)->send(new SubscriptionPaymentSuccessMail($emailData));

            return view('sadmin.plans.payment.paymentSuccess');
        } catch (HttpException $ex) {
            print_r($ex->getMessage());
        }
    }
}
