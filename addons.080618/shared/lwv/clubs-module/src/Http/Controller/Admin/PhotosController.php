<?php namespace Lwv\ClubsModule\Http\Controller\Admin;

use Lwv\ClubsModule\Club\Contract\ClubRepositoryInterface;
use Lwv\ClubsModule\Photo\Contract\PhotoRepositoryInterface;
use Lwv\ClubsModule\Photo\Form\PhotoFormBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;
use Lwv\ClubsModule\Photo\Table\PhotoTableBuilder;


class PhotosController extends AdminController
{
    /**
     * Display an index of existing entries.
     */
    public function index(ClubRepositoryInterface $clubRepository, PhotoTableBuilder $table, Authorizer $authorizer, $id)
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
     * @param PhotoFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(PhotoFormBuilder $form, ClubRepositoryInterface $clubRepository, Authorizer $authorizer, $id)
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
    public function edit(PhotoFormBuilder $form, ClubRepositoryInterface $clubRepository, PhotoRepositoryInterface $photoRepository, Authorizer $authorizer, $cid, $id)
    {
        if (!$authorizer->authorize('lwv.module.clubs::websites.manage')) {
            abort(403);
        }

        $clubs = $clubRepository->myClubs();

        if (!$club = $clubs->find($cid)) {
            abort(404);
        }

        if (!$photo = $photoRepository->find($id)) {
            abort(404);
        }

        return $form->setClub($club)->render($id);
    }
}
