<?php namespace Lwv\FormsExtension;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Addon\AddonIntegrator;
use Lwv\FormsExtension\Contact\Form\ContactFormBuilder;

class FormsExtensionServiceProvider extends AddonServiceProvider
{

    protected $plugins = ['Lwv\FormsExtension\FormsExtensionPlugin'];

    protected $commands = [];

    protected $routes = [];

    protected $middleware = [];

    protected $listeners = [];

    protected $aliases = [];

    protected $bindings = [
        'contact' => ContactFormBuilder::class
    ];

    protected $providers = [];

    protected $singletons = [];

    protected $overrides = [];

    protected $mobile = [];

    /**
     * Register the addon.
     */
    public function register(AddonIntegrator $integrator)
    {
        $integrator->register(
            realpath(__DIR__ .'/../addons/lwv/spam-field_type/'),
            'lwv.field_type.spam',
            true,
            true
        );
    }

    public function map()
    {
    }

}
