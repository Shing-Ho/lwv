<?php namespace Lwv\ClubsModule\Post\Command;

use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;
use Lwv\ClubsModule\Post\Contract\PostInterface;
use Lwv\ClubsModule\Club\Contract\ClubRepositoryInterface;

/**
 * Class AddTypeBreadcrumb
 */
class AddTypeBreadcrumb
{

    /**
     * The post
     */
    protected $post;

    /**
     * Create a new AddTypeBreadcrumb instance.
     *
     * @param PostInterface $post
     */
    public function __construct(PostInterface $post)
    {
        $this->post = $post;
    }

    /**
     * Handle the command.
     *
     * @param SettingRepositoryInterface $settings
     * @param BreadcrumbCollection       $breadcrumbs
     */
    public function handle(BreadcrumbCollection $breadcrumbs, ClubRepositoryInterface $clubs)
    {
        $breadcrumbs->add(
            ucfirst($this->post->post_type),
            $clubs->find($this->post->club_id)->microsite().'/'.$this->post->post_type
        );
    }
}
