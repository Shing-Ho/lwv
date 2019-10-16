<?php namespace Lwv\NewsModule\Post\Command;

use Lwv\NewsModule\Post\Contract\PostInterface;
use Lwv\NewsModule\Post\PostAuthorizer;
use Lwv\NewsModule\Post\PostLoader;
use Lwv\NewsModule\Post\PostResponse;

/**
 * Class MakePostResponse
 */
class MakePostResponse
{

    /**
     * The post instance.
     *
     * @var PostInterface
     */
    private $post;

    /**
     * Create a new MakePostResponse instance.
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
     * @param PostAssets     $assets
     * @param PostLoader     $loader
     * @param PostResponse   $response
     * @param PostAuthorizer $authorizer
     */
    public function handle(
        PostLoader $loader,
        PostResponse $response,
        PostAuthorizer $authorizer
    ) {
        $authorizer->authorize($this->post);
        $loader->load($this->post);
        $response->make($this->post);
    }
}
