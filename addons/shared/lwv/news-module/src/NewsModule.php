<?php namespace Lwv\NewsModule;

use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;

/**
 * Class NewsModule
 */
class NewsModule extends Module
{

    /**
     * The module's icon.
     *
     * @var string
     */
    protected $icon = 'newspaper';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'posts'      => [
            'buttons' => [
                'new_post' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/news/choose',
                ]
            ]
        ],
        'categories' => [
            'buttons' => [
                'new_category'
            ]
        ],
        'types'      => [
            'buttons' => [
                'new_type',
            ]
        ],
        'fields'     => [
            'buttons'  => [
                'new_field' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/news/fields/choose',
                ],
            ],
            'sections' => [
                'assignments' => [
                    'hidden'  => true,
                    'href'    => 'admin/news/fields/assignments/{request.route.parameters.stream}',
                    'buttons' => [
                        'assign_fields' => [
                            'data-toggle' => 'modal',
                            'data-target' => '#modal',
                            'href'        => 'admin/news/fields/assignments/{request.route.parameters.stream}/choose',
                        ],
                    ],
                ],
            ],
        ]
    ];

    /**
     * Fired just before module is installed.
     */
    public function onInstalling(DiskRepositoryInterface $disks, FolderRepositoryInterface $folders)
    {
        if ($disk = $disks->findBySlug('local')) {
            if (!$folder = $folders->findBySlug('news_images')) {
                $folders->create(
                    [
                        'en'            => [
                            'name'        => 'News Images',
                            'description' => 'News Module',
                        ],
                        'slug'          => 'news_images',
                        'disk'          => $disk,
                        'allowed_types' => [
                            'jpeg',
                            'jpg',
                            'png'
                        ],
                    ]
                );
            }

            if (!$folder = $folders->findBySlug('news_documents')) {
                $folders->create(
                    [
                        'en'            => [
                            'name'        => 'News Documents',
                            'description' => 'News Module',
                        ],
                        'slug'          => 'news_documents',
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
