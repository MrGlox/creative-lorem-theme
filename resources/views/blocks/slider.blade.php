<section id="{{ 'slider-' . $block->block->id }}" class="section section--slider slider {{ $block->classes }}">
  <div class="container container--larger">
    <div class="slider__content">
      <header class="slider__header">
        <h2 class="slider__title slider__title--main">@field('title')</h2>
      </header>
      <div class="container">
        <article class="slider__article">
          <header class="slider__controls">
            <ul class="slider__dots">
              @fields('slider')
              <li class="slider__dots-item">
                <p class="slider__dots-index">{!! str_pad(get_row_index(), 2, '0', STR_PAD_LEFT) !!}</p>
                <p class="slider__dots-title">@sub('label')</p>
              </li>
              @endfields
            </ul>
            <div class="slider__arrows" data-glide-el="controls">
              <button class="slider__button slider__button--prev">
                @svg('images.icons.arrow-left', ['class' => 'slider__icon', 'icon'])
              </button>
              <button class="slider__button slider__button--next">
                @svg('images.icons.arrow-right', ['class' => 'slider__icon', 'icon'])
              </button>
            </div>
          </header>
          <main class="slider__main blur glide">
            <div class="glide__track" data-glide-el="track">
              <ul class="slider__list slider__list--content glide__slides">
                @fields('slider')
                <li class="slider__item glide__slide">
                  <span class="slider__title slider__title--index">
                    {!! str_pad(get_row_index(), 2, '0', STR_PAD_LEFT) !!}
                  </span>
                  <div class="slider__text">@sub('content')</div>
                </li>
                @endfields
              </ul>
            </div>
          </main>
          <aside class="slider__aside glide">
            <div class="glide__track" data-glide-el="track">
              <ul class="slider__list slider__list--media glide__slides">
                @fields('slider')
                <li class="glide__slide">
                  <div class="slider__item">
                    <img class="slider__media" src="@sub('image', 'url')" alt="@sub('image', 'alt')" />
                    <div class="slider__media-overlay js-overlay" data-color="@sub('color')">
                    </div>
                    <div class="slider__media-content">
                      @hassub('type')
                      <span class="slider__media-category">@sub('type')</span>
                      @endsub
                      <p class="slider__title slider__title--media">@sub('subtitle')</p>
                    </div>
                  </div>
                </li>
                @endfields
              </ul>
            </div>
          </aside>
        </article>
        <div class="slider__gradient js-gradient" data-direction="vertical" data-opacity="0.73"></div>
      </div>
      @svg('images.svg.pattern1', ['class' => 'slider__pattern'])
    </div>
  </div>
</section>