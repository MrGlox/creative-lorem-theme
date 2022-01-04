<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Contact extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $contact = new FieldsBuilder('contact');

        $contact
            ->setLocation('page_template', '==', 'page-contact.blade.php');

        $contact
            ->addTab('general_tab', [
                'label' => 'Général'
            ])
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
            ]);

        $contact
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

        $contact
            ->addTab('social_tab', [
                'label' => 'Liens réseaux'
            ])
            ->addRepeater('socials', ['button_label' => 'Ajouter un réseau',])
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

        return $contact->build();
    }
}
