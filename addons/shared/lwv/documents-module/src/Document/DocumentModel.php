<?php namespace Lwv\DocumentsModule\Document;

use Lwv\DocumentsModule\Document\Contract\DocumentInterface;
use Anomaly\Streams\Platform\Model\Documents\DocumentsDocumentsEntryModel;

class DocumentModel extends DocumentsDocumentsEntryModel implements DocumentInterface
{
    public function getDocumentPath() {
        $file = $this->document;
        return $file->resource()->getAdapter()->applyPathPrefix($file->folder->slug.'/'.$file->name);
    }

    public function getDocumentText() {
        $util = '/usr/local/bin/pdftotext';

        if (!file_exists($util)) {
            abort(500,'Executeable /usr/bin/pdftotext not found');
        }

        exec($util." \"" . $this->getDocumentPath() . "\" - -nopgbrk -q", $output, $ret);

        return ($ret == 0) ? implode(' ',$output) : false;
    }

    public function getDocumentType() {
        $file = $this->document;
        return $file->type();
    }

    public function view() {
        return '/documents/view/'.$this->document->name;
    }

    public function download() {
        return '/documents/download/'.$this->document->name;
    }

    /**
     * Return the resolutions relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function resolutions()
    {
        return $this->hasMany('Lwv\DocumentsModule\Resolution\ResolutionModel', 'minutes_id', 'id')
            ->orderBy('number', 'DESC');
    }
}
