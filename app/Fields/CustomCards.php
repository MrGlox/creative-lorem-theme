<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class CustomCards extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $customCards = new FieldsBuilder('customCards');

        $customCards
            ->setLocation('page', '==', get_option('page_for_posts'));

        $customCards
            ->addRepeater('cards', [
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
            ->addColorPicker('color', [
                'label' => 'Couleur',
                'instructions' => 'Couleur de l\'overlay en dégradé',
                'default_value' => '#8800FF',
            ])
            ->endRepeater();

        return $customCards->build();
    }
}
