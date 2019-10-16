<?php namespace Lwv\BlockTextExtension\Block\Form;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class BlockFormSections
 *
 * @package Lwv\BlockTextExtension\Block\Form
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
                                    if (in_array($field->getField(),['css'])) {
                                        return false;
                                    }
                                    return true;
                                }
                            )
                        );
                    }
                ],
                'layout' => [
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
                ],
            ]
        );
    }
}
