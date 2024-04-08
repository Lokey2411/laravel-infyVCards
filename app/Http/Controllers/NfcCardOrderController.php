<?php

namespace App\Http\Controllers;

use App\Models\NfcOrders;
use App\Models\NfcCardOrder;

class NfcCardOrderController extends Controller
{
    public function index()
    {
        return view('sadmin.nfc_card_order.index');
    }

    public function show($nfcOrder)
    {
        $nfcCardOrder = NfcOrders::with('nfcTransaction','vcard','nfcCard','nfcPaymentType')->select('*')->findOrFail($nfcOrder);

        return view('sadmin.nfc_card_order.show', compact('nfcCardOrder'));
    }
}



