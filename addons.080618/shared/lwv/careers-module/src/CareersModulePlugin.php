<?php namespace Lwv\CareersModule;

use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Anomaly\Streams\Platform\Support\Hydrator;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Lwv\CareersModule\Job\JobModel;

/**
 * Class CareersModulePlugin
 */

class CareersModulePlugin extends Plugin
{

    /**
     * The hydrator utility.
     *
     * @var Hydrator
     */
    protected $hydrator;

    /**
     * The service container.
     *
     * @var Container
     */
    protected $container;

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * The settings interface
     *
     * @var SettingRepositoryInterface
     */
    protected $settings;

    public function __construct(SettingRepositoryInterface $settings, Hydrator $hydrator, Container $container, Request $request)
    {
        $this->settings = $settings;
        $this->hydrator  = $hydrator;
        $this->container = $container;
        $this->request = $request;
    }

    /**
     * Get the plugin functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'career_search_results',
                function () {
                    return view('lwv.module.careers::container')->render();
                },
                [
                    'is_safe' => ['html'],
                ]
            ),
        ];
    }
}
