<?php namespace Lwv\BlockSliderExtension\Block\Form;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class BlockFormSections
 *
 * @package Lwv\BlockSliderExtension\Block\Form
 */
class BlockFormSections
{

    /**
     * Handle the form sections
     * 
     * @param BlockFormBuilder $builder
     */
    public function handle(BlockFormBuilder $builder)
    {
        $builder->setSections(
            [
                'general' => [
                    'title'  => 'Block Fields',
                    'fields' => function (BlockFormBuilder $builder) {
                        return array_map(
                            function (FieldType $field) {
                                return $field->getField();
                            },
                            array_filter(
                                $builder->getFormFields()->base()->all(),
                                function (FieldType $field) {
                                    if (in_array($field->getField(),['css','images','animation','widescreen','desktop','tablet','phone','autoscroll','arrows','dots','infinite','width'])) {
                                        return false;
                                    }
                                    return true;
                                }
                            )
                        );
                    }
                ],
                'images' => [
                    'title'  => 'Images',
                    'fields' => function (BlockFormBuilder $builder) {
                        return array_map(
                            function (FieldType $field) {
                                return $field->getField();
                            },
                            array_filter(
                                $builder->getFormFields()->base()->all(),
                                function (FieldType $field) {
                                    if (in_array($field->getField(),['images','animation'])) {
                                        return true;
                                    }
                                    return false;
                                }
                            )
                        );
                    }
                ],
                'slider' => [
                    'title'  => 'Slider Settings',
                    'fields' => function (BlockFormBuilder $builder) {
                        return array_map(
                            function (FieldType $field) {
                                return $field->getField();
                            },
                            array_filter(
                                $builder->getFormFields()->base()->all(),
                                function (FieldType $field) {
                                    if (in_array($field->getField(),['width','autoscroll','arrows','dots','infinite'])) {
                                        return true;
                                    }
                                    return false;
                                }
                            )
                        );
                    }
                ],
                'responsive'  => [
                    'title'  => 'Responsive Settings',
                    'fields' => function (BlockFormBuilder $builder) {
                        return array_map(
                            function (FieldType $field) {
                                return $field->getField();
                            },
                            array_filter(
                                $builder->getFormFields()->base()->all(),
                                function (FieldType $field) {
                                    if (in_array($field->getField(),['widescreen','desktop','tablet','phone'])) {
                                        return true;
                                    }
                                    return false;
                                }
                            )
                        );
                    }
                ],
                'css'  => [
                    'title'  => 'CSS',
                    'fields' => function (BlockFormBuilder $builder) {
                        return array_map(
                            function (FieldType $field) {
                                return $field->getField();
                            },
                            array_filter(
                                $builder->getFormFields()->base()->all(),
                                function (FieldType $field) {
                                    if (in_array($field->getField(),['css'])) {
                                        return true;
                                    }
                                    return false;
                                }
                            )
                        );
                    }
                ]
            ]
        );
    }
}
