<?php namespace Lwv\DocumentsModule;

use Lwv\DocumentsModule\Folder\Contract\FolderRepositoryInterface;
use Lwv\DocumentsModule\Folder\FolderRepository;
use Lwv\DocumentsModule\Document\Contract\DocumentRepositoryInterface;
use Lwv\DocumentsModule\Document\DocumentRepository;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

class DocumentsModuleServiceProvider extends AddonServiceProvider
{
    protected $plugins = ['Lwv\DocumentsModule\DocumentsModulePlugin'];

    protected $routes = [
        'admin/documents' => 'Lwv\DocumentsModule\Http\Controller\Admin\DocumentsController@overview',
        'admin/documents/redirect/{document}' => 'Lwv\DocumentsModule\Http\Controller\Admin\DocumentsController@redirect',
        // Folders
        'admin/documents/folders' => 'Lwv\DocumentsModule\Http\Controller\Admin\FoldersController@index',
        'admin/documents/folders/create' => 'Lwv\DocumentsModule\Http\Controller\Admin\FoldersController@create',
        'admin/documents/folders/edit/{id}' => 'Lwv\DocumentsModule\Http\Controller\Admin\FoldersController@edit',
        'admin/documents/folders/delete/{id}' => 'Lwv\DocumentsModule\Http\Controller\Admin\FoldersController@delete',
        'admin/documents/folders/choose' => 'Lwv\DocumentsModule\Http\Controller\Admin\FoldersController@choose',
        'admin/documents/folders/minutes' => 'Lwv\DocumentsModule\Http\Controller\Admin\FoldersController@minutes',
        // Documents
        'admin/documents/documents/{folder?}' => 'Lwv\DocumentsModule\Http\Controller\Admin\DocumentsController@index',
        'admin/documents/documents/{folder}/create' => 'Lwv\DocumentsModule\Http\Controller\Admin\DocumentsController@create',
        'admin/documents/documents/{folder}/edit/{id}' => 'Lwv\DocumentsModule\Http\Controller\Admin\DocumentsController@edit',
        'admin/documents/documents/view/{id}' => 'Lwv\DocumentsModule\Http\Controller\Admin\DocumentsController@view',
        // Resolutions
        'admin/documents/resolutions/{document?}' => 'Lwv\DocumentsModule\Http\Controller\Admin\ResolutionsController@index',
        'admin/documents/resolutions/{document}/create' => 'Lwv\DocumentsModule\Http\Controller\Admin\ResolutionsController@create',
        'admin/documents/resolutions/{document}/edit/{id}' => 'Lwv\DocumentsModule\Http\Controller\Admin\ResolutionsController@edit',
        // Public routes
        'documents/download/{name}' => 'Lwv\DocumentsModule\Http\Controller\DocumentsController@download',
        'documents/view/{name}' => 'Lwv\DocumentsModule\Http\Controller\DocumentsController@read',
        'documents/download/{id}/{name}' => 'Lwv\DocumentsModule\Http\Controller\DocumentsController@downloadById',
        'documents/view/{id}/{name}' => 'Lwv\DocumentsModule\Http\Controller\DocumentsController@readById',
    ];

    protected $middleware = [];

    protected $listeners = [];

    protected $providers = [];

    protected $singletons = [
        FolderRepositoryInterface::class => FolderRepository::class,
        DocumentRepositoryInterface::class => DocumentRepository::class,
    ];

    protected $overrides = [];

    protected $mobile = [];

    protected $commands = [
        'Lwv\DocumentsModule\Document\Console\Status',
        //'Lwv\DocumentsModule\Document\Console\LoadFiles',
        //'Lwv\DocumentsModule\Document\Console\LoadDocuments',
        //'Lwv\DocumentsModule\Resolution\Console\LoadMetadata',
        //'Lwv\DocumentsModule\Resolution\Console\LoadResolutions',
    ];

    public function map()
    {
    }
}
