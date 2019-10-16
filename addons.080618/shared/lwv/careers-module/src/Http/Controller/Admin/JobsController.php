<?php namespace Lwv\CareersModule\Http\Controller\Admin;

use Lwv\CareersModule\Job\Form\JobFormBuilder;
use Lwv\CareersModule\Job\Table\JobTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class JobsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param JobTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(JobTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param JobFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(JobFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param JobFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(JobFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
