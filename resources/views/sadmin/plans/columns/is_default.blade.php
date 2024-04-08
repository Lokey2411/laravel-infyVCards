@if ($row->is_default == \App\Models\Plan::IS_DEFAULT)
<span class="badge bg-light-success">{{ __('messages.plan.default_Plan') }}<span>
    @else
        <div class="form-check form-switch">
            <input class="form-check-input is_default " type="checkbox" name="is_default"
                data-id="{{ $row->id }}">
        </div>
@endif
