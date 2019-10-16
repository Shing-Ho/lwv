<?php namespace Lwv\ClubsModule\Document\Table;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

/**
 * Class DocumentTableButtons
 */
class DocumentTableButtons
{

    /**
     * Handle the command.
     */
    public function handle(DocumentTableBuilder $builder)
    {
        $builder->setButtons(
            [
                'edit' => [
                    'href' => 'admin/clubs/websites/documents/{request.route.parameters.club}/edit/{entry.id}'
                ],
                'view' => [
                    'href' => function (EntryInterface $entry) {
                        return $entry->view();
                    },
                    'target' => '_blank'
                ],
            ]
        );
    }
}
