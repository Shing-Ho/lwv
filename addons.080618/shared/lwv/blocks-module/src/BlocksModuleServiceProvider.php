<?php namespace Lwv\BlocksModule;

use Anomaly\Streams\Platform\Addon\AddonIntegrator;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

class BlocksModuleServiceProvider extends AddonServiceProvider
{
    protected $plugins = [];

    protected $routes = [
        // Blocks
        'admin/blocks' => 'Lwv\BlocksModule\Http\Controller\Admin\BlocksController@index',
        'admin/blocks/order' => 'Lwv\BlocksModule\Http\Controller\Admin\BlocksController@order',
        'admin/blocks/choose/{page}' => 'Lwv\BlocksModule\Http\Controller\Admin\BlocksController@choose',
        // Templates
        'admin/blocks/templates' => 'Lwv\BlocksModule\Http\Controller\Admin\TemplatesController@index',
        'admin/blocks/templates/create' => 'Lwv\BlocksModule\Http\Controller\Admin\TemplatesController@create',
        'admin/blocks/templates/edit/{id}' => 'Lwv\BlocksModule\Http\Controller\Admin\TemplatesController@edit',
        // Block copy
        'admin/blocks/copy'    => 'Lwv\BlocksModule\Http\Controller\Admin\BlocksController@copy',
        'admin/blocks/copy/{type}/{id}'    => 'Lwv\BlocksModule\Http\Controller\Admin\PagesController@index',
        // Bulk copy
        'admin/blocks/copy/bulk'    => 'Lwv\BlocksModule\Http\Controller\Admin\BlocksController@bulk_copy',
    ];

    protected $middleware = [];

    protected $listeners = [];

    protected $providers = [];

    protected $singletons = [];

    protected $overrides = [];

    protected $mobile = [];

    protected $commands = [];

    /**
     * Register the addon.
     */
    public function register(AddonIntegrator $integrator)
    {
        $integrator->register(
            realpath(__DIR__ .'/../addons/lwv/blocks_page_handler-extension/'),
            'lwv.extension.blocks_page_handler',
            true,
            true
        );

        $integrator->register(
            realpath(__DIR__ .'/../addons/lwv/blocks-field_type/'),
            'lwv.field_type.blocks',
            true,
            true
        );

        $integrator->register(
            realpath(__DIR__ .'/../addons/lwv/block_images-field_type/'),
            'lwv.field_type.block_images',
            true,
            true
        );
    }

    public function map()
    {
    }
}
