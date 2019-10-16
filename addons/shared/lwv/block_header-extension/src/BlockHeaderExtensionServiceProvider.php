<?php namespace Lwv\BlockHeaderExtension;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

class BlockHeaderExtensionServiceProvider extends AddonServiceProvider
{

    protected $plugins = [];

    protected $routes = [
        // Block Header
        'admin/blocks/block_header' => 'Lwv\BlockHeaderExtension\Http\Controller\Admin\BlocksController@index',
        'admin/blocks/block_header/create/{pid}' => 'Lwv\BlockHeaderExtension\Http\Controller\Admin\BlocksController@create',
        'admin/blocks/block_header/edit/{id}' => 'Lwv\BlockHeaderExtension\Http\Controller\Admin\BlocksController@edit',
        'admin/blocks/block_header/delete/{id}' => 'Lwv\BlockHeaderExtension\Http\Controller\Admin\BlocksController@delete',
        // Header Image
        'admin/blocks/block_header/image/create/{gid}' => 'Lwv\BlockHeaderExtension\Http\Controller\Admin\ImagesController@create',
        'admin/blocks/block_header/image/edit/{id}' => 'Lwv\BlockHeaderExtension\Http\Controller\Admin\ImagesController@edit',
        'admin/blocks/block_header/image/delete/{id}' => 'Lwv\BlockHeaderExtension\Http\Controller\Admin\ImagesController@delete',
    ];

    protected $middleware = [];

    protected $listeners = [];

    protected $aliases = [];

    protected $bindings = [];

    protected $providers = [];

    protected $singletons = [];

    protected $overrides = [];

    protected $mobile = [];

    /**
     * Register the addon.
     */
    public function register()
    {
    }

    public function map()
    {
    }

}
