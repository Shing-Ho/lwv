<?php namespace Lwv\DataModule;

use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;

class DataModule extends Module
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
    protected $icon = 'fa fa-database';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'streams' => [],
        'contacts' => [
            'buttons' => [
                'new_contact' => [
                    'permission' => 'lwv.module.data::contacts.manage',
                ]
            ]
        ],
        'education' => [
            'buttons' => [
                'new_education' => [
                    'permission' => 'lwv.module.data::education.manage',
                ]
            ]
        ],
        'floorplans' => [
            'buttons' => [
                'new_floorplan' => [
                    'permission' => 'lwv.module.data::floorplans.manage',
                ]
            ]
        ],
        'faqs' => [
            'buttons' => [
                'new_faq' => [
                    'permission' => 'lwv.module.data::faqs.manage',
                ]
            ]
        ],
        'testimonials' => [
            'buttons' => [
                'new_testimonial'
            ]
        ],
    ];

    /**
     * Fired just before module is installed.
     */
    public function onInstalling(DiskRepositoryInterface $disks, FolderRepositoryInterface $folders)
    {
        if ($disk = $disks->findBySlug('local')) {
            if (!$folder = $folders->findBySlug('floorplans')) {
                $folders->create(
                    [
                        'en'            => [
                            'name'        => 'Floorplans',
                            'description' => 'Data Module',
                        ],
                        'slug'          => 'floorplans',
                        'disk'          => $disk,
                        'allowed_types' => [
                            'jpg',
                            'jpeg',
                            'pdf'
                        ],
                    ]
                );
            }
        }
    }

}