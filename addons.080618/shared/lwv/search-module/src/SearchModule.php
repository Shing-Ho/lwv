<?php namespace Lwv\SearchModule;

use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Application\Application;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Filesystem\Filesystem;

class SearchModule extends Module
{

    /**
     * This module does not
     * display in navigation.
     *
     * @var bool
     */
    protected $navigation = false;

    /**
     * The navigation icon.
     *
     * @var string
     */
    protected $icon = 'search';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [];

    /**
     * Fired just before module is installed.
     *
     * @param Application $application
     * @param Filesystem  $files
     */
    public function onInstalling(Application $application, Filesystem $files)
    {
        if (is_dir($path = $application->getStoragePath('search/zend'))) {
            $files->deleteDirectory($application->getStoragePath('search/zend'));
        }
    }

    /**
     * Fired after module is installed.
     *
     * @param Application $application
     */
    public function onInstalled(Application $application)
    {
        if (!is_dir($path = $application->getStoragePath('search/zend'))) {
            mkdir($application->getStoragePath('search/zend'), 0777, true);
        }
    }

    /**
     * Fired after module is uninstalled.
     *
     * @param Application $application
     * @param Filesystem  $files
     */
    public function onUninstalled(Application $application, Filesystem $files)
    {
        $files->deleteDirectory($application->getStoragePath('search/zend'));
    }
}