<?php namespace Lwv\NewsModule\Post\Form;

use Illuminate\Contracts\Auth\Guard;

/**
 * Class PostFormFields
 */
class PostFormFields
{

    /**
     * Handle the form fields.
     *
     * @param Guard           $auth
     * @param PostFormBuilder $builder
     */
    public function handle(Guard $auth, PostFormBuilder $builder)
    {
        $builder->setFields(
            [
                '*',
                'publish_at' => [
                    'config' => [
                        'default_value' => 'now'
                    ]
                ]
            ]
        );
    }
}
