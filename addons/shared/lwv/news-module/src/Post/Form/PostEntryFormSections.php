<?php namespace Lwv\NewsModule\Post\Form;

use Lwv\NewsModule\Post\PostModel;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class PostEntryFormSections
 */
class PostEntryFormSections
{

    /**
     * Handle the form sections.
     *
     * @param PostEntryFormBuilder $builder
     */
    public function handle(PostEntryFormBuilder $builder)
    {
        $builder->setSections(
            [
                'post' => [
                    'tabs' => [
                        'general'      => [
                            'title'  => 'module::tab.general',
                            'fields' => [
                                'post_title',
                                'post_slug',
                                'post_summary',
                            ],
                        ],
                        'organization' => [
                            'title'  => 'module::tab.organization',
                            'fields' => [
                                'post_category',
                                'post_tags',
                            ]
                        ],
                        'fields'       => [
                            'title'  => 'module::tab.fields',
                            'fields' => function (PostEntryFormBuilder $builder) {
                                return array_map(
                                    function (FieldType $field) {
                                        return 'entry_' . $field->getField();
                                    },
                                    array_filter(
                                        $builder->getFormFields()->base()->all(),
                                        function (FieldType $field) {
                                            return (!$field->getEntry() instanceof PostModel);
                                        }
                                    )
                                );
                            }
                        ],
                        'seo'          => [
                            'title'  => 'module::tab.seo',
                            'fields' => [
                                'post_meta_title',
                                'post_meta_keywords',
                                'post_meta_description'
                            ]
                        ],
                        'options'      => [
                            'title'  => 'module::tab.options',
                            'fields' => [
                                'post_enabled',
                                'post_featured',
                                'post_publish_at',
                                'post_publish_until'
                            ]
                        ],
                    ]
                ]
            ]
        );
    }
}
