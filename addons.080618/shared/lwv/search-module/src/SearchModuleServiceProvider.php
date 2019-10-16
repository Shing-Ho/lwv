<?php namespace Lwv\SearchModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Application\Application;
use Illuminate\Contracts\Config\Repository;

/**
 * Class SearchModuleServiceProvider
 */
class SearchModuleServiceProvider extends AddonServiceProvider
{

    /**
     * Additional addon providers.
     *
     * @var array
     */
    protected $providers = [];

    /**
     * The addon plugins.
     *
     * @var array
     */
    protected $plugins = ['Lwv\SearchModule\SearchModulePlugin'];

    /**
     * The addon commands.
     *
     * @var array
     */
    protected $commands = [
        'Lwv\SearchModule\Search\Console\Destroy',
        'Lwv\SearchModule\Search\Console\Rebuild',
        'Lwv\SearchModule\Search\Console\Refresh'
    ];

    /**
     * The addon listeners.
     *
     * @var array
     */
    protected $listeners = [
        'Anomaly\Streams\Platform\Entry\Event\EntryWasSaved'       => [
            'Lwv\SearchModule\Search\Listener\DeleteIndexEntries',
        ],
        'Anomaly\Streams\Platform\Entry\Event\EntryWasDeleted'       => [
            'Lwv\SearchModule\Search\Listener\DeleteIndexEntries',
        ],
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'search/index/page/{page}' => 'Lwv\SearchModule\Http\Controller\SearchController@page',
        'search/index/{type}/{namespace}/{id}' => 'Lwv\SearchModule\Http\Controller\SearchController@entry',
    ];

    /**
     * Boot the service provider.
     *
     * @param Repository  $config
     * @param Application $application
     */
    public function boot(Repository $config, Application $application)
    {
        $config->set('search', $config->get('lwv.module.search::engine'));

        $config->set(
            'search.connections.zend.path',
            str_replace(
                'storage::',
                $application->getStoragePath() . '/',
                $config->get('search.connections.zend.path')
            )
        );
    }
}
