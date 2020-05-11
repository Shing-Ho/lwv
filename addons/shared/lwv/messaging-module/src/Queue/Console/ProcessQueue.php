<?php namespace Lwv\MessagingModule\Queue\Console;

use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Lwv\MessagingModule\Queue\QueueModel;
use Carbon\Carbon;
use iContact\iContactApi;
use Mail;

/**
 * Class ProcessQueue
 */
class ProcessQueue extends Command
{

    use DispatchesJobs;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'messaging:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process all messages in the message queue.';

    /**
     * The iContact api.
     */
    protected $api = null;
    
    /**
     * Execute the console command.
     */
    public function fire(QueueModel $queueModel)
    {
        // Catch issues with unserialize
        error_reporting(error_reporting() ^ E_NOTICE);

        $this->info('-- Executing ('.$this->name.')');
        $this->info('Processing email messages in the message queue');
        $messages = $queueModel->where('type','email')->where('processed',false)->orderBy('id')->get();

        $this->output->progressStart($messages->count());

        foreach ($messages as $message) {
            if ($msg = @unserialize($message->message)) {
                Mail::send('lwv.module.messaging::types.mail', ['body' => $msg['message']], function ($m) use ($msg) {
                    $m->from($msg['from'], null)->to($msg['to'], null)->subject($msg['subject'])->ReplyTo($msg['reply']);
                });

                // Flag message as processed
                $message->result = 'Email sent to ( '.implode($msg['to'],',').' )';
            } else {
                $message->result = 'Unable to process (malformed message)';
            }

            $message->processed = 1;
            $message->processed_at = Carbon::now();
            $message->save();
            $this->output->progressAdvance();
        }

        $this->output->progressFinish();

        // Instantiate iContact
        $this->api = iContactApi::getInstance()->setConfig(array(
            'appId' => config('lwv.module.messaging::icontact.app_id'),
            'apiPassword' => config('lwv.module.messaging::icontact.api_password'),
            'apiUsername' => config('lwv.module.messaging::icontact.api_username'),
        ));

        // Retrieve configured lists map
        $lists = $this->buildLists();

        $this->info('Processing subscribe messages in the message queue');
        $messages = $queueModel->where('type','subscribe')->where('processed',false)->get();
        $this->info('Message:'.$queueModel);
        $this->output->progressStart($messages->count());

        foreach ($messages as $message) {
            $msg = unserialize($message->message)['subscribe'];

            // Add Contact
            if ($contact = $this->addContact($msg)) {
                // Add subscriptions
                foreach ($msg['subscribe'] as $subscribe) {
                    $this->subscribeContact($contact,$lists[$subscribe]);
                }
            } else {
                $this->error('Unable to add iContact contact - '.$msg['email']);
                exit;
            }

            // Flag message as processed
            $message->result = $msg['email'].' subscribed to ( '.implode($msg['subscribe'],',').' )';
            $message->processed = 1;
            $message->processed_at = Carbon::now();
            $message->save();
            $this->output->progressAdvance();
        }

        $this->output->progressFinish();
    }

    private function buildLists() {
        $map = [];
        $config = config('lwv.module.messaging::icontact.lists');

        // Retrieve lists from API
        try {
            $results = $this->api->getlists();
        } catch (Exception $oException) {
            $this->error(var_dump($this->api->getErrors()));
            exit;
        }

        // Construct map
        foreach ($config as $key => $val) {
            if (in_array($val,array_column($results,'listId'))) {
                $map[$key] = $results[array_search($val,array_column($results,'listId'))];
            } else {
                $this->error('iContact List - '.$val.' not found');
                ///exit;
            }
        }
        return $map;
    }

    private function addContact($contact) {
        try {
            $contact = $this->api->addContact($contact['email'], null, null, $contact['first_name'], $contact['last_name'], null, null, null, null, null, null, ($contact['phone']) ? $contact['phone'] : null, null, null);
        } catch (Exception $oException) {
            $this->error(var_dump($this->api->getErrors()));
            exit;
        }

        return $contact;
    }

    private function subscribeContact($contact,$list) {
        try {
            $subscription = $this->api->subscribeContactToList($contact->contactId,$list->listId,'normal');
        } catch (Exception $oException) {
            $this->error(var_dump($this->api->getErrors()));
            exit;
        }

        return $subscription;
    }
}
