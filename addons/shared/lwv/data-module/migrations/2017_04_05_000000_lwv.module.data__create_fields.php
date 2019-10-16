<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleDataCreateFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        // Fields
        'name' => [
            'type'   => 'anomaly.field_type.text',
        ],
        'title' => [
            'type'   => 'anomaly.field_type.text',
        ],
        'link_url' => [
            'type'   => 'anomaly.field_type.text',
        ],
        'link_target' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    '_blank' => 'New Window',
                    '_self' => 'Current Window',
                ],
                'default_value' => '_blank',
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        // FAQ
        'question' => [
            'type'   => 'anomaly.field_type.text',
        ],
        'answer' => [
            'type'   => 'anomaly.field_type.editor',
            'config' => [
                'mode'   => 'twig',
                'theme'  => 'monokai',
                'height' => 200
            ]
        ],
        'faq_layout' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'content' => 'Content',
                    'linked' => 'Linked',
                ],
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'faq_category' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [],
                'handler' => 'Lwv\DataModule\Faq\FaqCategoryOptions@handle'
            ]
        ],
        // Contacts
        'contact_category' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [],
                'handler' => 'Lwv\DataModule\Contact\ContactCategoryOptions@handle'
            ]
        ],
        'phone' => [
            'type'   => 'anomaly.field_type.text',
        ],
        'email' => [
            'type'   => 'anomaly.field_type.text',
        ],
        // Education
        'clubhouse' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'community-center' => 'Community Center',
                    'clubhouse1' => 'Clubhouse 1',
                    'clubhouse2' => 'Clubhouse 2',
                    'performing-arts-center' => 'Performing Arts Center',
                    'clubhouse4' => 'Clubhouse 4',
                    'clubhouse5' => 'Clubhouse 5',
                    'clubhouse6' => 'Clubhouse 6',
                    'clubhouse7' => 'Clubhouse 7',
                    'library' => 'Library',
                    'lessons' => 'Lessons',
                ],
                'default_value' => 'general',
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'class_type' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'resident' => 'Resident Classes',
                    'emeritus' => 'Emeritus Classes',
                ],
                'default_value' => 'resident',
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'class_category' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'general' => 'General Interest',
                    'art' => 'Art',
                    'film' => 'Film',
                    'photography' => 'Photography',
                    'health' => 'Health & Wellness',
                    'music' => 'Music & Dance',
                    'language' => 'Foreign Language',
                ],
                'default_value' => 'general',
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'schedule' => [
            'type'   => 'anomaly.field_type.editor',
            'config' => [
                'mode'   => 'twig',
                'theme'  => 'monokai',
                'height' => 200
            ]
        ],
        'cost' => [
            'type'   => 'anomaly.field_type.editor',
            'config' => [
                'mode'   => 'twig',
                'theme'  => 'monokai',
                'height' => 200
            ]
        ],
        // Floorplans
        'mutual' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'third' => 'Third',
                    'united' => 'United ',
                    'third united' => 'Third & United',
                    'fifty' => 'Towers'
                ],
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'size' => [
            'type'   => 'anomaly.field_type.integer',
            'config' => [
                'min' => 500,
                'max' => 5000,
                'step' => 1,
            ],
        ],
        'bedrooms' => [
            'type'   => 'anomaly.field_type.integer',
            'config' => [
                'min' => 0,
                'max' => 5,
                'step' => 1,
            ],
        ],
        'baths' => [
            "type"   => "anomaly.field_type.decimal",
            "config" => [
                "default_value" => 1,
                "point"     => ".",
                "decimals"  => 2,
                "min"       => 1,
                "max"       => 5,
            ]
        ],
        'atrium' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'no' => 'No',
                    'yes' => 'Yes',
                    'varies' => 'Varies'
                ],
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'laundry' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'no' => 'No',
                    'yes' => 'Yes',
                    'varies' => 'Varies'
                ],
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'fireplace' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'no' => 'No',
                    'yes' => 'Yes',
                    'varies' => 'Varies'
                ],
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'parking' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'underground' => 'Underground',
                    'carport' => 'Carport',
                    'garage' => 'Garage'
                ],
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'parking_size' => [
            'type'   => 'anomaly.field_type.integer',
            'config' => [
                'min' => 0,
                'max' => 5,
                'step' => 1,
            ],
        ],
        'floorplan' => [
            "type"   => "anomaly.field_type.file",
            "config" => [
                'folders'  => ['floorplans'],
            ]
        ],
        // Testimonials
        'testimonial_name' => [
            'type'   => 'anomaly.field_type.text',
        ],
        'testimonial' => [
            'type'   => 'anomaly.field_type.textarea',
            'config' => [
                'max'           => 500,
            ]
        ],
        'testimonial_category' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [],
                'handler' => 'Lwv\DataModule\Testimonial\TestimonialCategoryOptions@handle'
            ]
        ],
        'approved' => [
            'type'   => 'anomaly.field_type.boolean',
        ],
    ];

}
