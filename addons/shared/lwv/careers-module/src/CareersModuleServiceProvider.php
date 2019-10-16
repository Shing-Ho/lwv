<?php namespace Lwv\CareersModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

class CareersModuleServiceProvider extends AddonServiceProvider
{

    protected $plugins = ['Lwv\CareersModule\CareersModulePlugin'];

    protected $routes = [
        'admin/careers' => 'Lwv\CareersModule\Http\Controller\Admin\JobsController@index',
        'admin/careers/create' => 'Lwv\CareersModule\Http\Controller\Admin\JobsController@create',
        'admin/careers/edit/{id}' => 'Lwv\CareersModule\Http\Controller\Admin\JobsController@edit',
        'admin/careers/applicants' => 'Lwv\CareersModule\Http\Controller\Admin\ApplicantsController@index',
        //'admin/careers/create' => 'Lwv\CareersModule\Http\Controller\Admin\ApplicantsController@create',
        'admin/careers/applicants/edit/{id}' => 'Lwv\CareersModule\Http\Controller\Admin\ApplicantsController@edit',
        'admin/careers/applicants/view/{id}' => 'Lwv\CareersModule\Http\Controller\Admin\ApplicantsController@view',
        'ajax/careers/search' => 'Lwv\CareersModule\Http\Controller\SearchController@search'
    ];

    protected $middleware = [];

    protected $listeners = [];

    protected $aliases = [];

    protected $bindings = [
        'career_search' => 'Lwv\CareersModule\Search\Form\SearchFormBuilder',
        'career_application' => 'Lwv\CareersModule\Search\Form\ApplicationFormBuilder',
    ];

    protected $providers = [];

    protected $singletons = [];

    protected $overrides = [];

    protected $mobile = [];

    protected $commands = [
        'Lwv\CareersModule\Job\Console\PullApplications'
    ];


    public function register()
    {
    }

    public function map()
    {
    }

}
