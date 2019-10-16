<?php namespace Lwv\FormsExtension\Contact\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class ContactFormBuilder
 */
class ContactFormBuilder extends FormBuilder
{
    /**
     * The ajax flag.
     *
     * @var bool
     */
    protected $ajax = true;

    /**
     * The form fields.
     *
     * @var array
     */
    protected $fields = [
        'interest' => [
            'type'     => 'anomaly.field_type.select',
            'required' => true,
            'config'   => [
                'options' => [],
                'handler' => 'Lwv\FormsExtension\Handler\ContactInterestOptions@handle',
            ],
        ],
       
        'leased'=>[
            'type'   => 'anomaly.field_type.text',
            'class'  => 'form-control form-required',
        ],
        'occupied'=>[
            'type'   => 'anomaly.field_type.text',
            'class'  => 'form-control form-required',
        ],
        'user_date'=>[
            'type'   => 'anomaly.field_type.text',
            'class'  => 'form-control form-required',
        ],
        'residentId' => [
              'type'   => 'anomaly.field_type.text',
            'class'  => 'form-control form-required',
        ],
        'user_manor' => [
            'type'   => 'anomaly.field_type.text',
            'class'  => 'form-control form-required',
        ],
        'user_name' => [
            'type'   => 'anomaly.field_type.text',
            'class'  => 'form-control form-required',
        ],
        'user_email' => [
            'type'  => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ],
        'home_phone' => [
            'type'   => 'anomaly.field_type.text',
            'class'  => 'form-control form-required',
        ], 
        'cell_phone' => [
            'type'   => 'anomaly.field_type.text',
            'class'  => 'form-control form-required',
        ], 
        'name1' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ], 
        'relationship1' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ],  
        'home_number1' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ],
        'email1' => [
            'type'   => 'anomaly.field_type.text',
            'class'  => 'form-control form-required',
        ],
        'work_number1' => [
            'type'   => 'anomaly.field_type.text',
            'class'  => 'form-control form-required',
        ],
        'cell_number1' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ],
        'address1' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ],
        'city1' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ], 
        'state1' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ], 
        'zip_code1' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ], 

         



        'name2' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ], 
        'relationship2' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ],  
        'home_number2' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ],
        'email2' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ],
        'work_number2' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ],
        'cell_number2' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ],
        'address2' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ],
        'city2' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ], 
        'state2' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ], 
        'zip_code2' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ], 
        

        'attorneyTrusteeName' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ], 
        'attorney_phone' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ],  
        'petCareContactName' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ],
        'pet_phone' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ] ,
       
        'first_name' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ],
        'last_name' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ],
        'email' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ],
        'phone' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ],
        'photos' => [
            'type'   => 'lwv.field_type.dropzone',
            'config' => [
                'accepted'       => 'image/*',
                'rules'          => 'required|mimes:jpeg,jpg|max:4096',
                'maxsize'        => 4,
                'maxfiles'       => 3,
                'message'        => 'Click or drop photos here to upload',
                'caption'        => '(3 Photos Max | JPG Format | < 4MB)',
            ]
        ],
        // Trading Post
        'manor' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
            'config' => [
                'max' => 8,
            ]
        ],
        'address' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ],
        'message' => [
            'type'   => 'anomaly.field_type.textarea',
            'class' => 'form-control form-required',
            'config' => [
                'rows'          => 5,
                'max'           => 500,
            ]
        ],
        'subscribe' => [
            'type'   => 'anomaly.field_type.checkboxes',
            'config' => [
                'options'       => [],
                'handler' => 'Lwv\FormsExtension\Handler\ContactSubscribeOptions@handle',
            ]
        ],
        'service' => [
            'type'   => 'anomaly.field_type.checkboxes',
            'config'   => [
                'options' => [
                    'Cable' => 'Cable',
                    'Internet' => 'Internet',
                    'Advertising' => 'Advertising'
                ],
            ],
        ],
        'ad_phone' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'form-control form-required',
        ],
        'ad_type' => [
            'type'     => 'anomaly.field_type.select',
            'required' => true,
            'config'   => [
                'options' => [],
                'mode' => 'radio',
                'handler' => 'Lwv\FormsExtension\Handler\ContactAdTypeOptions@handle',
            ],
        ],
        'ad_description' => [
            'type'   => 'anomaly.field_type.textarea',
            'class' => 'form-control form-required',
            'config' => [
                'rows'          => 3,
                'max'           => 1000,
            ]
        ],
        'spam' => [
            'type'   => 'lwv.field_type.spam',
        ],
    ];

    /**
     * The form actions.
     *
     * @var array
     */
    protected $actions = [];

    /**
     * The form options.
     *
     * @var array
     */
    protected $options = [
        'form_view' => 'lwv.extension.forms::forms/contact'
    ];

    /**
     * The form assets.
     *
     * @var array
     */
    protected $assets = [
        'scripts.js' => [
            'lwv.extension.forms::js/contact.js',
        ],
    ];
}
