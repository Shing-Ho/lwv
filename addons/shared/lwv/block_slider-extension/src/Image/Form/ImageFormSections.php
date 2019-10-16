<?php namespace Lwv\BlockSliderExtension\Image\Form;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class ImageFormSections
 *
 * @package Lwv\BlockSliderExtension\Image\Form
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
                                    if (in_array($field->getField(),['overlay','link_url','link_target','modal_image','modal_body'])) {
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
                                    if (in_array($field->getField(),['overlay','link_url','link_target','modal_image','modal_body'])) {
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
