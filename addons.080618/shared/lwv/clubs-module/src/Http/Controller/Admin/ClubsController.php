<?php namespace Lwv\ClubsModule\Http\Controller\Admin;

use Lwv\ClubsModule\Club\Form\ClubFormBuilder;
use Lwv\ClubsModule\Club\Table\ClubTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;

class ClubsController extends AdminController
{

    /**
     * Display an index of existing entries.
     */
    public function index(ClubTableBuilder $table, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.clubs::clubs.manage')) {
            if ($authorizer->authorize('lwv.module.clubs::websites.manage')) {
                return redirect('/admin/clubs/websites',302);
            }

            abort(403);
        }

        return $table->render();
    }

    /**
     * Create a new entry.
     */
    public function create(ClubFormBuilder $form, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.clubs::clubs.manage')) {
            abort(403);
        }

        return $form->render();
    }

    /**
     * Edit an existing entry.
     */
    public function edit(ClubFormBuilder $form, Authorizer $authorizer, $id)
    {
        if (!$authorizer->authorize('lwv.module.clubs::clubs.manage')) {
            abort(403);
        }

        return $form->render($id);
    }
}
