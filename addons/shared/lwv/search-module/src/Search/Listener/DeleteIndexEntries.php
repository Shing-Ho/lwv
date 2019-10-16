<?php namespace Lwv\SearchModule\Search\Listener;

use Lwv\SearchModule\Search\Index\IndexManager;

/**
 * Class DeleteIndexEntries
 */
class DeleteIndexEntries
{
    protected $index;

    protected $config = [
        'Anomaly\PagesModule\Page\PageModel' => [
            'ix' => 'default',
            'field' => 'page',
        ],
        'Lwv\NewsModule\Post\PostModel' => [
            'ix' => 'default',
            'field' => 'newsposts',
        ],
        'Lwv\DocumentsModule\Document\DocumentModel' => [
            'ix' => 'documents',
            'field' => 'id',
        ],
        'Lwv\DocumentsModule\Folder\FolderModel' => [
            'ix' => 'documents',
            'truncate' => true,
            //'field' => 'id',
            //'loop' => 'getDocuments',
        ],
    ];

    protected $events = [
        'Anomaly\Streams\Platform\Entry\Event\EntryWasSaved',
        'Anomaly\Streams\Platform\Entry\Event\EntryWasDeleted',
    ];

    /**
     * Create a new DeleteIndexEntries instance.
     */
    public function __construct(IndexManager $index)
    {
        $this->index = $index;
    }

    /**
     * Handle the event.
     */
    public function handle($event)
    {
        if (!in_array(get_class($event),$this->events)) {
            abort(500);
        }

        $entry = $event->getEntry();

        // If this is one of the models we listen for
        if (in_array(get_class($entry),array_keys($this->config))) {
            $field = $this->getCfg($entry,'field');
            $func = $this->getCfg($entry,'loop');
            $trunc = $this->getCfg($entry,'truncate');

            // Set the index
            $this->index->setIndex($this->getCfg($entry,'ix'));

            if ($trunc) {
                // Destroy specified function
                $this->index->destroy();
            } elseif ($func) {
                // Loop through specified function
                foreach ($entry->$func() as $child) {
                    $key = $child->id;

                    // Delete index entry by specified id
                    if ($field == 'id') {
                        $this->index->delete(['id' => $key]);
                    } else {
                        $this->index->deleteBy(['field' => $field, 'value' => $key]);
                    }
                }
            } else {
                // Delete index entry by specified id
                $field = $this->getCfg($entry,'field');
                $key = $entry->id;

                // Delete index entry
                if ($field == 'id') {
                    $this->index->delete(['id' => $key]);
                } else {
                    $this->index->deleteBy(['field' => $field, 'value' => $key]);
                }
            }
        }
    }

    /**
     * Get config value
     */
    private function getCfg($entry,$val)
    {
        return (in_array(get_class($entry),array_keys($this->config)) && isset($this->config[get_class($entry)][$val])) ? $this->config[get_class($entry)][$val] : false;
    }
}
