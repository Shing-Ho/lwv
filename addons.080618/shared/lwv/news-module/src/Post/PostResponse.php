<?php namespace Lwv\NewsModule\Post;

use Lwv\NewsModule\Post\Contract\PostInterface;
use Lwv\NewsModule\Post\Command\GetSettings;
use Lwv\NewsModule\Sidebar\Command\BuildSidebar;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\ResponseFactory;

/**
 * Class PostResponse
 */
class PostResponse
{

    use DispatchesJobs;

    /**
     * The response factory.
     *
     * @var ResponseFactory
     */
    protected $container;

    /**
     * Create a new PostResponse instance.
     *
     * @param ResponseFactory $response
     */
    function __construct(ResponseFactory $response)
    {
        $this->response = $response;
    }

    /**
     * Make the post response.
     *
     * @param PostInterface $post
     */
    public function make(PostInterface $post)
    {
        $settings = $this->dispatch(new GetSettings());


        $content = [
            'footer' => ($post->getCategory()) ? $post->getCategory()->footer : ''
        ];

        if (isset($settings['sidebar']) && $settings['sidebar']) {
            $sidebar = $this->dispatch(new BuildSidebar());
        }

        $post->setResponse($this->response->view('module::posts/posts', compact('post','settings','sidebar','content')));
    }
}
