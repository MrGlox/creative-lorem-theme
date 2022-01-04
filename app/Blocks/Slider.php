<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Slider extends Block
{
    /**
     * The block id.
     *
     * @var string
     */
    public $slug = 'slider';

    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Slider';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Un bloc pour slider';

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
    public $icon = 'format-gallery';

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
    public $example = [];

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'title' => $this->title(),
            'slider' => $this->slider(),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $slider = new FieldsBuilder('slider');

        $slider
            ->addText('title', [
                'label' => 'Titre principal',
                'required' => 1,
            ])
            ->addRepeater('slider', [
                'button_label' => 'Ajouter une slide',
                'min' => 1,
            ])
            ->addText('subtitle', [
                'label' => 'Titre de la slide',
                'required' => 1,
            ])
            ->addText('type', [
                'label' => 'Catégorie',
                'required' => 0,
            ])
            ->addText('label', [
                'label' => 'Label',
                'instructions' => 'Label dans les puces de slide',
                'required' => 1,
            ])
            ->addWysiwyg('content', [
                'label' => 'Contenu',
                'required' => 1,
                'delay' => 0,
            ])
            ->addImage('image', [
                'label' => 'Image',
            ])
            ->addColorPicker('color', [
                'label' => 'Color',
                'instructions' => 'Couleur au dessus de l\'image',
                'default_value' => '#8800FF',
            ])
            ->endRepeater();

        return $slider->build();
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
     * Return the items field.
     *
     * @return array
     */
    public function slider()
    {
        return get_field('slider') ?: $this->example['slider'];
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
