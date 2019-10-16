<?php namespace Lwv\DataModule\Http\Controller\Admin;

use Lwv\DataModule\Education\Form\EducationFormBuilder;
use Lwv\DataModule\Education\Table\EducationTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;

class EducationController extends AdminController
{

    /**
     * Display an index of existing entries.
     */
    public function index(EducationTableBuilder $table, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.data::education.manage')) {
            abort(403);
        }

        return $table->render();
    }

    /**
     * Create a new entry.
     */
    public function create(EducationFormBuilder $form, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.data::education.manage')) {
            abort(403);
        }

        return $form->render();
    }

    /**
     * Edit an existing entry.
     */
    public function edit(EducationFormBuilder $form, Authorizer $authorizer, $id)
    {
        if (!$authorizer->authorize('lwv.module.data::education.manage')) {
            abort(403);
        }

        return $form->render($id);
    }
}
