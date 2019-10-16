<?php namespace Lwv\NewsModule\Post\Command;

use Lwv\NewsModule\Post\Contract\PostInterface;
use Lwv\NewsModule\Post\PostLoader;
use Lwv\NewsModule\Post\PostResponse;

/**
 * Class MakePreviewResponse
 */
class MakePreviewResponse
{

    /**
     * The post instance.
     *
     * @var PostInterface
     */
    private $post;

    /**
     * Create a new MakePreviewResponse instance.
     *
     * @param PostInterface $post
     */
    public function __construct(PostInterface $post)
    {
        $this->post = $post;
    }

    /**
     * Handle the command
     *
     * @param PostAssets   $asset
     * @param PostLoader   $loader
     * @param PostResponse $response
     */
    public function handle(
        PostLoader $loader,
        PostResponse $response
    ) {
        $loader->load($this->post);
        $response->make($this->post);
    }
}
