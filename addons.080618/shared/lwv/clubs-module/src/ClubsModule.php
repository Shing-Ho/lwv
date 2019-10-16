<?php namespace Lwv\ClubsModule;

use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;

class ClubsModule extends Module
{

    /**
     * The navigation icon.
     *
     * @var string
     */
    protected $icon = 'fa fa-group';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'clubs' => [
            'permission' => 'lwv.module.clubs::clubs.manage',
            'buttons' => [
                'new_club' => [
                    'href' => 'admin/clubs/create',
                ]
            ]
        ],
        'headers' => [
            'permission' => 'lwv.module.clubs::clubs.manage',
            'buttons' => [
                'new_header' => [
                    'href' => 'admin/clubs/headers/create',
                ]
            ]
        ],
        'websites' => [
            'permission' => 'lwv.module.clubs::websites.manage',
            'sections' => [
                'documents' => [
                    'permission' => 'lwv.module.clubs::websites.manage',
                    'href'    => 'admin/clubs/websites/documents',
                    'buttons' => [
                        'new_document' => [
                            'href' => 'admin/clubs/websites/documents/{request.route.parameters.club}/create',
                        ],
                        'manage' => [
                            'href' => 'admin/clubs/websites/manage/{request.route.parameters.club}',
                            'icon' => 'fa fa-gears'
                        ],
                        'preview' => [
                            'href' => 'admin/clubs/websites/preview/{request.route.parameters.club}',
                            'icon' => 'fa fa-globe',
                            'target' => '_blank'
                        ]
                    ],
                ],
                'photos' => [
                    'permission' => 'lwv.module.clubs::websites.manage',
                    'href'    => 'admin/clubs/websites/photos',
                    'buttons' => [
                        'new_photo' => [
                            'href' => 'admin/clubs/websites/photos/{request.route.parameters.club}/create',
                        ],
                        'manage' => [
                            'href' => 'admin/clubs/websites/manage/{request.route.parameters.club}',
                            'icon' => 'fa fa-gears'
                        ],
                        'preview' => [
                            'href' => 'admin/clubs/websites/preview/{request.route.parameters.club}',
                            'icon' => 'fa fa-globe',
                            'target' => '_blank'
                        ]
                    ],
                ],
                'posts' => [
                    'permission' => 'lwv.module.clubs::websites.manage',
                    'href'    => 'admin/clubs/websites/posts',
                    'buttons' => [
                        'new_post' => [
                            'href' => 'admin/clubs/websites/posts/{request.route.parameters.club}/create',
                        ],
                        'manage' => [
                            'href' => 'admin/clubs/websites/manage/{request.route.parameters.club}',
                            'icon' => 'fa fa-gears'
                        ],
                        'preview' => [
                            'href' => 'admin/clubs/websites/preview/{request.route.parameters.club}',
                            'icon' => 'fa fa-globe',
                            'target' => '_blank'
                        ]
                    ],
                ],
            ],
        ],
    ];

    /**
     * Fired just before module is installed.
     */
    public function onInstalling(DiskRepositoryInterface $disks, FolderRepositoryInterface $folders)
    {
        if ($disk = $disks->findBySlug('local')) {
            if (!$folder = $folders->findBySlug('clubs_images')) {
                $folders->create(
                    [
                        'en'            => [
                            'name'        => 'Clubs Images',
                            'description' => 'Clubs Module',
                        ],
                        'slug'          => 'clubs_images',
                        'disk'          => $disk,
                        'allowed_types' => [
                            'jpeg',
                            'jpg',
                            'png'
                        ],
                    ]
                );
            }

            if (!$folder = $folders->findBySlug('clubs_documents')) {
                $folders->create(
                    [
                        'en'            => [
                            'name'        => 'Clubs Documents',
                            'description' => 'Clubs Module',
                        ],
                        'slug'          => 'clubs_documents',
                        'disk'          => $disk,
                        'allowed_types' => [
                            'pdf'
                        ],
                    ]
                );
            }

            if (!$folder = $folders->findBySlug('block_header_images')) {
                $folders->create(
                    [
                        'en'            => [
                            'name'        => 'Block Header Images',
                            'description' => 'Blocks Module',
                        ],
                        'slug'          => 'block_header_images',
                        'disk'          => $disk,
                        'allowed_types' => [
                            'jpeg',
                            'jpg',
                            'png'
                        ],
                    ]
                );
            }
        }
    }
}
