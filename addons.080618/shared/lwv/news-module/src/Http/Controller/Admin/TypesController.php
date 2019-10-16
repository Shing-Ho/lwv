<?php namespace Lwv\NewsModule\Http\Controller\Admin;

use Lwv\NewsModule\Type\Form\TypeFormBuilder;
use Lwv\NewsModule\Type\Table\TypeTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;

/**
 * Class TypesController
 */
class TypesController extends AdminController
{

    /**
     * Return an index of types.
     *
     * @param TypeTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(TypeTableBuilder $table, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.news::types.manage')) {
            abort(403);
        }

        return $table->render();
    }

    /**
     * Return the form for creating a new type.
     *
     * @param TypeFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(TypeFormBuilder $form, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.news::types.manage')) {
            abort(403);
        }

        return $form->render();
    }

    /**
     * Return the form for editing an existing type.
     *
     * @param TypeFormBuilder $form
     * @param                 $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(TypeFormBuilder $form, Authorizer $authorizer, $id)
    {
        if (!$authorizer->authorize('lwv.module.news::types.manage')) {
            abort(403);
        }

        return $form->render($id);
    }
}
