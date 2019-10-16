<?php namespace Lwv\DocumentsModule\Http\Controller;

use Anomaly\FilesModule\File\FileLocator;
use Anomaly\FilesModule\File\FileDownloader;
use Anomaly\FilesModule\File\FileReader;
use Anomaly\FilesModule\File\FileStreamer;
use Anomaly\Streams\Platform\Support\Authorizer;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Application\Application;
use Lwv\DocumentsModule\Document\DocumentModel;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;


/**
 * Class DocumentsController
 */
class DocumentsController extends PublicController
{
    
    /**
     * Download a document
     */
    public function download(FileLocator $locator, FileDownloader $downloader, Request $request, Redirector $redirect, $name)
    {
        if (!$file = $locator->locate('documents', urldecode($name))) {
            abort(404);
        }

        // Prevent caching by appending version info
        if (!$request->input('v')) {
            return $redirect->to($request->path().'?v='.$file->lastModified()->timestamp);
        }

        return $downloader->download($file);
    }

    /**
     * Return a documents file contents.
     */
    public function downloadById(DocumentModel $documents, FileDownloader $downloader, Request $request, Redirector $redirect, $id, $name)
    {
        if (!$document = $documents->find($id)) {
            abort(404);
        }

        // Prevent caching by appending version info
        if (!$request->input('v')) {
            return $redirect->to($request->path().'?v='.$document->document->lastModified()->timestamp);
        }

        return $downloader->download($document->document);
    }

    /**
     * Return a documents file contents.
     */
    public function read(FileLocator $locator, FileReader $reader, Request $request, Redirector $redirect, $name)
    {
        if (!$file = $locator->locate('documents', urldecode($name))) {
            abort(404);
        }

        // Prevent caching by appending version info
        if (!$request->input('v')) {
            return $redirect->to($request->path().'?v='.$file->lastModified()->timestamp);
        }

        return $reader->read($file);
    }

    /**
     * Return a documents file contents.
     */
    public function readById(DocumentModel $documents, FileReader $reader, Request $request, Redirector $redirect, $id, $name)
    {
        if (!$document = $documents->find($id)) {
            abort(404);
        }

        // Prevent caching by appending version info
        if (!$request->input('v')) {
            return $redirect->to($request->path().'?v='.$document->document->lastModified()->timestamp);
        }

        return $reader->read($document->document);
    }
}
