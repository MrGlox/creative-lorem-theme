<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Contact extends Block
{
    /**
     * The block id.
     *
     * @var string
     */
    public $slug = 'contact';

    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Contact';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Le bloc de contact';

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
    public $icon = 'admin-site-alt';

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
        return [];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $contact = new FieldsBuilder('contact-block');

        $contact
            ->addText('title', [
                'label' => 'Titre principal',
                'required' => 1,
            ])
            ->addText('address_label', [
                'label' => 'Titre adresse',
                'required' => 1,
            ])
            ->addWysiwyg('address_content', [
                'label' => 'Contenu adresse',
                'required' => 1,
                'delay' => 0,
            ])
            ->addRepeater('coords', [
                'label' => 'Coordonnées',
                'button_label' => 'Ajouter une coordonnée',
                'min' => 1,
            ])
            ->addText('subtitle', [
                'label' => 'Titre',
                'required' => 1,
            ])
            ->addWysiwyg('content', [
                'label' => 'Contenu',
                'required' => 1,
                'delay' => 0,
            ])
            ->endRepeater();

        return $contact->build();
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
