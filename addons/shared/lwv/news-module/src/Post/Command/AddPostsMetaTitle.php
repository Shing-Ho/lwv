<?php namespace Lwv\NewsModule\Post\Command;

use Anomaly\Streams\Platform\View\ViewTemplate;

/**
 * Class AddPostsMetaTitle
 */
class AddPostsMetaTitle
{

    /**
     * Set the meta title.
     *
     * @param ViewTemplate $template
     */
    public function handle(ViewTemplate $template)
    {
        $template->set('meta_title', trans('lwv.module.news::breadcrumb.posts'));
    }
}
