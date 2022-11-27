<header class="banner">
  <a class="brand" href="{{ home_url('/') }}">
    {!! $siteName !!}
  </a>

  @if ($primaryMenu)
    @foreach($topMenu as $item)
      <li class="ms-md-6 ms-xl-8 font-weight-bold mb-6 mb-md-0 text-center">
        <a aria-current="page" href="{{ $item->url }}"
            title="{{ $item->title }}"
            target="{{ $item->target }}">
          {{ $item->title }}
        </a>
      </li>
    @endforeach
  @endif
</header>
