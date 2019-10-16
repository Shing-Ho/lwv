<?php namespace Lwv\BlockHeaderExtension\Image\Form;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class ImageFormSections
 *
 * @package Lwv\BlockHeaderExtension\Image\Form
 */
class ImageFormSections
{

    /**
     * Handle the form sections
     * 
     * @param ImageFormBuilder $builder
     */
    public function handle(ImageFormBuilder $builder)
    {
        $builder->setSections(
            [
                'general' => [
                    'title'  => 'Image Fields',
                    'fields' => function (ImageFormBuilder $builder) {
                        return array_map(
                            function (FieldType $field) {
                                return $field->getField();
                            },
                            array_filter(
                                $builder->getFormFields()->base()->all(),
                                function (FieldType $field) {
                                    //if (in_array($field->getField(),['link_url','link_target','link_class'])) {
                                    //    return false;
                                    //}
                                    return true;
                                }
                            )
                        );
                    }
                ],
            ]
        );
    }
}
