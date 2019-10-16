<?php namespace Lwv\BlockImageExtension;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

class BlockImageExtensionServiceProvider extends AddonServiceProvider
{

    protected $plugins = [];

    protected $routes = [
        // Block Text
        'admin/blocks/block_image' => 'Lwv\BlockImageExtension\Http\Controller\Admin\BlocksController@index',
        'admin/blocks/block_image/create/{pid}' => 'Lwv\BlockImageExtension\Http\Controller\Admin\BlocksController@create',
        'admin/blocks/block_image/edit/{id}' => 'Lwv\BlockImageExtension\Http\Controller\Admin\BlocksController@edit',
        'admin/blocks/block_image/delete/{id}' => 'Lwv\BlockImageExtension\Http\Controller\Admin\BlocksController@delete',
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
