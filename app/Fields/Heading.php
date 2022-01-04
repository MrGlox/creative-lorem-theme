<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Heading extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $heading = new FieldsBuilder('heading');

        $heading
            ->setLocation('page', '==', get_option('page_for_posts'));

        $heading
            ->addText('archive_title', [
                'label' => 'Titre d\'entrée de liste',
                'required' => 1,
            ])
            ->addWysiwyg('archive_description', [
                'label' => 'Description',
            ]);

        return $heading->build();
    }
}
