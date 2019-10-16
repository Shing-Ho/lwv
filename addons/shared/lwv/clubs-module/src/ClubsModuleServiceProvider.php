<?php namespace Lwv\ClubsModule;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Illuminate\Routing\Router;

class ClubsModuleServiceProvider extends AddonServiceProvider
{

    protected $plugins = ['Lwv\ClubsModule\ClubsModulePlugin'];

    protected $routes = [
        'admin/clubs' => 'Lwv\ClubsModule\Http\Controller\Admin\ClubsController@index',
        'admin/clubs/create' => 'Lwv\ClubsModule\Http\Controller\Admin\ClubsController@create',
        'admin/clubs/edit/{id}' => 'Lwv\ClubsModule\Http\Controller\Admin\ClubsController@edit',
        // Headers
        'admin/clubs/headers' => 'Lwv\ClubsModule\Http\Controller\Admin\HeadersController@index',
        'admin/clubs/headers/create' => 'Lwv\ClubsModule\Http\Controller\Admin\HeadersController@create',
        'admin/clubs/headers/edit/{id}' => 'Lwv\ClubsModule\Http\Controller\Admin\HeadersController@edit',
        // Websites
        'admin/clubs/websites' => 'Lwv\ClubsModule\Http\Controller\Admin\WebsitesController@index',
        'admin/clubs/websites/manage/{id}' => 'Lwv\ClubsModule\Http\Controller\Admin\WebsitesController@manage',
        'admin/clubs/websites/edit/{id}' => 'Lwv\ClubsModule\Http\Controller\Admin\WebsitesController@edit',
        'admin/clubs/websites/preview/{id}' => 'Lwv\ClubsModule\Http\Controller\Admin\WebsitesController@preview',
        // Documents
        'admin/clubs/websites/documents/{club}' => 'Lwv\ClubsModule\Http\Controller\Admin\DocumentsController@index',
        'admin/clubs/websites/documents/{club}/create' => 'Lwv\ClubsModule\Http\Controller\Admin\DocumentsController@create',
        'admin/clubs/websites/documents/{club}/edit/{id}' => 'Lwv\ClubsModule\Http\Controller\Admin\DocumentsController@edit',
        // Photos
        'admin/clubs/websites/photos/{club}' => 'Lwv\ClubsModule\Http\Controller\Admin\PhotosController@index',
        'admin/clubs/websites/photos/{club}/create' => 'Lwv\ClubsModule\Http\Controller\Admin\PhotosController@create',
        'admin/clubs/websites/photos/{club}/edit/{id}' => 'Lwv\ClubsModule\Http\Controller\Admin\PhotosController@edit',
        // Posts
        'admin/clubs/websites/posts/{club}' => 'Lwv\ClubsModule\Http\Controller\Admin\PostsController@index',
        'admin/clubs/websites/posts/{club}/create' => 'Lwv\ClubsModule\Http\Controller\Admin\PostsController@create',
        'admin/clubs/websites/posts/{club}/edit/{id}' => 'Lwv\ClubsModule\Http\Controller\Admin\PostsController@edit',
        'admin/clubs/websites/posts/view/{id}' => 'Lwv\ClubsModule\Http\Controller\Admin\PostsController@view',
        // Public routes
        'clubs/documents/download/{name}' => 'Lwv\ClubsModule\Http\Controller\ClubsController@download',
        'clubs/documents/view/{name}' => 'Lwv\ClubsModule\Http\Controller\ClubsController@read',
        'clubs/posts/preview/{id}' => 'Lwv\ClubsModule\Http\Controller\PostsController@preview',
    ];

    protected $middleware = [];

    protected $listeners = [];

    protected $aliases = [];

    protected $bindings = [];

    protected $providers = [];

    protected $singletons = [
        'Lwv\ClubsModule\Club\Contract\ClubRepositoryInterface' => 'Lwv\ClubsModule\Club\ClubRepository',
        'Lwv\ClubsModule\Website\Contract\WebsiteRepositoryInterface' => 'Lwv\ClubsModule\Website\WebsiteRepository',
        'Lwv\ClubsModule\Document\Contract\DocumentRepositoryInterface' => 'Lwv\ClubsModule\Document\DocumentRepository',
        'Lwv\ClubsModule\Header\Contract\HeaderRepositoryInterface' => 'Lwv\ClubsModule\Header\HeaderRepository',
        'Lwv\ClubsModule\Photo\Contract\PhotoRepositoryInterface' => 'Lwv\ClubsModule\Photo\PhotoRepository',
        'Lwv\ClubsModule\Post\Contract\PostRepositoryInterface' => 'Lwv\ClubsModule\Post\PostRepository',
    ];

    protected $overrides = [];

    protected $mobile = [];

    protected $commands = [
        'Lwv\ClubsModule\Club\Console\FormatClubs',
    ];

    public function register()
    {
    }

    /**
     * Map additional routes.
     *
     * @param Router                     $router
     * @param SettingRepositoryInterface $settings
     */
    public function map(Router $router, SettingRepositoryInterface $settings)
    {
        $module    = $settings->value('lwv.module.clubs::module_root', 'clubs');

        /**
         * Map public club routes.
         */
        $router->any(
            "{$module}/{slug}",
            [
                'uses'           => 'Lwv\ClubsModule\Http\Controller\ClubsController@microsite',
                'streams::addon' => 'lwv.module.clubs'
            ]
        );

        $router->any(
            "{$module}/preview/{slug}",
            [
                'uses'           => 'Lwv\ClubsModule\Http\Controller\ClubsController@preview',
                'streams::addon' => 'lwv.module.clubs'
            ]
        );

        /**
         *  Map public posts routes.
         */
        $router->pattern('type', '(news|events)');
        $router->pattern('year', '\d{4}');
        $router->pattern('month', '\d{2}');
        $router->pattern('day', '\d{2}');

        $router->any(
            "{$module}/{club}/{type}",
            [
                'uses'           => 'Lwv\ClubsModule\Http\Controller\PostsController@index',
                'streams::addon' => 'lwv.module.clubs'
            ]
        );

        $router->any(
            "{$module}/{club}/{type}/{year}/{month}/{day}/{slug}",
            [
                'uses'           => 'Lwv\ClubsModule\Http\Controller\PostsController@search',
                'streams::addon' => 'lwv.module.clubs'
            ]
        );

        $router->any(
            "{$module}/{club}/{type}/{year}/{month?}",
            [
                'uses'           => 'Lwv\ClubsModule\Http\Controller\PostsController@search',
                'streams::addon' => 'lwv.module.clubs'
            ]
        );
    }
}
