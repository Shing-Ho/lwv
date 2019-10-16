<?php namespace Lwv\ClubsModule\Post\Command;

use Lwv\ClubsModule\Post\Contract\PostInterface;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Support\Parser;

/**
 * Class GetPostPath
 */
class GetPostPath
{

    /**
     * The post instance.
     *
     * @var PostInterface
     */
    protected $post;

    /**
     * Return the path for a post.
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
     * @param Parser                     $parser
     * @return string
     */
    public function handle(SettingRepositoryInterface $settings, Parser $parser)
    {
        $base = $settings->value('lwv.module.clubs::module_root', 'clubs');

        if (!$this->post->isLive()) {
            return '/clubs/posts/preview/' . $this->post->id;
        }

        $permalink = array('club','type','year','month','day','post');
        $permalink = implode('}/{', $permalink);

        $data = [
            'club'  => $this->post->club->slug,
            'type'  => $this->post->post_type,
            'year'  => $this->post->publish_at->format('Y'),
            'month' => $this->post->publish_at->format('m'),
            'day'   => $this->post->publish_at->format('d'),
            'post'  => $this->post->slug
        ];

        return $parser->parse($base . '/' . "{{$permalink}}", $data);
    }
}
