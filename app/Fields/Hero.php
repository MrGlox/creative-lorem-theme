<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Hero extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $hero = new FieldsBuilder('hero');

        $hero
            ->setLocation('page_type', '==', 'front_page');

        $hero
            ->addTab('general_tab', [
                'label' => 'Général'
            ])
            ->addText('subtitle', [
                'label' => 'Titre secondaire',
                'instructions' => 'Titre au dessus du titre principal',
                'required' => 1,
            ])
            ->addWysiwyg('title', [
                'label' => 'Titre principal',
                'required' => 1,
                'delay' => 0,
            ]);

        $hero
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

        return $hero->build();
    }
}
