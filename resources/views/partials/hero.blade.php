@php
$title = get_field('title');
@endphp

<section class="section section--hero hero">
    <div class="container">
        <article class="hero__content">
            <main class="hero__main">
                <div class="hero__heading circle">
                    <span class="hero__title hero__title--sub">@field('subtitle')</span>
                    <h1 class="hero__title">{!! substr($title, 3, -5) !!}</h1>
                </div>
                <button class="hero__scroll">
                    @svg('images.icons.arrow-down', ['class' => 'icon'])
                </button>
                <div class="hero__gradient js-gradient" data-direction="horizontal" data-opacity="0.33"></div>
                <div class="hero__background js-background"></div>
            </main>
            @hasfield('list')
            <footer class="hero__footer">
                <ul class="hero__list">
                    @fields('list')
                    <li class="hero__item">
                        <a class="hero__link" href="@sub('link', 'url')" target="@sub('link', 'target')"
                            rel="noopener noreferrer">
                            @sub('link', 'title')
                        </a>
                    </li>
                    @endfields
                </ul>
            </footer>
            @endfield
        </article>
    </div>
</section>