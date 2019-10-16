<?php namespace Lwv\BlockGalleryExtension;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

class BlockGalleryExtensionServiceProvider extends AddonServiceProvider
{

    protected $plugins = [];

    protected $routes = [
        // Block Gallery
        'admin/blocks/block_gallery' => 'Lwv\BlockGalleryExtension\Http\Controller\Admin\BlocksController@index',
        'admin/blocks/block_gallery/create/{pid}' => 'Lwv\BlockGalleryExtension\Http\Controller\Admin\BlocksController@create',
        'admin/blocks/block_gallery/edit/{id}' => 'Lwv\BlockGalleryExtension\Http\Controller\Admin\BlocksController@edit',
        'admin/blocks/block_gallery/delete/{id}' => 'Lwv\BlockGalleryExtension\Http\Controller\Admin\BlocksController@delete',
        // Gallery Image
        'admin/blocks/block_gallery/image/create/{gid}' => 'Lwv\BlockGalleryExtension\Http\Controller\Admin\ImagesController@create',
        'admin/blocks/block_gallery/image/edit/{id}' => 'Lwv\BlockGalleryExtension\Http\Controller\Admin\ImagesController@edit',
        'admin/blocks/block_gallery/image/delete/{id}' => 'Lwv\BlockGalleryExtension\Http\Controller\Admin\ImagesController@delete',
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
