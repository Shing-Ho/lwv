<?php namespace Lwv\SearchModule\Search\Command;

use Illuminate\Foundation\Bus\DispatchesJobs;
use GuzzleHttp\Client;

/**
 * Class IndexPost
 */
class IndexPost
{
    use DispatchesJobs;

    /**
     * The post.
     */
    protected $post;

    /**
     * Create a new IndexPost instance.
     */
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * Handle the command.
     */
    public function handle(Client $client)
    {
        $url = env('APP_URL').'/search/index/'.$this->post->getStream()->namespace.'/'.$this->post->getStream()->slug.'/'.$this->post->str_id;
        $result = $client->request('GET', rtrim($url,'/'));
    }
}
