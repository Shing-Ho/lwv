<?php namespace Lwv\NewsModule\Http\Controller\Admin;

use Lwv\NewsModule\Post\PostModel;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeCollection;
use Anomaly\Streams\Platform\Field\Form\FieldFormBuilder;
use Anomaly\Streams\Platform\Field\Table\FieldTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Anomaly\Streams\Platform\Support\Authorizer;

/**
 * Class FieldsController
 */
class FieldsController extends AdminController
{

    /**
     * Return an index of existing post type fields.
     *
     * @param FieldTableBuilder $table
     * @param PostModel         $model
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(FieldTableBuilder $table, PostModel $model, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.news::fields.manage')) {
            abort(403);
        }

        $table->setStream($model->getStream());

        return $table->render();
    }

    /**
     * Return the modal for choosing a field type.
     *
     * @param FieldTypeCollection $fieldTypes
     * @return \Illuminate\View\View
     */
    public function choose(FieldTypeCollection $fieldTypes)
    {
        return $this->view->make('module::admin/fields/choose', ['field_types' => $fieldTypes->all()]);
    }

    /**
     * Return the form for a new field.
     *
     * @param FieldFormBuilder          $form
     * @param StreamRepositoryInterface $streams
     * @param FieldTypeCollection       $fieldTypes
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(FieldFormBuilder $form, StreamRepositoryInterface $streams, FieldTypeCollection $fieldTypes, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.news::fields.manage')) {
            abort(403);
        }

        $form
            ->setStream($streams->findBySlugAndNamespace('posts', 'news'))
            ->setFieldType($fieldTypes->get($_GET['field_type']));

        return $form->render();
    }

    /**
     * Return the form for an existing field.
     *
     * @param FieldFormBuilder $form
     * @param                  $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(FieldFormBuilder $form, Authorizer $authorizer, $id)
    {
        if (!$authorizer->authorize('lwv.module.news::fields.manage')) {
            abort(403);
        }

        return $form->render($id);
    }
}
