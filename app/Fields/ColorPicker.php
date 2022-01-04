<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ColorPicker extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $colorPicker = new FieldsBuilder('color');

        $colorPicker
            ->setLocation('post_type', '==', 'post');

        $colorPicker
            ->addColorPicker('overflow_color', [
                'label' => 'Couleur',
                'instructions' => 'Couleur de l\'overlay en dégradé',
                'default_value' => '#8800FF',
            ]);

        return $colorPicker->build();
    }
}
