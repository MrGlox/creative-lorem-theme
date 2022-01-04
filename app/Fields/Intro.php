<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Intro extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $intro = new FieldsBuilder('intro');

        $intro
            ->setLocation('page_template', '==', 'page-about.blade.php')
            ->or('post_type', '==', 'post');

        $intro
            ->addTab('general_tab', [
                'label' => 'Général'
            ])
            ->addText('title', [
                'label' => 'Titre principal',
                'required' => 1,
            ])
            ->addWysiwyg('content', [
                'label' => 'Contenu',
                'required' => 1,
                'delay' => 0,
            ])
            ->addImage('image', [
                'label' => 'Image',
                'conditional_logic' => [],
            ]);

        $intro
            ->addTab('list_tab', [
                'label' => 'Liste de liens'
            ])
            ->addRepeater('list', [
                'label' => 'Liste',
                'button_label' => 'Ajouter un lien',
            ])
            ->addLink('link', [
                'label' => 'Lien',
                'required' => 1,
                'return_format' => 'array',
            ])
            ->endRepeater();

        return $intro->build();
    }
}
