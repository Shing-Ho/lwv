<?php namespace Lwv\ClubsModule\Post\Command;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Lwv\ClubsModule\Post\PostModel;
use DB;

/**
 * Class BuildSidebar
 */
class BuildSidebar
{

    use DispatchesJobs;

    /**
     * The club
     */
    protected $club;

    /**
     * Return the path for a post.
     *
     */
    public function __construct($club)
    {
        $this->club = $club;
    }

    /**
     * Handle the command.
     *
     */
    public function handle(PostModel $posts)
    {
        $sidebar = [];

        $results = $posts->select(DB::raw('DATE_FORMAT(publish_at, \'%Y\') as year'), DB::raw('DATE_FORMAT(publish_at, \'%m\') as month'), DB::raw('DATE_FORMAT(publish_at, \'%M\') as month_name'))
            ->where('club_id',$this->club->id)
            ->news()
            ->live()
            ->orderBy('year','DESC')
            ->orderBy('month','DESC')
            ->distinct()->get();

        $sidebar['news'] = $this->archive($results);

        $results = $posts->select(DB::raw('DATE_FORMAT(publish_at, \'%Y\') as year'), DB::raw('DATE_FORMAT(publish_at, \'%m\') as month'), DB::raw('DATE_FORMAT(publish_at, \'%M\') as month_name'))
            ->where('club_id',$this->club->id)
            ->events()
            ->live()
            ->orderBy('year','DESC')
            ->orderBy('month','DESC')
            ->distinct()->get();

        $sidebar['events'] = $this->archive($results);

        return $sidebar;
    }

    private function archive($results)
    {
        $request = app('Illuminate\Http\Request');
        $sidebar = [];
        $archive = [];

        foreach ($results as $result) {
            $archive[$result->year][] = array('month' => $result->month, 'name' => $result->month_name);
        }

        foreach($archive as $year => $months) {
            $sidebar[] = array('year' => $year, 'months' => $months);
        }

        // Set active links in sidebar archive
        foreach ($sidebar as $key => $section) {
            $active = ($request->route('year') == $section['year'])? true : false;
            $sidebar[$key]['active'] = $active;
        }

        return $sidebar;
    }
}
