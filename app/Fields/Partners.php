<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Partners extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $partners = new FieldsBuilder('partners');

        $partners
            ->setLocation('page', '==', get_option('page_for_posts'));

        $partners
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
            ]);

        $partners
            ->addTab('list', [
                'label' => 'Liste de pictos'
            ])
            ->addRepeater('companies', [
                'label' => 'Liste',
                'button_label' => 'Ajouter un lien',
            ])
            ->addImage('logo', [
                'label' => 'Image',
                'required' => 1,
                'return_format' => 'array',
            ])
            ->addLink('link', [
                'label' => 'Lien',
                'return_format' => 'array',
            ])
            ->endRepeater();

        return $partners->build();
    }
}
