<?php namespace Lwv\MessagingModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

class MessagingModuleServiceProvider extends AddonServiceProvider
{

    protected $plugins = [];

    protected $commands = [
        'Lwv\MessagingModule\Queue\Console\ProcessQueue',
    ];

    protected $routes = [
        'admin/messaging' => 'Lwv\MessagingModule\Http\Controller\Admin\QueueController@index',
        'admin/messaging/create' => 'Lwv\MessagingModule\Http\Controller\Admin\QueueController@create',
        'admin/messaging/edit/{id}' => 'Lwv\MessagingModule\Http\Controller\Admin\QueueController@edit',
        'admin/messaging/view/{id}' => 'Lwv\MessagingModule\Http\Controller\Admin\QueueController@view',
        'admin/messaging/test' => 'Lwv\MessagingModule\Http\Controller\Admin\QueueController@test'
    ];

    protected $middleware = [];

    protected $listeners = [];

    protected $aliases = [];

    protected $bindings = [

    ];

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

    protected $schedules = [
        'everyMinute' => [
            'messaging:process',
        ],
    ];
}
