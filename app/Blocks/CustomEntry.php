<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class CustomEntry extends Block
{
    /**
     * The block id.
     *
     * @var string
     */
    public $slug = 'custom-entry';

    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Bloc contenu et image';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Une section avec un média et un texte';

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
        'image' => []
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
            'image' => $this->image()
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $entryMedia = new FieldsBuilder('entryMedia');

        $entryMedia
            ->addText('title', [
                'label' => 'Titre principal',
                'required' => 1,
            ])
            ->addWysiwyg('content', [
                'label' => 'Contenu',
                'required' => 1,
                'delay' => 0,
            ])
            ->addLink('link', [
                'label' => 'Bouton',
                'conditional_logic' => [],
            ])
            ->addImage('image', [
                'label' => 'Image',
                'conditional_logic' => [],
            ]);

        return $entryMedia->build();
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
     * Return the image field.
     *
     * @return array
     */
    public function image()
    {
        return get_field('image') ?: $this->example['image'];
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
