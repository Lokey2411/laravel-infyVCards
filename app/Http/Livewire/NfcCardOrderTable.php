<?php

namespace App\Http\Livewire;

use App\Models\Nfc;
use App\Http\Livewire\LivewireTableComponent;
use App\Models\NfcCardOrder;
use App\Models\NfcOrders;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class NfcCardOrderTable extends LivewireTableComponent
{
    protected $model = NfcOrders::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('created_at', 'desc');
        $this->setPerPage(10);


        $this->setThAttributes(function (Column $column) {
            if ($column->isField('id') && $column->isField('id')) {
                return [
                    'class' => 'text-center',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.common.user'), "name")->searchable()->sortable(),
            Column::make(__('messages.nfc.nfc_card_type'), "nfcCard.name")->searchable()->sortable(),
            Column::make(__('messages.vcard.vcard_name'), "vcard.name")->searchable(),
            Column::make(__('messages.nfc.order_status'), "order_status")->view('sadmin.nfc_card_order.columns.order_status'),
            Column::make(__('messages.nfc.payment_status'), "nfcTransaction.status")->searchable()->sortable()->view('sadmin.nfc_card_order.columns.payment_status'),
            Column::make(__('messages.vcard.created_at'), "created_at")->sortable(),
            Column::make(__('messages.common.action'), "id")->view('sadmin.nfc_card_order.columns.action'),
        ];
    }

    public function builder(): Builder
    {
        return NfcOrders::with('nfcTransaction', 'vcard', 'nfcCard')->select('nfc_orders.*');

    }
}
