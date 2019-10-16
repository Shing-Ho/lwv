<?php namespace Lwv\DataModule\Http\Controller\Admin;

use Lwv\DataModule\Floorplan\Form\FloorplanFormBuilder;
use Lwv\DataModule\Floorplan\Table\FloorplanTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;

class FloorplansController extends AdminController
{

    /**
     * Display an index of existing entries.
     */
    public function index(FloorplanTableBuilder $table, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.data::floorplans.manage')) {
            abort(403);
        }

        return $table->render();
    }

    /**
     * Create a new entry.
     */
    public function create(FloorplanFormBuilder $form, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.data::floorplans.manage')) {
            abort(403);
        }

        return $form->render();
    }

    /**
     * Edit an existing entry.
     */
    public function edit(FloorplanFormBuilder $form, Authorizer $authorizer, $id)
    {
        if (!$authorizer->authorize('lwv.module.data::floorplans.manage')) {
            abort(403);
        }

        return $form->render($id);
    }
}
