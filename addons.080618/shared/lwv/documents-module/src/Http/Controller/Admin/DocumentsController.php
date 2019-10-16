<?php namespace Lwv\DocumentsModule\Http\Controller\Admin;

use Lwv\DocumentsModule\Document\Form\DocumentFormBuilder;
use Lwv\DocumentsModule\Document\Table\DocumentTableBuilder;
use Lwv\DocumentsModule\Folder\Contract\FolderRepositoryInterface;
use Lwv\DocumentsModule\Document\Contract\DocumentRepositoryInterface;
use Lwv\DocumentsModule\Document\DocumentModel;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Illuminate\Routing\Redirector;

class DocumentsController extends AdminController
{
    /**
     * Index
     */
    public function overview()
    {
        return view('lwv.module.documents::admin.documents');
    }

    /**
     * Redirect to documents page
     */
    public function redirect(DocumentRepositoryInterface $documents, $id)
    {
        $document = $documents->find($id);
        return $this->response->redirectTo('admin/documents/documents/'.$document->folder->id);
    }

    /**
     * Display an index of existing entries.
     *
     * @param DocumentTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(DocumentTableBuilder $table, FolderRepositoryInterface $folders, $folder = null)
    {
        if (!$folder) {
            $this->messages->warning('Please choose a folder first.');

            return $this->response->redirectTo('admin/documents');
        }

        $table->setFolder($folder = $folders->find($folder));

        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param DocumentFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(DocumentFormBuilder $form, FolderRepositoryInterface $folders, $folder)
    {
        $form->setFolder($folders->find($folder));

        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param DocumentFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(DocumentFormBuilder $form, FolderRepositoryInterface $folders, $folder, $id)
    {
        $form->setFolder($folders->find($folder));

        return $form->render($id);
    }

    /**
     * View a document
     */
    public function view(DocumentModel $documents, Redirector $redirect,$id) {
        // Retrieve document
        if (!$document = $documents->find($id)) {
            abort(404);
        }

        return $redirect->to('/documents/view/'.$document->id.'/'.$document->document->name);
    }
}
