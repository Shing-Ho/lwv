<?php namespace Lwv\ClubsModule;

use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Anomaly\Streams\Platform\Support\Hydrator;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Lwv\ClubsModule\Club\ClubModel;

/**
 * Class ClubsModulePlugin
 */

class ClubsModulePlugin extends Plugin
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
                'clubs',
                function () {
                    $alpha = [];
                    $regex = [
                        [
                            'class' => 'ae',
                            'name' => 'Clubs A-E',
                            'pattern' => '/^[a-e]/i'
                        ],
                        [
                            'class' => 'fk',
                            'name' => 'Clubs F-K',
                            'pattern' => '/^[f-k]/i'
                        ],
                        [
                            'class' => 'lr',
                            'name' => 'Clubs L-R',
                            'pattern' => '/^[l-r]/i'
                        ],
                        [
                            'class' => 'sz',
                            'name' => 'Clubs S-Z',
                            'pattern' => '/^[s-z]/i'
                        ]
                    ];

                    if ($clubs = ClubModel::orderBy('title')->get()) {
                        foreach ($regex as $arr) {
                            foreach ($clubs as $club) {
                                if (preg_match($arr['pattern'],$club->title)) {
                                    $alpha[$club->id] = $arr['class'];
                                }
                            }
                        }

                        return view('lwv.module.clubs::clubs', compact('clubs','alpha','regex'))->render();
                    }
                }
                , ['is_safe' => ['html']]
            ),
        ];
    }
}
