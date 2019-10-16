<?php namespace Lwv\CareersModule\Http\Controller\Admin;

use Lwv\CareersModule\Applicant\Form\ApplicantFormBuilder;
use Lwv\CareersModule\Applicant\Table\ApplicantTableBuilder;
use Lwv\CareersModule\Applicant\ApplicantModel;
use Lwv\CareersModule\Job\JobModel;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class ApplicantsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param ApplicantTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ApplicantTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param ApplicantFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(ApplicantFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param ApplicantFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(ApplicantFormBuilder $form, $id)
    {
        return $form->render($id);
    }

    /**
     * View an existing entry.
     */
    public function view(ApplicantModel $applicantModel, $id)
    {
        return $this->view->make(
            'lwv.module.careers::admin/applicant',
            [
                'applicant' => $applicantModel->find($id),
                'job' => $applicantModel->find($id)->job,
            ]
        );
    }
}
