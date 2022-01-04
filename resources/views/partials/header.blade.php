{{-- <div id="js-menu-trigger" class="menu-trigger" data-sticky-class="menu-trigger--sticky">
  <button type="button" id="js-menu-open" class="menu-trigger__open" aria-label="{{ __('Open menu', 'sage')}}">
@svg('images.icons.border', ['class' => 'menu-trigger__border'])
@svg('images.icons.burger', 'icon icon-menu menu-trigger__icon')
</button>
<button type="button" id="js-menu-close" class="menu-trigger__close" aria-label="{{ __('Close menu', 'sage')}}">
  @svg('images.icons.border', ['class' => 'menu-trigger__border'])
  @svg('images.icons.burger-close', 'icon icon-menu menu-trigger__icon')
</button>
</div> --}}

<header class="header header--sticky">
  <div class="container container--larger">
    <section class="header__content">
      <div class="header__brand brand">
        <a class="brand__link" href="{{ home_url('/') }}">
          @svg('images.svg.logo', ['class' => 'brand__logo'])
        </a>
      </div>
      <nav class="header__menu menu">
        @if (has_nav_menu('primary_navigation'))
        @include('partials.navigation')
        @endif
      </nav>
      <button class="header__icon">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </button>
    </section>
  </div>
</header>