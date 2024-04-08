<div>
    <div class="dropdown d-flex align-items-center me-4 me-md-5">
        <button class="btn btn btn-icon btn-primary text-white dropdown-toggle hide-arrow ps-2 pe-0" type="button"
            id="dropdownMenuButton1" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false">
            <i class='fas fa-filter'></i>
        </button>
        <div class="dropdown-menu py-0" aria-labelledby="dropdownMenuButton1">
            <div class="text-start border-bottom py-4 px-7">
                <h3 class="text-gray-900 mb-0">{{ __('messages.common.filter') }}</h3>
            </div>
            <div class="p-5">
                <div class="mb-5">
                    <label for="exampleInputSelect2" class="form-label">{{ __('messages.vcard.verified') }}</label>
                    {{ Form::select('type', [2 => 'Select Verified'] + App\Models\Vcard::STATUS_ARR, null, ['class' => 'form-control form-select', 'data-control' => 'select2', 'id' => 'verified', 'wire:ignore']) }}
                </div>
                <div class="mb-5">
                    <label for="exampleInputSelect2" class="form-label">{{ __('messages.vcard.status') }}</label>
                    {{ Form::select('type', [2 => 'Select Status'] + App\Models\Vcard::STATUS, null, ['class' => 'form-control form-select', 'data-control' => 'select2', 'id' => 'status', 'wire:ignore']) }}
                </div>
                <div class="d-flex justify-content-end">
                    <button type="reset" id="vcardResetFilter"
                        class="btn btn-secondary">{{ __('messages.common.reset') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
