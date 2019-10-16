<?php namespace Lwv\BlockCustomExtension;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

class BlockCustomExtensionServiceProvider extends AddonServiceProvider
{

    protected $plugins = [];

    protected $routes = [
        // Block Custom
        'admin/blocks/block_custom' => 'Lwv\BlockCustomExtension\Http\Controller\Admin\BlocksController@index',
        'admin/blocks/block_custom/create/{pid}' => 'Lwv\BlockCustomExtension\Http\Controller\Admin\BlocksController@create',
        'admin/blocks/block_custom/edit/{id}' => 'Lwv\BlockCustomExtension\Http\Controller\Admin\BlocksController@edit',
        'admin/blocks/block_custom/delete/{id}' => 'Lwv\BlockCustomExtension\Http\Controller\Admin\BlocksController@delete',
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
