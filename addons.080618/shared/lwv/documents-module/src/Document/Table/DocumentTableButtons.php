<?php namespace Lwv\DocumentsModule\Document\Table;

use Lwv\DocumentsModule\Document\Contract\DocumentInterface;

/**
 * Class DocumentTableButtons
 */
class DocumentTableButtons
{

    /**
     * Handle the command.
     *
     * @param DocumentTableButtons $builder
     */
    public function handle(DocumentTableBuilder $builder)
    {
        $builder->setButtons(
            [
                'edit',
                'resolutions'  => [
                    'text'        => 'lwv.module.documents::button.resolutions',
                    'href'        => 'admin/documents/resolutions/{entry.id}',
                    'class'       => 'btn-info',
                    'icon'        => 'fa fa-legal',
                    'permission'  => 'lwv.module.documents::documents.manage',
                    'enabled'     => function (DocumentInterface $entry) {
                        return $entry->folder->folder_type == 'minutes';
                    },
                ],
                'view' => [
                    'href' => '/admin/documents/documents/view/{entry.id}',
                    'target' => '_blank',
                ]
            ]
        );
    }
}
