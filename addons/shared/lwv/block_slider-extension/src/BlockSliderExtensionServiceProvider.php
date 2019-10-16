<?php namespace Lwv\BlockSliderExtension;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

class BlockSliderExtensionServiceProvider extends AddonServiceProvider
{

    protected $plugins = [];

    protected $routes = [
        // Block Slider
        'admin/blocks/block_slider' => 'Lwv\BlockSliderExtension\Http\Controller\Admin\BlocksController@index',
        'admin/blocks/block_slider/create/{pid}' => 'Lwv\BlockSliderExtension\Http\Controller\Admin\BlocksController@create',
        'admin/blocks/block_slider/edit/{id}' => 'Lwv\BlockSliderExtension\Http\Controller\Admin\BlocksController@edit',
        'admin/blocks/block_slider/delete/{id}' => 'Lwv\BlockSliderExtension\Http\Controller\Admin\BlocksController@delete',
        // Slider Image
        'admin/blocks/block_slider/image/create/{gid}' => 'Lwv\BlockSliderExtension\Http\Controller\Admin\ImagesController@create',
        'admin/blocks/block_slider/image/edit/{id}' => 'Lwv\BlockSliderExtension\Http\Controller\Admin\ImagesController@edit',
        'admin/blocks/block_slider/image/delete/{id}' => 'Lwv\BlockSliderExtension\Http\Controller\Admin\ImagesController@delete',
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
