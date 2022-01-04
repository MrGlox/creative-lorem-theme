<section class="section section--intro intro">
    <div class="container">
        <article class="intro__content">
            @if(function_exists('yoast_breadcrumb'))
            {!! yoast_breadcrumb( '<p class="intro__title intro__title--sub breadcrumbs" id="breadcrumbs">','</p>' ) !!}
            @endif
            <main class="intro__main">
                <div class="intro__heading">
                    <h1 class="intro__title">@field('title')</h1>
                    <div class="intro__text">@field('content')</div>
                </div>
            </main>
            @hasfield('image')
            <div class="intro__aside">
                <img class="js-image" data-src="@field('image', 'url')" alt="@field('image', 'alt')" />
            </div>
            @endfield
            @hasfield('list')
            <footer class="intro__footer">
                <ul class="intro__list">
                    @fields('list')
                    @if($loop->first)
                    <li class="intro__item">
                        <a class="intro__link intro__link--active" href="@sub('link', 'url')"
                            target="@sub('link', 'target')" rel="noopener noreferrer">
                            @sub('link', 'title')
                        </a>
                    </li>
                    @else
                    <li class="intro__item">
                        <a class="intro__link" href="@sub('link', 'url')" target="@sub('link', 'target')"
                            rel="noopener noreferrer">
                            @sub('link', 'title')
                        </a>
                    </li>
                    @endif
                    @endfields
                </ul>
            </footer>
            @endfield
            <div class="intro__background js-background"></div>
            <div class="intro__gradient js-gradient" data-direction="horizontal" data-opacity="0.33"></div>
        </article>
    </div>
</section>