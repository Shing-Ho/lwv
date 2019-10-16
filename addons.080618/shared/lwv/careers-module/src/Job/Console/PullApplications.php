<?php namespace Lwv\CareersModule\Job\Console;

use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Lwv\ConnectModule\Message\MessageModel;
use Lwv\FranchisesModule\Franchise\FranchiseModel;
use Lwv\CareersModule\Job\JobModel;
use Lwv\NotificationsModule\NotificationsModuleFunctions;
use Anomaly\SettingsModule\Setting\SettingRepository;
use Anomaly\UsersModule\User\UserModel;
use Carbon\Carbon;

/**
 * Class PullApplications
 */
class PullApplications extends Command
{

    use DispatchesJobs;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'applications:pull';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull in pending job applications from the consumer site message queue.';
    
    /**
     * Execute the console command.
     */
    public function fire(MessageModel $messageModel, JobModel $jobModel, FranchiseModel $franchiseModel, UserModel $userModel, SettingRepository $settings, NotificationsModuleFunctions $notificationsFunctions)
    {
        $this->info('-- Executing ('.$this->name.')');
        $this->info('Pulling pending job applications from consumer site');
        $cnt = 0;
        $admin = $settings->get('lwv.module.careers::corporate_admin') ? $settings->get('lwv.module.careers::corporate_admin')->value : false;

        $messages = $messageModel->new_applications();

        $this->output->progressStart($messages->count());

        foreach ($messages as $message) {
            $form = unserialize($message->message);
            $raw = $form['raw'];
            $formatted = $form['formatted'];
            $formatted['state'] = ($raw['country'] == 'CA') ? $formatted['state_ca'] : $formatted['state_us'];

            if (isset($formatted['cover_letter'])) {
                $formatted['cover_letter'] = str_replace(array("\r\n", "\r", "\n"), "<br />", $formatted['cover_letter']);
            }

            if ($job = $jobModel->find($raw['job'])) {

                // Send notifications
                if ($job->type == 'franchise') {
                    if ($franchise = $franchiseModel->find($job->franchise_id)) {
                        // Notify Franchise
                        $result = 'Application sent to '.$franchise->name;
                        $notificationsFunctions->notifyFranchiseMgmt('New job application for '.$franchise->name,'',view('lwv.module.notifications::notifications/application', compact('job','formatted'))->render(),$franchise->id,'user');
                    } else {
                        $result = 'Invalid Franchise ID - '.$job->franchise_id;
                    }
                } else {
                    if ($user = $userModel->find($job->user_id)) {
                        // Notify User
                        $result = 'Application sent to '.$user->display_name;
                        $notificationsFunctions->notifyUser('New corporate job application','',view('lwv.module.notifications::notifications/application', compact('job','formatted'))->render(),$user->id,'user');

                        // Notify Admin
                        if ($admin) {
                            $notificationsFunctions->notifyUser('New corporate job application','',view('lwv.module.notifications::notifications/application', compact('job','formatted'))->render(),$admin,'user');
                        }
                    } else {
                        $result = 'Invalid User ID - '.$job->user_id;
                    }
                }
            } else {
                $result = 'Invalid Job ID - '.$raw['job'];
            }

            // Flag message as processed
            $message->result = $result;
            $message->processed = 1;
            $message->processed_at = Carbon::now();
            $message->save();
            $cnt++;
            $this->output->progressAdvance();
        }

        $this->output->progressFinish();
    }
}
