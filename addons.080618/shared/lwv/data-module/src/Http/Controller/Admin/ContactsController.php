<?php namespace Lwv\DataModule\Http\Controller\Admin;

use Lwv\DataModule\Contact\Form\ContactFormBuilder;
use Lwv\DataModule\Contact\Table\ContactTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;

class ContactsController extends AdminController
{

    /**
     * Display an index of existing entries.
     */
    public function index(ContactTableBuilder $table, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.data::contacts.manage')) {
            abort(403);
        }

        return $table->render();
    }

    /**
     * Create a new entry.
     */
    public function create(ContactFormBuilder $form, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.data::contacts.manage')) {
            abort(403);
        }

        return $form->render();
    }

    /**
     * Edit an existing entry.
     */
    public function edit(ContactFormBuilder $form, Authorizer $authorizer, $id)
    {
        if (!$authorizer->authorize('lwv.module.data::contacts.manage')) {
            abort(403);
        }

        return $form->render($id);
    }
}
