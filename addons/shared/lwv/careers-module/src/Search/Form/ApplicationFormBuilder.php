<?php namespace Lwv\CareersModule\Search\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class ApplicationFormBuilder extends FormBuilder
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
     * @var array|string
     */
    protected $fields = [
        'name' => [
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
        'cover_letter' => [
            'type'   => 'anomaly.field_type.textarea',
            'config' => [
                'rows'          => 5,
                'max'           => 2048,
            ]
        ],
        'attachments' => [
            'type'   => 'lwv.field_type.dropzone',
            'config' => [
                'accepted'       => 'application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,text/plain',
                'rules'          => 'required|mimes:pdf,doc,docx,txt|max:8192',
                'maxsize'        => 8,
                'maxfiles'       => 3,
                'message'        => 'Click or drop resume / portfolio here to upload',
                'caption'        => '(2 Max / PDF, MSWord, Text)',
            ]
        ],
        'job' => [
            'type'   => 'anomaly.field_type.text',
            'class' => 'hidden',
        ],
        'spam' => [
            'type'   => 'lwv.field_type.spam',
        ],
    ];

    /**
     * Fields to skip.
     *
     * @var array|string
     */
    protected $skips = [];

    /**
     * The form actions.
     *
     * @var array|string
     */
    protected $actions = [];

    /**
     * The form buttons.
     *
     * @var array|string
     */
    protected $buttons = [];

    /**
     * The form options.
     *
     * @var array
     */
    protected $options = [
        'form_view' => 'lwv.module.careers::forms/application'
    ];

    /**
     * The form sections.
     *
     * @var array
     */
    protected $sections = [];

    /**
     * The form assets.
     *
     * @var array
     */
    protected $assets = [];

}
