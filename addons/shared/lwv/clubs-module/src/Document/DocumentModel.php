<?php namespace Lwv\ClubsModule\Document;

use Lwv\ClubsModule\Document\Contract\DocumentInterface;
use Anomaly\Streams\Platform\Model\Clubs\ClubsDocumentsEntryModel;

class DocumentModel extends ClubsDocumentsEntryModel implements DocumentInterface
{
    public function getDocumentType() {
        $file = $this->document;
        return $file->type();
    }

    public function view() {
        return '/clubs/documents/view/'.$this->document->name;
    }

    public function download() {
        return '/clubs/documents/download/'.$this->document->name;
    }
}
