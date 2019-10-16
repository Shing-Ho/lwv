<?php namespace Lwv\BlockMasonryExtension;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

class BlockMasonryExtensionServiceProvider extends AddonServiceProvider
{

    protected $plugins = [];

    protected $routes = [
        // Block Masonry
        'admin/blocks/block_masonry' => 'Lwv\BlockMasonryExtension\Http\Controller\Admin\BlocksController@index',
        'admin/blocks/block_masonry/create/{pid}' => 'Lwv\BlockMasonryExtension\Http\Controller\Admin\BlocksController@create',
        'admin/blocks/block_masonry/edit/{id}' => 'Lwv\BlockMasonryExtension\Http\Controller\Admin\BlocksController@edit',
        'admin/blocks/block_masonry/delete/{id}' => 'Lwv\BlockMasonryExtension\Http\Controller\Admin\BlocksController@delete',
        // Masonry Image
        'admin/blocks/block_masonry/image/create/{bid}' => 'Lwv\BlockMasonryExtension\Http\Controller\Admin\ImagesController@create',
        'admin/blocks/block_masonry/image/edit/{id}' => 'Lwv\BlockMasonryExtension\Http\Controller\Admin\ImagesController@edit',
        'admin/blocks/block_masonry/image/delete/{id}' => 'Lwv\BlockMasonryExtension\Http\Controller\Admin\ImagesController@delete',
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
