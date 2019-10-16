<?php namespace Lwv\ClubsModule\Http\Controller\Admin;

use Lwv\ClubsModule\Club\Contract\ClubRepositoryInterface;
use Lwv\ClubsModule\Document\Contract\DocumentRepositoryInterface;
use Lwv\ClubsModule\Document\Form\DocumentFormBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;
use Lwv\ClubsModule\Document\Table\DocumentTableBuilder;


class DocumentsController extends AdminController
{
    /**
     * Display an index of existing entries.
     */
    public function index(ClubRepositoryInterface $clubRepository, DocumentTableBuilder $table, Authorizer $authorizer, $id)
    {
        if (!$authorizer->authorize('lwv.module.clubs::websites.manage')) {
            abort(403);
        }

        $clubs = $clubRepository->myClubs();

        if (!$club = $clubs->find($id)) {
            abort(404);
        }

        return $table->setClub($club)->render();
    }

    /**
     * Create a new entry.
     *
     * @param DocumentFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(DocumentFormBuilder $form, ClubRepositoryInterface $clubRepository, Authorizer $authorizer, $id)
    {
        if (!$authorizer->authorize('lwv.module.clubs::websites.manage')) {
            abort(403);
        }

        $clubs = $clubRepository->myClubs();

        if (!$club = $clubs->find($id)) {
            abort(404);
        }

        return $form->setClub($club)->render();
    }

    /**
     * Edit an existing entry.
     */
    public function edit(DocumentFormBuilder $form, ClubRepositoryInterface $clubRepository, DocumentRepositoryInterface $documentRepository, Authorizer $authorizer, $cid, $id)
    {
        if (!$authorizer->authorize('lwv.module.clubs::websites.manage')) {
            abort(403);
        }

        $clubs = $clubRepository->myClubs();

        if (!$club = $clubs->find($cid)) {
            abort(404);
        }

        if (!$document = $documentRepository->find($id)) {
            abort(404);
        }

        return $form->setClub($club)->render($id);
    }
}
