<?php namespace Lwv\DocumentsModule\Http\Controller\Admin;

use Lwv\DocumentsModule\Document\Contract\DocumentRepositoryInterface;
use Lwv\DocumentsModule\Resolution\Form\ResolutionFormBuilder;
use Lwv\DocumentsModule\Resolution\Table\ResolutionTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;

class ResolutionsController extends AdminController
{

    /**
     * Display an index of existing entries.
     */
    public function index(ResolutionTableBuilder $table, Authorizer $authorizer, DocumentRepositoryInterface $documents, $document)
    {
        if (!$authorizer->authorize('lwv.module.documents::documents.manage')) {
            abort(403);
        }

        $table->setDocument($documents->find($document));

        return $table->render();
    }

    /**
     * Create a new entry.
     */
    public function create(ResolutionFormBuilder $form, Authorizer $authorizer, DocumentRepositoryInterface $documents, $document)
    {
        if (!$authorizer->authorize('lwv.module.documents::documents.manage')) {
            abort(403);
        }

        $form->setDocument($documents->find($document));

        return $form->render();
    }

    /**
     * Edit an existing entry.
     */
    public function edit(ResolutionFormBuilder $form, Authorizer $authorizer, $document, $id)
    {
        if (!$authorizer->authorize('lwv.module.documents::documents.manage')) {
            abort(403);
        }

        return $form->render($id);
    }
}
