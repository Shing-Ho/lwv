<?php namespace Lwv\CareersModule\Search\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class SearchFormBuilder extends FormBuilder
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
        'type' => [
            'type'   => 'anomaly.field_type.select',
            'required' => true,
            'config' => [
                'options' => [],
                'handler' => 'Lwv\CareersModule\Field\TypeOptions@handle'
            ]
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
        'form_view' => 'lwv.module.careers::forms/career_search'
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
    protected $assets = [
        'scripts.js' => [
            'lwv.module.careers::js/search.js',
            'lwv.field_type.dropzone::js/exif.js',
            'lwv.field_type.dropzone::js/dropzone.min.js',
            'lwv.field_type.dropzone::js/upload.js',
            'anomaly.field_type.textarea::js/jquery.charactercounter.js',
        ],
        'styles.css' => [
            'lwv.field_type.dropzone::css/dropzone.css',
        ],
    ];
}
