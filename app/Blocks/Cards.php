<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Cards extends Block
{
    /**
     * The block id.
     *
     * @var string
     */
    public $slug = 'cards';

    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Cartes';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Un block de liste de cartes';

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
        $cards = new FieldsBuilder('cards');

        $cards
            ->addText('title', [
                'label' => 'Titre principal',
                'required' => 1,
            ])
            ->addText('subtitle', [
                'label' => 'Sous titre',
                'required' => 1,
            ])
            ->addRepeater('cards', [
                'label' => 'Liste de cartes',
                'button_label' => 'Ajouter une carte',
            ])
            ->addImage('image', [
                'label' => 'Image principale',
                'required' => 1,
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
            ])
            ->addColorPicker('color', [
                'label' => 'Couleur de l\'overlay en dégradé',
                'required' => 1,
                'default_value' => '#FF00A1',
            ])
            ->addRepeater('links', [
                'label' => 'Liste de liens',
                'button_label' => 'Ajouter un lien',
                'min' => 0,
                'max' => 3,
            ])
            ->addSelect('social', [
                'label' => 'Réseau social',
                'choices' => [
                    'Instagram',
                    'Linkedin',
                    'Medium',
                ],
                'required' => 1,
                'return_format' => 'value',
            ])
            ->addLink('link', [
                'label' => 'Lien',
                'return_format' => 'array',
            ])
            ->endRepeater()
            ->endRepeater();

        return $cards->build();
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
