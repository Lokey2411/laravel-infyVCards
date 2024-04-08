<div>
    <span class="badge {{ $row->is_expired ? 'bg-danger' : 'bg-secondary' }}  me-2">
        {{ \Carbon\Carbon::parse($row->expire_at)->format('jS M, Y') }}
    </span>
</div>
