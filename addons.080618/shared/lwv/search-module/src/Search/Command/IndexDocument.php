<?php namespace Lwv\SearchModule\Search\Command;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Lwv\SearchModule\Search\Index\IndexManager;
use Lwv\DocumentsModule\Document\DocumentModel;

/**
 * Class IndexDocument
 */
class IndexDocument
{
    use DispatchesJobs;

    /**
     * The index.
     */
    protected $index;

    /**
     * The document.
     */
    protected $document;

    /**
     * Create a new IndexDocument instance.
     */
    public function __construct(DocumentModel $document)
    {
        $this->index = 'documents';
        $this->document = $document;
    }

    /**
     * Handle the command.
     */
    public function handle(IndexManager $index)
    {
        $index->setIndex($this->index);
        $index->delete(['id' => $this->document->id]);

        if ($this->document->folder->searchable) {
            $text = $this->document->getDocumentText();

            $index->insert(
                [
                    'id' => $this->document->id,
                    'fields' => [
                        'title' => $this->document->title,
                        'content' => $text,
                        'private' => (int) $this->document->private,
                    ],
                    'extra' => [
                        'title' => $this->document->title,
                        'content' => $text,
                        'private' => (int) $this->document->private,
                        'type' => 'document',
                        'document' => $this->document->id,
                        'path' => $this->document->folder->path,
                        'link' => '/documents/view/'.$this->document->document->name,
                        'timestamp' => $this->document->lastModified()->timestamp,
                    ]
                ]
            );
        }
    }
}
