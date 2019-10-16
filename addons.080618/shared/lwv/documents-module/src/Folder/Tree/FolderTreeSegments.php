<?php namespace Lwv\DocumentsModule\Folder\Tree;

use Lwv\DocumentsModule\Folder\Contract\FolderInterface;

/**
 * Class FolderTreeSegments
 */
class FolderTreeSegments
{

    /**
     * Handle the tree segments.
     *
     * @param FolderTreeBuilder $builder
     */
    public function handle(FolderTreeBuilder $builder)
    {
        $authorizer = app('Anomaly\Streams\Platform\Support\Authorizer');

        $builder->setSegments(
            [
                ($authorizer->authorize('lwv.module.documents::folders.manage')) ? 'entry.edit_link' : 'entry.title',
                [
                    'data-toggle' => 'tooltip',
                    'class'       => 'text-danger',
                    'value'       => '<i class="fa fa-ban"></i>',
                    'attributes'  => [
                        'title' => 'module::message.disabled',
                    ],
                    'enabled'     => function (FolderInterface $entry) {
                        return !$entry->isEnabled();
                    },
                ],
                [
                    'data-toggle' => 'tooltip',
                    'class'       => '',
                    'value'       => '<i class="fa fa-file-o"></i>',
                    'attributes'  => [
                        'title' => function (FolderInterface $entry) {
                            return $entry->getDocuments()->count();
                        },
                    ],
                    'enabled'     => function (FolderInterface $entry) {
                        return $entry->hasDocuments();
                    },
                ],
                [
                    'data-toggle' => 'tooltip',
                    'class'       => '',
                    'value'       => '<i class="fa fa-search"></i>',
                    'attributes'  => [
                        'title' => 'Searchable',
                    ],
                    'enabled'     => function (FolderInterface $entry) {
                        return $entry->searchable;
                    },
                ],
                [
                    'data-toggle' => 'tooltip',
                    'class'       => '',
                    'value'       => '<i class="fa fa-legal"></i>',
                    'attributes'  => [
                        'title' => 'Board Minutes',
                    ],
                    'enabled'     => function (FolderInterface $entry) {
                        return $entry->folder_type == 'minutes';
                    },
                ],
            ]
        );
    }
}
