<?php namespace Lwv\NewsModule;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class NewsModuleServiceProvider
 */
class NewsModuleServiceProvider extends AddonServiceProvider
{
    protected $plugins = ['Lwv\NewsModule\NewsModulePlugin'];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'admin/news'                                               => 'Lwv\NewsModule\Http\Controller\Admin\PostsController@index',
        'admin/news/choose'                                        => 'Lwv\NewsModule\Http\Controller\Admin\PostsController@choose',
        'admin/news/create'                                        => 'Lwv\NewsModule\Http\Controller\Admin\PostsController@create',
        'admin/news/edit/{id}'                                     => 'Lwv\NewsModule\Http\Controller\Admin\PostsController@edit',
        'admin/news/view/{id}'                                     => 'Lwv\NewsModule\Http\Controller\Admin\PostsController@view',
        'admin/news/categories'                                    => 'Lwv\NewsModule\Http\Controller\Admin\CategoriesController@index',
        'admin/news/categories/create'                             => 'Lwv\NewsModule\Http\Controller\Admin\CategoriesController@create',
        'admin/news/categories/edit/{id}'                          => 'Lwv\NewsModule\Http\Controller\Admin\CategoriesController@edit',
        'admin/news/categories/view/{id}'                          => 'Lwv\NewsModule\Http\Controller\Admin\CategoriesController@view',
        'admin/news/categories/assignments'                        => 'Lwv\NewsModule\Http\Controller\Admin\CategoriesController@assignments',
        'admin/news/types'                                         => 'Lwv\NewsModule\Http\Controller\Admin\TypesController@index',
        'admin/news/types/create'                                  => 'Lwv\NewsModule\Http\Controller\Admin\TypesController@create',
        'admin/news/types/edit/{id}'                               => 'Lwv\NewsModule\Http\Controller\Admin\TypesController@edit',
        'admin/news/fields'                                        => 'Lwv\NewsModule\Http\Controller\Admin\FieldsController@index',
        'admin/news/fields/choose'                                 => 'Lwv\NewsModule\Http\Controller\Admin\FieldsController@choose',
        'admin/news/fields/create'                                 => 'Lwv\NewsModule\Http\Controller\Admin\FieldsController@create',
        'admin/news/fields/edit/{id}'                              => 'Lwv\NewsModule\Http\Controller\Admin\FieldsController@edit',
        'admin/news/fields/assignments/{stream}'                   => 'Lwv\NewsModule\Http\Controller\Admin\AssignmentsController@index',
        'admin/news/fields/assignments/{stream}/choose'            => 'Lwv\NewsModule\Http\Controller\Admin\AssignmentsController@choose',
        'admin/news/fields/assignments/{stream}/create'            => 'Lwv\NewsModule\Http\Controller\Admin\AssignmentsController@create',
        'admin/news/fields/assignments/{stream}/edit/{assignment}' => 'Lwv\NewsModule\Http\Controller\Admin\AssignmentsController@edit',
    ];
    

    /**
     * The class bindings.
     *
     * @var array
     */
    protected $bindings = [
        'Anomaly\Streams\Platform\Model\News\NewsPostsEntryModel'      => 'Lwv\NewsModule\Post\PostModel',
        'Anomaly\Streams\Platform\Model\News\NewsCategoriesEntryModel' => 'Lwv\NewsModule\Category\CategoryModel'
    ];

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        'Lwv\NewsModule\Post\Contract\PostRepositoryInterface'         => 'Lwv\NewsModule\Post\PostRepository',
        'Lwv\NewsModule\Type\Contract\TypeRepositoryInterface'         => 'Lwv\NewsModule\Type\TypeRepository',
        'Lwv\NewsModule\Category\Contract\CategoryRepositoryInterface' => 'Lwv\NewsModule\Category\CategoryRepository'
    ];

    /**
     * Map additional routes.
     *
     * @param Router                     $router
     * @param SettingRepositoryInterface $settings
     */
    public function map(Router $router, SettingRepositoryInterface $settings)
    {
        $tag       = $settings->value('lwv.module.news::tag_segment', 'tag');
        $module    = $settings->value('lwv.module.news::module_segment', 'news');
        $type      = $settings->value('lwv.module.news::type_segment', 'type');
        $category  = $settings->value('lwv.module.news::category_segment', 'category');

        /**
         * Map the RSS methods.
         */
        $router->any(
            "{$module}/rss/category/{category}.xml",
            [
                'uses'           => 'Lwv\NewsModule\Http\Controller\RssController@category',
                'streams::addon' => 'lwv.module.news'
            ]
        );

        $router->any(
            "{$module}/rss/tag/{tag}.xml",
            [
                'uses'           => 'Lwv\NewsModule\Http\Controller\RssController@tag',
                'streams::addon' => 'lwv.module.news'
            ]
        );

        $router->any(
            "{$module}/rss.xml",
            [
                'uses'           => 'Lwv\NewsModule\Http\Controller\RssController@recent',
                'streams::addon' => 'lwv.module.news'
            ]
        );

        /**
         * Map other public routes.
         * Mind the order. Routes are
         * handled first come first serve.
         */
        $router->any(
            "{$module}",
            [
                'uses'           => 'Lwv\NewsModule\Http\Controller\PostsController@index',
                'streams::addon' => 'lwv.module.news'
            ]
        );

        $router->any(
            "{$module}/preview/{id}",
            [
                'uses'           => 'Lwv\NewsModule\Http\Controller\PostsController@preview',
                'streams::addon' => 'lwv.module.news'
            ]
        );

        $router->any(
            "{$module}/{$tag}/{tag}",
            [
                'uses'           => 'Lwv\NewsModule\Http\Controller\TagsController@index',
                'streams::addon' => 'lwv.module.news'
            ]
        );

        $router->any(
            "{$module}/{$category}/{category}",
            [
                'uses'           => 'Lwv\NewsModule\Http\Controller\CategoriesController@index',
                'streams::addon' => 'lwv.module.news'
            ]
        );

        $router->pattern('year', '\d{4}');
        $router->pattern('month', '\d{2}');
        $router->pattern('day', '\d{2}');
        $router->any(
            "{$module}/{year}/{month}/{day}/{slug}",
            [
                'uses'           => 'Lwv\NewsModule\Http\Controller\PostsController@search',
                'streams::addon' => 'lwv.module.news'
            ]
        );

        $router->any(
            "{$module}/{year}/{month?}",
            [
                'uses'           => 'Lwv\NewsModule\Http\Controller\PostsController@search',
                'streams::addon' => 'lwv.module.news'
            ]
        );
    }
}
