<?php namespace Lwv\NewsModule\Type\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class TypeFormBuilder
 */
class TypeFormBuilder extends FormBuilder
{

    /**
     * The form fields.
     *
     * @var array
     */
    protected $fields = [
        '*',
        'slug' => [
            'disabled' => 'edit'
        ]
    ];

}
