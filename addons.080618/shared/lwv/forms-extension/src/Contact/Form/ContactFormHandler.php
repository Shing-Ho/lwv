<?php namespace Lwv\FormsExtension\Contact\Form;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Lwv\FormsExtension\FormsExtensionFunctions;
use Lwv\DropzoneFieldType\File\FileUploader;
use Mail;

/**
 * Class ContactFormHandler
 */
class ContactFormHandler
{

    use DispatchesJobs;

    /**
     * Handle the command.
     *
     * @param ContactFormBuilder $builder
     * @param SettingRepositoryInterface $settings
     * @param QueueModel $queue
     */
    public function handle(ContactFormBuilder $builder, SettingRepositoryInterface $settings, FormsExtensionFunctions $functions, FileUploader $uploader)
    {
        // Validation failed!
        if ($builder->hasFormErrors()) {
            return;
        }

        // Handle input
        $input = $builder->getFormInput();

        foreach (array_keys($input) as $key) {
            $input[$key] = (is_array($input[$key])) ? $input[$key] : trim($input[$key]);
        }

        // Get config
        $config = $functions->setForm('contact')->getCategory($input['interest']);
        $setting = json_decode($settings->value('lwv.extension.forms::contact_json','{}'),true);

        if (!isset($config['type'])) {
            abort(500);
        }

        // Get form config
        $to = array_merge(
            $setting,
            ['fallback' => [
                'subject' => $settings->value('lwv.extension.forms::contact_email_subject'),
                'email' => $settings->value('lwv.extension.forms::contact_email'),
            ]]
        );

        // Handle Photo Upload
        $photos = $uploader->upload($input['photos'], 'forms_attachments');

        // Assemble message
        $input['phone'] = $this->format_phone($input['phone']);

        // Construct message
        if ($config['type'] == 'email') {
            $msg = [
                'to' => (isset($to[$input['interest']]['email'])) ? explode('|',$to[$input['interest']]['email']) : explode('|',$to['fallback']['email']),
                'from' => env('MAIL_USERNAME'),
                'reply' => env('MAIL_USERNAME'),
                'subject' => (isset($to[$input['interest']]['subject'])) ? $to[$input['interest']]['subject'] : $to['fallback']['subject'],
                'message' => view('lwv.extension.forms::mail.'.$config['template'], ['contact' => $input, 'photos' => $photos])->render()
            ];
        } else {
            $msg = [
                $config['type'] => $input,
            ];
        }

        if (class_exists('Lwv\MessagingModule\MessagingModule')) {
            // Pass message off to messaging module
            $queue = new \Lwv\MessagingModule\Queue\QueueModel;

            $queue->create(
                [
                    'type' => (isset($config['type']) ? $config['type'] : 'email'),
                    'message' => serialize($msg),
                ]
            );
        } else {

            if ($config['type'] == 'email') {
                // Send email directly
                Mail::send('lwv.extension.forms::mail.contact', ['contact' => $input], function ($m) use ($msg) {
                    $m->from($msg['from'], null)->to($msg['to'], null)->subject($msg['subject'])->ReplyTo($msg['reply']);
                });
            } else {
                // We can't handle this message without the messaging module
                abort(500);
            }
        }
    }

    private function format_phone($phone) {
        $digits = ltrim(preg_replace('/[^0-9]/', '', $phone),'1');

        if (strlen($digits) == 7) {
            return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $digits);
        } elseif (strlen($digits) == 10) {
            return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1)$2-$3", $digits);
        }

        return $phone;
    }
}
