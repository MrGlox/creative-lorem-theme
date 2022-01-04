<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Skills extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $skills = new FieldsBuilder('skills');

        $skills
            ->setLocation('page_template', '==', 'page-skills.blade.php');

        $skills
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

        $skills
            ->addTab('list_tab', [
                'label' => 'Liste de données'
            ])
            ->addRepeater('list', [
                'label' => 'Liste',
                'button_label' => 'Ajouter une donnée',
            ])
            ->addText('number', [
                'label' => 'Nombre',
                'required' => 1,
            ])
            ->addWysiwyg('content', [
                'label' => 'Contenu',
                'required' => 1,
            ])
            ->endRepeater();

        return $skills->build();
    }
}
