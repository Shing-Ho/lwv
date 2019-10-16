<?php namespace Lwv\DataModule\Http\Controller\Admin;

use Lwv\DataModule\Club\Form\ClubFormBuilder;
use Lwv\DataModule\Club\Table\ClubTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;

class ClubsController extends AdminController
{

    /**
     * Display an index of existing entries.
     */
    public function index(ClubTableBuilder $table, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.data::clubs.manage')) {
            abort(403);
        }

        return $table->render();
    }

    /**
     * Create a new entry.
     */
    public function create(ClubFormBuilder $form, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.data::clubs.manage')) {
            abort(403);
        }

        return $form->render();
    }

    /**
     * Edit an existing entry.
     */
    public function edit(ClubFormBuilder $form, Authorizer $authorizer, $id)
    {
        if (!$authorizer->authorize('lwv.module.data::clubs.manage')) {
            abort(403);
        }

        return $form->render($id);
    }
}
