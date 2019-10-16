<?php namespace Lwv\BlockTestimonialExtension;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

class BlockTestimonialExtensionServiceProvider extends AddonServiceProvider
{

    protected $plugins = [];

    protected $routes = [
        // Block Testimonial
        'admin/blocks/block_testimonial' => 'Lwv\BlockTestimonialExtension\Http\Controller\Admin\BlocksController@index',
        'admin/blocks/block_testimonial/create/{pid}' => 'Lwv\BlockTestimonialExtension\Http\Controller\Admin\BlocksController@create',
        'admin/blocks/block_testimonial/edit/{id}' => 'Lwv\BlockTestimonialExtension\Http\Controller\Admin\BlocksController@edit',
        'admin/blocks/block_testimonial/delete/{id}' => 'Lwv\BlockTestimonialExtension\Http\Controller\Admin\BlocksController@delete',
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
