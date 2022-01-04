<footer class="footer">
  <div class="container container--larger">
    <article class="footer__article">
      <header class="footer__header">
        <div class="footer__brand brand">
          <a class="brand__link" href="{{ home_url('/') }}">
            @svg('images.svg.logo', ['class' => 'brand__logo'])
          </a>
        </div>
        @hasoption('socials')
        <ul class="footer__socials">
          @options('socials')
          <li class="footer__socials-item">
            <a class="footer__socials-link" href="@sub('link', 'url')" target="_blank">
              {!! get_svg( 'images.icons.' . get_sub_field('icon'), ['icon', 'footer__socials-icon',
              'footer__socials-icon--' . get_sub_field('icon')]); !!}
            </a>
          </li>
          @endoptions
        </ul>
        @endoption
      </header>
      <div class="footer__content">
        <main class="footer__main">
          <ul class="footer__columns">
            @php(dynamic_sidebar('sidebar-column-1'))
            @php(dynamic_sidebar('sidebar-column-2'))
            @php(dynamic_sidebar('sidebar-column-3'))
            @php(dynamic_sidebar('sidebar-column-4'))
          </ul>
        </main>
      </div>
    </article>
    <article class="footer__inline">
    @php(dynamic_sidebar('sidebar-footer-low'))
    </article>
  </div>
</footer>