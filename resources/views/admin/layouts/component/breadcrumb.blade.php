<nav class="mt-2" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $name => $url)
            @if ($loop->last)
                <li class="breadcrumb-item active fw-bold" aria-current="page">{{ is_numeric($name) ? $url : $name }}</li>
            @else
                <li class="breadcrumb-item fw-bold">
                    <a href="{{ is_numeric($name) ? '#' : $url }}">{{ is_numeric($name) ? $url : $name }}</a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>