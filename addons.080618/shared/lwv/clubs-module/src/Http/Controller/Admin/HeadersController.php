<?php namespace Lwv\ClubsModule\Http\Controller\Admin;

use Lwv\ClubsModule\Header\Form\HeaderFormBuilder;
use Lwv\ClubsModule\Header\Table\HeaderTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;

class HeadersController extends AdminController
{

    /**
     * Display an index of existing entries.
     */
    public function index(HeaderTableBuilder $table, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.clubs::headers.manage')) {
            abort(403);
        }

        return $table->render();
    }

    /**
     * Create a new entry.
     */
    public function create(HeaderFormBuilder $form, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.clubs::headers.manage')) {
            abort(403);
        }

        return $form->render();
    }

    /**
     * Edit an existing entry.
     */
    public function edit(HeaderFormBuilder $form, Authorizer $authorizer, $id)
    {
        if (!$authorizer->authorize('lwv.module.clubs::headers.manage')) {
            abort(403);
        }

        return $form->render($id);
    }
}
