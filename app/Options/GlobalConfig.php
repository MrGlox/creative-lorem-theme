<?php

namespace App\Options;

use Log1x\AcfComposer\Options as Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class GlobalConfig extends Field
{
    /**
     * The option page menu name.
     *
     * @var string
     */
    public $slug = 'global-config';

    /**
     * The option page menu name.
     *
     * @var string
     */
    public $name = 'Config';

    /**
     * The option page document title.
     *
     * @var string
     */
    public $title = 'Configuration globale';

    /**
     * The option page field group.
     *
     * @return array
     */
    public function fields()
    {
        $globalConfig = new FieldsBuilder('global_config');

        $globalConfig
            ->addTab('general_tab', [
                'label' => 'Liens réseaux'
            ])
            ->addRepeater('socials', ['label' => 'Réseaux sociaux'])
            ->addSelect('icon', [
                'label' => 'Icon',
                'required' => 1,
                'choices' => ['dribbble', 'instagram', 'twitter', 'linkedin'],
                'default_value' => [],
                'allow_null' => 0,
                'return_format' => 'value',
            ])
            ->addLink('link', [
                'label' => 'Lien',
                'required' => 1,
                'return_format' => 'array',
            ])
            ->endRepeater();

        return $globalConfig->build();
    }
}
