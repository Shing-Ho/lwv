<?php namespace Lwv\ClubsModule\Club\Console;

use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Lwv\ClubsModule\Club\ClubModel;

/**
 * Class FormatClubs
 */
class FormatClubs extends Command
{

    use DispatchesJobs;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'clubs:format';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Format all club data.';
    
    /**
     * Execute the console command.
     */
    public function fire(ClubModel $clubModel)
    {
        $this->info('-- Executing ('.$this->name.')');
        $this->info('Formatting Clubs');
        $clubs = $clubModel->all();

        $this->output->progressStart($clubs->count());

        foreach ($clubs as $club) {
            $club->slug = $this->slugify($club->title);
            $club->save();
            $this->output->progressAdvance();
        }

        $this->output->progressFinish();
    }

    private function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text))
        {
            return 'n-a';
        }

        return $text;
    }
}
