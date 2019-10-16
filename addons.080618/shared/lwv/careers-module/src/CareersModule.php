<?php namespace Lwv\CareersModule;

use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;

class CareersModule extends Module
{

    /**
     * The navigation icon.
     *
     * @var string
     */
    protected $icon = 'fa fa-graduation-cap';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'jobs' => [
            'buttons' => [
                'new_job' => [
                    'href'        => 'admin/careers/create',
                ]
            ]
        ],
        'applicants' => [],
    ];

    /**
     * Fired just before module is installed.
     */
    public function onInstalling(DiskRepositoryInterface $disks, FolderRepositoryInterface $folders)
    {
        if ($disk = $disks->findBySlug('local')) {
            if (!$folder = $folders->findBySlug('careers_attachments')) {
                $folders->create(
                    [
                        'en'            => [
                            'name'        => 'Careers Attachments',
                            'description' => 'Careers Module',
                        ],
                        'slug'          => 'careers_attachments',
                        'disk'          => $disk,
                    ]
                );
            }
        }
    }
}
