<section id="{{ 'advantages-' . $block->block->id }}"
    class="section section--advantages advantages {{ $block->classes }}">
    <div class="container container--larger">
        <div class="advantages__container">
            <header class="advantages__header">
                <h2 class="advantages__title">
                    @field('title')
                </h2>
            </header>
            @hasfield('list')
            <main class="advantages__main">
                <ul class="advantages__list">
                    @fields('list')
                    <li class="advantages__item">
                        <div class="advantages__item-content">
                            <p class="advantages__item-data">
                                <span>@sub('pre_value')</span>
                                <span class="count-up">@sub('value')</span>
                                <span>@sub('post_value')</span>
                            </p>
                            <div class="advantages__item-blob js-blob" data-color="@sub('color')"></div>
                        </div>
                        <p class="advantages__item-label">
                            @sub('label')
                        </p>
                    </li>
                    @endfields
                </ul>
            </main>
            @endfield
        </div>
</section>