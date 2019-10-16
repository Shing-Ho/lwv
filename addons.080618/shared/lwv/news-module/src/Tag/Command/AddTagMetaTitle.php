<?php namespace Lwv\NewsModule\Tag\Command;

use Anomaly\Streams\Platform\View\ViewTemplate;

/**
 * Class AddTagMetaTitle
 */
class AddTagMetaTitle
{

    /**
     * The tag string.
     *
     * @var string
     */
    protected $tag;

    /**
     * Create a new AddTagMetaTitle instance.
     *
     * @param string $tag
     */
    public function __construct($tag)
    {
        $this->tag = $tag;
    }

    /**
     * Handle the command.
     *
     * @param ViewTemplate $template
     */
    public function handle(ViewTemplate $template)
    {
        $template->set('meta_title', trans('lwv.module.news::breadcrumb.tagged', ['tag' => $this->tag]));
    }
}
