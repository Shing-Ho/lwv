<?php namespace Lwv\NewsModule\Post\Command;

use Lwv\NewsModule\Post\Contract\PostInterface;
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
        $base = $settings->value('lwv.module.news::module_segment', 'news');

        if (!$this->post->isLive()) {
            return $base . '/preview/' . $this->post->getStrId();
        }

        $permalink = array('year','month','day','post');
        $permalink = implode('}/{', $permalink);

        $data = [
            'year'  => $this->post->publish_at->format('Y'),
            'month' => $this->post->publish_at->format('m'),
            'day'   => $this->post->publish_at->format('d'),
            'post'  => $this->post->getSlug()
        ];

        return $parser->parse($base . '/' . "{{$permalink}}", $data);
    }
}
