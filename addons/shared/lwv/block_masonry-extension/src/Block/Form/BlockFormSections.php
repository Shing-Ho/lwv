<?php namespace Lwv\BlockMasonryExtension\Block\Form;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class BlockFormSections
 *
 * @package Lwv\BlockMasonryExtension\Block\Form
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
                                    if (in_array($field->getField(),['css','images','filters','filter_default'])) {
                                        return false;
                                    }
                                    return true;
                                }
                            )
                        );
                    }
                ],
                'filters' => [
                    'title'  => 'Filters',
                    'fields' => function (BlockFormBuilder $builder) {
                        return array_map(
                            function (FieldType $field) {
                                return $field->getField();
                            },
                            array_filter(
                                $builder->getFormFields()->base()->all(),
                                function (FieldType $field) {
                                    if (in_array($field->getField(),['filters','filter_default'])) {
                                        return true;
                                    }
                                    return false;
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
                                    if (in_array($field->getField(),['images'])) {
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
