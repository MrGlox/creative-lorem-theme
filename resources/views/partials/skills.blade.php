<section class="section section--skills skills">
    <div class="container">
        <article class="skills__content">
            @if(function_exists('yoast_breadcrumb'))
            {!! yoast_breadcrumb( '<p class="skills__title skills__title--sub breadcrumbs" id="breadcrumbs">','</p>' )
            !!}
            @endif
            <main class="skills__main">
                <div class="skills__heading">
                    <h1 class="skills__title">@field('title')</h1>
                    <div class="skills__text">@field('content')</div>
                </div>
            </main>
            @hasfield('image')
            <div class="skills__aside">
                <img class="js-image" data-src="@field('image', 'url')" alt="@field('image', 'alt')" />
            </div>
            @endfield
            @hasfield('list')
            <footer class="skills__footer">
                <ul class="skills__list">
                    @fields('list')
                    <li class="skills__item">
                        <div class="skills__number count-up">
                            @sub('number')
                        </div>
                        <div class="skills__legends">
                            @sub('content')
                        </div>
                    </li>
                    @endfields
                </ul>
            </footer>
            @endfield
            <div class="skills__background js-background"></div>
            <div class="skills__gradient js-gradient" data-direction="horizontal" data-opacity="0.33"></div>
        </article>
    </div>
</section>