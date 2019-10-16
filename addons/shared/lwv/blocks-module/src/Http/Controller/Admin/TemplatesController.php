<?php namespace Lwv\BlocksModule\Http\Controller\Admin;

use Lwv\BlocksModule\Template\Form\TemplateFormBuilder;
use Lwv\BlocksModule\Template\Table\TemplateTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;

class TemplatesController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param TemplateTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(TemplateTableBuilder $table, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.blocks::templates.manage')) {
            abort(403);
        }

        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param TemplateFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(TemplateFormBuilder $form, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.blocks::templates.manage')) {
            abort(403);
        }

        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param TemplateFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(TemplateFormBuilder $form, $id, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.blocks::templates.manage')) {
            abort(403);
        }

        return $form->render($id);
    }
}
