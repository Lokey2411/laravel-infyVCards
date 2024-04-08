<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AppointmentTransaction;
use App\Models\Currency;
use App\Models\Transaction;
use App\Models\Vcard;
use App\Repositories\AppointmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;
use Unicodeveloper\Paystack\Facades\Paystack;

class UserPaystackController extends Controller
{

    public function handleGatewayCallback(Request $request)
    {
        $userId = session()->get('vcard_user_id');
        $currencyCode = Currency::whereId(getUserSettingValue('currency_id', $userId))->first();
        $clientId = getSelectedPaymentGateway('paystack_key');
        $clientSecret = getSelectedPaymentGateway('paystack_secret');
        config([
            'paystack.publicKey' => $clientId,
            'paystack.secretKey' => $clientSecret,
            'paystack.paymentUrl' => "https://api.paystack.co",
            'paystack.merchantEmail' => 'krupalinfyom@gmail.com',
        ]);

            $response = Paystack::getPaymentData();
            $tenantId = session()->get('tenant_id');
            $amount = $response['data']['requested_amount']/100;
            $currencyCode = $response['data']['currency'];
            $currencyId = Currency::whereCurrencyCode($currencyCode)->first()->id;
            $transactionId = $response['data']['id'];
            $vcardId = $response['data']['metadata']['vcard_id'];
            $vcard = Vcard::with('tenant.user')->where('id', $vcardId)->first();

        $transactionDetails = [
            'vcard_id' => $vcardId,
            'transaction_id' => $transactionId,
            'currency_id' => $currencyId,
            'amount' => $amount,
            'tenant_id' => $tenantId,
            'type' => Appointment::PAYSTACK,
            'status' => Transaction::SUCCESS,
            'meta' => json_encode($response),
        ];

        $appointmentTran = AppointmentTransaction::create($transactionDetails);
        $appointmentInput = session()->get('appointment_details');
        session()->forget('appointment_details');
        $appointmentInput['appointment_tran_id'] = $appointmentTran->id;
        $appointmentInput['vcard_id'] = $vcardId;
        /** @var AppointmentRepository $appointmentRepo */
        $appointmentRepo = App::make(AppointmentRepository::class);
        $vcardEmail = is_null($vcard->email) ? $vcard->tenant->user->email : $vcard->email;
        $appointmentRepo->appointmentStoreOrEmail($appointmentInput, $vcardEmail);

        session()->forget(['vcard_user_id', 'tenant_id', 'vcard_id']);

        Flash::success(__('messages.placeholder.payment_done'));
        App::setLocale(session::get('languageChange_'. $vcard->url_alias));

        return redirect(route('vcard.show', [$vcard->url_alias, __('messages.placeholder.appointment_created')]));

    }
}
