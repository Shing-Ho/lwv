<?php namespace Lwv\BlockTextExtension;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

class BlockTextExtensionServiceProvider extends AddonServiceProvider
{

    protected $plugins = [];

    protected $routes = [
        // Block Text
        'admin/blocks/block_text' => 'Lwv\BlockTextExtension\Http\Controller\Admin\BlocksController@index',
        'admin/blocks/block_text/create/{pid}' => 'Lwv\BlockTextExtension\Http\Controller\Admin\BlocksController@create',
        'admin/blocks/block_text/edit/{id}' => 'Lwv\BlockTextExtension\Http\Controller\Admin\BlocksController@edit',
        'admin/blocks/block_text/delete/{id}' => 'Lwv\BlockTextExtension\Http\Controller\Admin\BlocksController@delete',
    ];

    protected $middleware = [];

    protected $listeners = [];

    protected $aliases = [];

    protected $bindings = [];

    protected $providers = [];

    protected $singletons = [];

    protected $overrides = [];

    protected $mobile = [];

    public function register()
    {
    }

    public function map()
    {
    }

}
