<?php namespace Lwv\FormsExtension;

use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;

class FormsExtension extends Extension
{

    /**
     * This extension provides...
     *
     * This should contain the dot namespace
     * of the addon this extension is for followed
     * by the purpose.variation of the extension.
     *
     * For example anomaly.module.store::gateway.stripe
     *
     * @var null|string
     */
    protected $provides = null;

    /**
     * Fired just before module is installed.
     */
    public function onInstalling(DiskRepositoryInterface $disks, FolderRepositoryInterface $folders)
    {
        if ($disk = $disks->findBySlug('local')) {
            if (!$folder = $folders->findBySlug('forms_attachments')) {
                $folders->create(
                    [
                        'en'            => [
                            'name'        => 'Forms Attachments',
                            'description' => 'Forms Extension',
                        ],
                        'slug'          => 'forms_attachments',
                        'disk'          => $disk,
                        'allowed_types' => [
                            'jpeg',
                            'jpg'
                        ],
                    ]
                );
            }
        }
    }
}
