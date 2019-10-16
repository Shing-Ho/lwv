<?php namespace Lwv\CareersModule\Search\Form;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Lwv\CareersModule\Applicant\ApplicantModel;
use Lwv\DropzoneFieldType\File\FileUploader;
use Mail;

/**
 * Class ApplicationFormHandler
 */
class ApplicationFormHandler
{

    use DispatchesJobs;


    /**
     * Handle the command.
     *
     * @param ApplicationFormBuilder $builder
     * @param ApplicantModel $applicantModel
     * @param AssetPaths $paths
     * @param FileUploader $uploader
     */
    public function handle(ApplicationFormBuilder $builder, ApplicantModel $applicantModel, FileUploader $uploader, SettingRepositoryInterface $settings)
    {
        // Validation failed!
        if ($builder->hasFormErrors()) {
            return;
        }

        // Create Applicant
        $input = $builder->getFormInput();

        foreach (array_keys($input) as $key) {
            $input[$key] = (is_array($input[$key])) ? $input[$key] : trim($input[$key]);
        }

        // Handle Attachment Upload
        $attachments = $uploader->upload($input['attachments'], 'careers_attachments');

        $applicant = $applicantModel->create([
            'name' => ucwords($input['name']),
            'email' => strtolower($input['email']),
            'phone' => $this->format_phone($input['phone']),
            'cover_letter' => $input['cover_letter'],
            'job_id' => $input['job']
        ]);

        // Link attachments to applicant
        foreach($attachments as $attachment) {
            $applicant->attachments()->attach($attachment->id);
        }

        // Send message
        $msg = [
            'to' => explode('|',$settings->value('lwv.module.careers::careers_admin_email')),
            'from' => env('MAIL_USERNAME'),
            'reply' => env('MAIL_USERNAME'),
            'subject' => $settings->value('lwv.module.careers::careers_application_email_subject'),
            'message' => view('lwv.module.careers::mail.applicant', ['applicant' => $applicant, 'job' => $applicant->job, 'uploads' => $attachments])->render()
        ];

        if (class_exists('Lwv\MessagingModule\MessagingModule')) {
            // Pass message off to messaging module
            $queue = new \Lwv\MessagingModule\Queue\QueueModel;

            $queue->create(
                [
                    'type' => 'email',
                    'message' => serialize($msg),
                ]
            );
        } else {
            // Send email directly
            Mail::send('lwv.module.careers::mail.applicant', ['applicant' => $applicant, 'job' => $applicant->job, 'uploads' => $attachments], function ($m) use ($msg) {
                $m->from($msg['from'], null)->to($msg['to'], null)->subject($msg['subject'])->ReplyTo($msg['reply']);
            });
        }

    }

    private function format_phone($phone) {
        $digits = ltrim(preg_replace('/[^0-9]/', '', $phone),'1');

        if (strlen($digits) == 7) {
            return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $digits);
        } elseif (strlen($digits) == 10) {
            return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $digits);
        }

        return $phone;
    }
}
