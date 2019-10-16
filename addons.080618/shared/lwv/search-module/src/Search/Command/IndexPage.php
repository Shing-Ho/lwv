<?php namespace Lwv\SearchModule\Search\Command;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Anomaly\PagesModule\Page\PageModel;
use GuzzleHttp\Client;

/**
 * Class IndexPage
 */
class IndexPage
{
    use DispatchesJobs;

    /**
     * The index.
     */
    protected $index;

    /**
     * The page.
     */
    protected $page;

    /**
     * Create a new IndexPage instance.
     */
    public function __construct(PageModel $page)
    {
        $this->index = 'default';
        $this->page = $page;
    }

    /**
     * Handle the command.
     */
    public function handle(Client $client)
    {
        $url = env('APP_URL').'/search/index/page/'.$this->page->str_id;
        $client->request('GET', rtrim($url,'/'));
    }
}
