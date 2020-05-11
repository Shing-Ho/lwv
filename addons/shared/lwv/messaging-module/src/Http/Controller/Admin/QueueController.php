<?php namespace Lwv\MessagingModule\Http\Controller\Admin;

use Lwv\MessagingModule\Queue\Form\QueueFormBuilder;
use Lwv\MessagingModule\Queue\Table\QueueTableBuilder;
use Lwv\MessagingModule\Queue\QueueModel;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;

class QueueController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param QueueTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(QueueTableBuilder $table, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.messaging::queue.read')) {
            abort(403);
        }

        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param QueueFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(QueueFormBuilder $form, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.messaging::queue.read')) {
            abort(403);
        }

        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param QueueFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(QueueFormBuilder $form, Authorizer $authorizer, $id)
    {
        if (!$authorizer->authorize('lwv.module.messaging::queue.read')) {
            abort(403);
        }

        return $form->render($id);
    }

    /**
     * View an existing entry.
     */
    public function view(Authorizer $authorizer, QueueModel $model, $id)
    {
        if (!$authorizer->authorize('lwv.module.messaging::queue.read')) {
            abort(403);
        }

        if ($msg = $model->find($id)) {
            return $this->view->make(
                'lwv.module.messaging::message',
                [
                    'type' => $msg->type,
                    'message' => unserialize($msg->message)
                ]
            );
        }

        abort(404);
    }

    public function test(QueueModel $queue)
    {
        $model = app('Lwv\CareersModule\Applicant\ApplicantModel');
        $applicant = $model->find(21);
        $job = $applicant->job;
        $attachments = $applicant->attachments;

        return view('lwv.module.careers::mail.applicant', compact('applicant','job','attachments'));

        $email = [
            'type' => 'email',
            'recipients' => ['ryan@itinnovative.com','ramcda@hotmail.com'],
            'subject' => 'Test Email Message',
            'message' => 'Lorem ipsum dolor sit amet'
        ];

        $message = $queue
            ->create(
                [
                    'type' => 'email',
                    'message' => serialize($email),
                ]
            );
        //dd($message);
    }
}
