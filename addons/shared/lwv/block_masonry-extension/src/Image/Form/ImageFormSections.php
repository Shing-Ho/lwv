<?php namespace Lwv\BlockMasonryExtension\Image\Form;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class ImageFormSections
 *
 * @package Lwv\BlockMasonryExtension\Image\Form
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
                                    if (in_array($field->getField(),['link_url','link_target','body','modal_image'])) {
                                        return false;
                                    }
                                    return true;
                                }
                            )
                        );
                    }
                ],
                'layout' => [
                    'title'  => 'Layout Specific Fields',
                    'fields' => function (ImageFormBuilder $builder) {
                        return array_map(
                            function (FieldType $field) {
                                return $field->getField();
                            },
                            array_filter(
                                $builder->getFormFields()->base()->all(),
                                function (FieldType $field) {
                                    if (in_array($field->getField(),['link_url','link_target','body','modal_image'])) {
                                        return true;
                                    }
                                    return false;
                                }
                            )
                        );
                    }
                ],
            ]
        );
    }
}
