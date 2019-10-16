<?php namespace Lwv\DropzoneFieldType;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class DropzoneFieldTypeServiceProvider
 */
class DropzoneFieldTypeServiceProvider extends AddonServiceProvider
{

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'streams/dropzone-field_type/handle'          => 'Lwv\DropzoneFieldType\Http\Controller\FilesController@upload',
    ];

    /**
     * The addon listeners.
     *
     * @var array
     */
    protected $listeners = [];

}
