<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Advantages extends Block
{
    /**
     * The block id.
     *
     * @var string
     */
    public $slug = 'advantages';

    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Avantages';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Un block de liste de données';

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
    public $icon = 'editor-ul';

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
        'items' => [
            ['item' => 'Item one'],
            ['item' => 'Item two'],
            ['item' => 'Item three'],
        ],
    ];

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'items' => $this->items(),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $advantages = new FieldsBuilder('advantages');

        $advantages
            ->addText('title', [
                'label' => 'Titre principal',
                'required' => 1,
            ])
            ->addRepeater('list', [
                'label' => 'Liste de données',
                'button_label' => 'Ajouter une donnée',
                'min' => 1,
            ])
            ->addText('pre_value', [
                'label' => 'Préfix',
            ])
            ->addText('value', [
                'label' => 'Valeur',
                'required' => 1,
            ])
            ->addText('post_value', [
                'label' => 'Sufixe',
            ])
            ->addText('label', [
                'label' => 'Intitulé',
                'required' => 1,
            ])
            ->endRepeater();

        return $advantages->build();
    }

    /**
     * Return the items field.
     *
     * @return array
     */
    public function items()
    {
        return get_field('items') ?: $this->example['items'];
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
