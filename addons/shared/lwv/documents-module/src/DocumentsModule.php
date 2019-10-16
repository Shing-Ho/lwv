<?php namespace Lwv\DocumentsModule;

use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;

class DocumentsModule extends Module
{

    /**
     * This module does not
     * display in navigation.
     *
     * @var bool
     */
    protected $navigation = true;

    /**
     * The navigation icon.
     *
     * @var string
     */
    protected $icon = 'fa fa-files-o';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'index' => [],
        'folders' => [
            'buttons' => [
                'new_folder' => [
                    'permission' => 'lwv.module.documents::folders.manage',
                ]
            ]
        ],
        'documents' => [
            'slug'        => 'documents',
            'data-toggle' => 'modal',
            'data-target' => '#modal',
            'data-href'   => 'admin/documents/documents/{request.route.parameters.folder}',
            'href'        => 'admin/documents/folders/choose',

            'buttons' => [
                'new_document' => [
                    'href' => 'admin/documents/documents/{request.route.parameters.folder}/create',
                ],
                'back_folders' => [
                    'href' => 'admin/documents/folders',
                    'icon' => 'fa fa-folder-open-o'
                ]
            ]
        ],
        'resolutions' => [
            'slug'        => 'resolutions',
            'data-toggle' => 'modal',
            'data-target' => '#modal',
            'data-href'   => 'admin/documents/resolutions/{request.route.parameters.document}',
            'href'        => 'admin/documents/folders/minutes',

            'buttons' => [
                'new_resolution' => [
                    'href' => 'admin/documents/resolutions/{request.route.parameters.document}/create',
                ],
                'back_documents' => [
                    'href' => 'admin/documents/redirect/{request.route.parameters.document}',
                    'icon' => 'fa fa-files-o'
                ],
            ]
        ],
    ];

    /**
     * Fired just before module is installed.
     */
    public function onInstalling(DiskRepositoryInterface $disks, FolderRepositoryInterface $folders)
    {
        if ($disk = $disks->findBySlug('private')) {
            if (!$folder = $folders->findBySlug('documents')) {
                $folders->create(
                    [
                        'en'            => [
                            'name'        => 'Documents',
                            'description' => 'Documents Module',
                        ],
                        'slug'          => 'documents',
                        'disk'          => $disk,
                        'allowed_types' => [
                            'pdf'
                        ],
                    ]
                );
            }
        }
    }

}