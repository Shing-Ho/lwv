<?php namespace Lwv\DataModule\Faq\Form;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class FaqFormSections
 *
 * @package Lwv\DataModule\Faq\Form
 */
class FaqFormSections
{

    /**
     * Handle the form sections
     * 
     * @param FaqFormBuilder $builder
     */
    public function handle(FaqFormBuilder $builder)
    {
        $builder->setSections(
            [
                'general' => [
                    'title'  => 'Image Fields',
                    'fields' => function (FaqFormBuilder $builder) {
                        return array_map(
                            function (FieldType $field) {
                                return $field->getField();
                            },
                            array_filter(
                                $builder->getFormFields()->base()->all(),
                                function (FieldType $field) {
                                    if (in_array($field->getField(),['link_url','link_target','answer'])) {
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
                    'fields' => function (FaqFormBuilder $builder) {
                        return array_map(
                            function (FieldType $field) {
                                return $field->getField();
                            },
                            array_filter(
                                $builder->getFormFields()->base()->all(),
                                function (FieldType $field) {
                                    if (in_array($field->getField(),['link_url','link_target','answer'])) {
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
