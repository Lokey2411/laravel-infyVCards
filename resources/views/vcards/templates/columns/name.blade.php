<div class="d-flex align-items-center">
    <a href="/{{ $row->name }}" target="_blank">
        <div class="image image-circle image-mini me-3">
            <img src="{{$row->template_url}}" alt="user" class="user-img">
        </div>
    </a>
    <div class="d-flex flex-column">
        <a href="/{{ $row->name }}" target="_blank" class="mb-1 text-decoration-none fs-6">
            {{$row->name}}
        </a>
    </div>
</div>
