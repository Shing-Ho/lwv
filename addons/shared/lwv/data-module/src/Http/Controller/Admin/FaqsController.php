<?php namespace Lwv\DataModule\Http\Controller\Admin;

use Lwv\DataModule\Faq\Form\FaqFormBuilder;
use Lwv\DataModule\Faq\Table\FaqTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;

class FaqsController extends AdminController
{

    /**
     * Display an index of existing entries.
     */
    public function index(FaqTableBuilder $table, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.data::faqs.manage')) {
            abort(403);
        }

        return $table->render();
    }

    /**
     * Create a new entry.
     */
    public function create(FaqFormBuilder $form, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.data::faqs.manage')) {
            abort(403);
        }

        return $form->render();
    }

    /**
     * Edit an existing entry.
     */
    public function edit(FaqFormBuilder $form, Authorizer $authorizer, $id)
    {
        if (!$authorizer->authorize('lwv.module.data::faqs.manage')) {
            abort(403);
        }

        return $form->render($id);
    }
}
