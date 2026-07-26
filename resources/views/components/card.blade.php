<div class="nx-card">

    @isset($title)
        <div class="nx-card-header">
            <div class="nx-card-title">
                {{ $title }}
            </div>
        </div>
    @endisset

    <div class="nx-card-body">
        {{ $slot }}
    </div>

</div>