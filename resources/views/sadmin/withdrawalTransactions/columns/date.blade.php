<div>
    <span class="badge bg-secondary me-2">
        {{ Carbon\Carbon::parse($row->created_at)->isoFormat('Do MMM, YYYY') }}
    </span>
</div>
