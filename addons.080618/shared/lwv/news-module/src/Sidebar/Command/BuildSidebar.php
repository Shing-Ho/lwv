<?php namespace Lwv\NewsModule\Sidebar\Command;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Anomaly\Streams\Platform\View\ViewTemplate;
use Lwv\NewsModule\Category\Contract\CategoryRepositoryInterface;
use Lwv\NewsModule\Post\PostModel;
use Lwv\NewsModule\Post\Command\GetSettings;

use DB;
use Cache;

/**
 * Class BuildSidebar
 */
class BuildSidebar
{

    use DispatchesJobs;

    /**
     * Return the path for a post.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the command.
     *
     */
    public function handle(CategoryRepositoryInterface $categories, PostModel $posts, Request $request, ViewTemplate $template)
    {
        $cacheHits = array();
        $settings = $this->dispatch(new GetSettings());
        $cacheKey = 'news_sidebar';

        if (Cache::has($cacheKey) && $settings['sidebar_cache_duration']) {
            $sidebar = Cache::get($cacheKey);
            $cacheHits[$cacheKey] = 'Cache';
        } else {
            $sidebar = array();
            $sidebar['archive'] = array();
            $sidebar['categories'] = $categories->all()->sortBy('sort_order');
            $sidebar['featured'] = $posts->live()->where('enabled',1)->where('featured',1)->orderBy('publish_at','DESC')->take($settings['sidebar_featured'])->get();
            $results = $posts->select(DB::raw('DATE_FORMAT(publish_at, \'%Y\') as year'), DB::raw('DATE_FORMAT(publish_at, \'%m\') as month'), DB::raw('DATE_FORMAT(publish_at, \'%M\') as month_name'))
                ->live()
                ->orderBy('year','DESC')
                ->orderBy('month','DESC')
                ->distinct()->get();

            $archive = array();
            foreach ($results as $result) {
                $archive[$result->year][] = array('month' => $result->month, 'name' => $result->month_name);
            }

            foreach($archive as $year => $months) {
                $sidebar['archive'][] = array('year' => $year, 'months' => $months);
            }

            $cacheHits[$cacheKey] = 'DB';

            // Cache sidebar
            if ($settings['sidebar_cache_duration']) {
                Cache::put($cacheKey, $sidebar, $settings['sidebar_cache_duration']);
            }
        }

        // Set active links in sidebar archive
        foreach ($sidebar['archive'] as $key => $section) {
            $active = ($request->route('year') == $section['year'])? true : false;
            $sidebar['archive'][$key]['active'] = $active;
        }

        $template->put('cacheHits', array_merge($template->get('cacheHits',array()),$cacheHits));
        return $sidebar;
    }
}
