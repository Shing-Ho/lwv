<?php namespace Lwv\DataModule;

use Anomaly\Streams\Platform\Addon\AddonIntegrator;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Lwv\DataModule\Education\Contract\EducationRepositoryInterface;
use Lwv\DataModule\Education\EducationRepository;

class DataModuleServiceProvider extends AddonServiceProvider
{
    protected $plugins = ['Lwv\DataModule\DataModulePlugin'];

    protected $routes = [
        // Streams
        'admin/data' => 'Lwv\DataModule\Http\Controller\Admin\StreamsController@index',
        // Education
        'admin/data/education' => 'Lwv\DataModule\Http\Controller\Admin\EducationController@index',
        'admin/data/education/create' => 'Lwv\DataModule\Http\Controller\Admin\EducationController@create',
        'admin/data/education/edit/{id}' => 'Lwv\DataModule\Http\Controller\Admin\EducationController@edit',
        // Floorplans
        'admin/data/floorplans' => 'Lwv\DataModule\Http\Controller\Admin\FloorplansController@index',
        'admin/data/floorplans/create' => 'Lwv\DataModule\Http\Controller\Admin\FloorplansController@create',
        'admin/data/floorplans/edit/{id}' => 'Lwv\DataModule\Http\Controller\Admin\FloorplansController@edit',
        // Contacts
        'admin/data/contacts' => 'Lwv\DataModule\Http\Controller\Admin\ContactsController@index',
        'admin/data/contacts/create' => 'Lwv\DataModule\Http\Controller\Admin\ContactsController@create',
        'admin/data/contacts/edit/{id}' => 'Lwv\DataModule\Http\Controller\Admin\ContactsController@edit',
        // FAQs
        'admin/data/faqs' => 'Lwv\DataModule\Http\Controller\Admin\FaqsController@index',
        'admin/data/faqs/create' => 'Lwv\DataModule\Http\Controller\Admin\FaqsController@create',
        'admin/data/faqs/edit/{id}' => 'Lwv\DataModule\Http\Controller\Admin\FaqsController@edit',
        // Testimonials
        'admin/data/testimonials' => 'Lwv\DataModule\Http\Controller\Admin\TestimonialsController@index',
        'admin/data/testimonials/create' => 'Lwv\DataModule\Http\Controller\Admin\TestimonialsController@create',
        'admin/data/testimonials/edit/{id}' => 'Lwv\DataModule\Http\Controller\Admin\TestimonialsController@edit',
    ];

    protected $middleware = [];

    protected $listeners = [];

    protected $providers = [];

    protected $singletons = [
        EducationRepositoryInterface::class => EducationRepository::class,
    ];

    protected $overrides = [];

    protected $mobile = [];

    protected $commands = [];

    public function map()
    {
    }
}
