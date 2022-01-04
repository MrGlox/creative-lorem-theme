<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ColumnEntry extends Block
{
    /**
     * The block slug.
     *
     * @var string
     */
    public $slug = 'column-entry';

    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Contenu en colonne';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Un bloc avec deux entrées dont une en surbrillance';

    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'formatting';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'text';

    /**
     * The block keywords.
     *
     * @var array
     */
    public $keywords = [];

    /**
     * The block post type allow list.
     *
     * @var array
     */
    public $post_types = [];

    /**
     * The parent block type allow list.
     *
     * @var array
     */
    public $parent = [];

    /**
     * The default block mode.
     *
     * @var string
     */
    public $mode = 'edit';

    /**
     * The default block alignment.
     *
     * @var string
     */
    public $align = '';

    /**
     * The default block text alignment.
     *
     * @var string
     */
    public $align_text = '';

    /**
     * The default block content alignment.
     *
     * @var string
     */
    public $align_content = '';

    /**
     * The supported block features.
     *
     * @var array
     */
    public $supports = [
        'align' => true,
        'align_text' => false,
        'align_content' => false,
        'mode' => false,
        'multiple' => true,
        'jsx' => true,
    ];

    /**
     * The block preview example data.
     *
     * @var array
     */
    public $example = [
        'title' => 'Title',
        'content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cumque inventore eaque illum? Nam corporis voluptate incidunt suscipit libero repellendus inventore ipsum eum cum a illum alias recusandae, ab similique ducimus?',
        'content_highlight' => []
    ];

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'title' => $this->title(),
            'content' => $this->content(),
            'content_highlight' => $this->content_highlight()
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $entryColumn = new FieldsBuilder('entryColumn');

        $entryColumn
            ->addText('title', [
                'label' => 'Titre principal',
                'required' => 1,
            ])
            ->addWysiwyg('content', [
                'label' => 'Contenu',
                'required' => 1,
                'delay' => 0,
            ])
            ->addWysiwyg('content_highlight', [
                'label' => 'Contenu en surbrillance',
                'required' => 1,
                'delay' => 0,
            ]);

        return $entryColumn->build();
    }

    /**
     * Return the title field.
     *
     * @return string
     */
    public function title()
    {
        return get_field('title') ?: $this->example['title'];
    }

    /**
     * Return the content field.
     *
     * @return string
     */
    public function content()
    {
        return get_field('content') ?: $this->example['content'];
    }

    /**
     * Return the content_highlight field.
     *
     * @return array
     */
    public function content_highlight()
    {
        return get_field('content_highlight') ?: $this->example['content_highlight'];
    }

    /**
     * Assets to be enqueued when rendering the block.
     *
     * @return void
     */
    public function enqueue()
    {
        //
    }
}
