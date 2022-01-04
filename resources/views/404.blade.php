@extends('layouts.app')

@section('content')
  {{-- @include('partials.page-header') --}}

  <section class="section section--hero hero">
      <div class="container">
          <article class="hero__content">
              <main class="hero__main">
                  <div class="hero__heading circle">
                      <span class="hero__title hero__title--sub">Nothing to see here</span>
                      <h1 class="hero__title">Are you lost ?<br/>Try somewhere else<br/>We have plenty of space</h1>
                  </div>
                  <div class="hero__gradient js-gradient" data-direction="horizontal" data-opacity="0.33"></div>
                  <div class="hero__background js-background"></div>
              </main>
              <footer class="hero__footer">
                <ul class="hero__blob-list">
                    <li class="hero__blob-item">
                        <div class="hero__blob-item-content">
                            <a href="{{ home_url('/') }}" class="hero__blob-item-link">
                              Back to Earth
                            </a>
                            <div class="hero__blob-item-blob js-blob" data-color="@sub('color')"></div>
                        </div>
                    </li>
                    <li class="hero__blob-item">
                        <div class="hero__blob-item-content">
                            <a href="http://morgan-leroux.com" target="_blank" rel="noopener noreferrer" class="hero__blob-item-link">
                              Who made it ?
                            </a>
                            <div class="hero__blob-item-blob js-blob" data-color="@sub('color')"></div>
                        </div>
                    </li>
                    <li class="hero__blob-item">
                      <div class="hero__blob-item-content">
                          <a href="{{ get_permalink( get_option( 'page_for_posts' ) ) }}" class="hero__blob-item-link">
                            Let's explore !
                          </a>
                          <div class="hero__blob-item-blob js-blob" data-color="@sub('color')"></div>
                      </div>
                  </li>
                </ul>
            </footer>
          </article>
      </div>
  </section>
@endsection
