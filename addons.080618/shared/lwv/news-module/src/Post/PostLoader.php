<?php namespace Lwv\NewsModule\Post;

use Lwv\NewsModule\Post\Contract\PostInterface;
use Anomaly\Streams\Platform\View\ViewTemplate;

/**
 * Class PostLoader
 */
class PostLoader
{

    /**
     * The template data.
     *
     * @var ViewTemplate
     */
    protected $template;

    /**
     * Create a new PostLoader instance.
     *
     * @param ViewTemplate $template
     */
    public function __construct(ViewTemplate $template)
    {
        $this->template = $template;
    }

    /**
     * Load post data to the template.
     *
     * @param PostInterface $post
     */
    public function load(PostInterface $post)
    {
        $this->template->set('post', $post);
        $this->template->set('title', $post->getTitle());
        $this->template->set('meta_title', $post->getMetaTitle());
        $this->template->set('meta_keywords', $post->getMetaKeywords());
        $this->template->set('meta_description', $post->getMetaDescription());
    }
}
