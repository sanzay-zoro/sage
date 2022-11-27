<a class="sr-only focus:not-sr-only" href="#main">
  {{ __('Skip to content') }}
</a>


<div class="theme-app d-flex flex-column">
  <div class="theme-wrap position-relative">
    @include('sections.header')
    
    <main id="main" class="main">
      @yield('content')
    </main>
  </div>
  @include('sections.footer')
</div>
  
  @hasSection('sidebar')
    <aside class="sidebar">
      @yield('sidebar')
    </aside>
  @endif
