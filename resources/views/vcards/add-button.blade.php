<div class="card-toolbar custom-toolbar ms-auto">
    <div class="d-flex justify-content-end">
        @if (count($this->getSelected()) > 0)
        <a href="javascript:void(0)" wire:click.prevent="bulkDelete" wire:key="bulk-action-bulkDelete"
        class="btn btn-danger me-2 ms-0 ms-md-2 mb-md-2 mb-2 mb-sm-2 mb-lg-0 delete-selected-users">{{__('messages.vcard.delete_multiple')}}</a>
        @endif
    </div>
</div>

@if(checkTotalVcard())
<div class="card-toolbar custom-toolbar ms-auto">
    <div class="d-flex justify-content-end">
        <a type="button" class="btn btn-primary" href="{{ route('vcards.create')}}">{{__('messages.vcard.new_vcard')}}</a>
    </div>
</div>
@endif

