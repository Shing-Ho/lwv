<?php namespace Lwv\NewsModule\Post;

use Lwv\NewsModule\Post\Contract\PostInterface;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Anomaly\Streams\Platform\Support\Decorator;
use Carbon\Carbon;
use Collective\Html\HtmlBuilder;

/**
 * Class PostPresenter
 */
class PostPresenter extends EntryPresenter
{

    /**
     * The HTML builder.
     *
     * @var HtmlBuilder
     */
    protected $html;

    /**
     * The decorated post.
     *
     * @var PostInterface
     */
    protected $object;

    /**
     * The setting repository.
     *
     * @var SettingRepositoryInterface
     */
    private $settings;

    /**
     * Create a new PostPresenter instance.
     *
     * @param HtmlBuilder                $html
     * @param SettingRepositoryInterface $settings
     * @param                            $object
     */
    public function __construct(HtmlBuilder $html, SettingRepositoryInterface $settings, $object)
    {
        $this->html     = $html;
        $this->settings = $settings;

        parent::__construct($object);
    }

    /**
     * Return the publish at date.
     *
     * @return Carbon
     */
    public function date()
    {
        return $this->object->getPublishAt();
    }

    /**
     * Return the tag links.
     *
     * @param array $attributes
     * @return string
     */
    public function tagLinks(array $attributes = [])
    {
        array_set($attributes, 'class', array_get($attributes, 'class', 'label label-default'));

        return array_map(
            function ($label) use ($attributes) {
                return $this->html->link(
                    implode(
                        '/',
                        [
                            $this->settings->value('lwv.module.news::module_segment', 'news'),
                            $this->settings->value('lwv.module.news::tag_segment', 'tag'),
                            $label
                        ]
                    )
                    ,
                    $label,
                    $attributes
                );
            },
            (array)$this->object->getTags()
        );
    }

    /**
     * Return the post's status as a label.
     *
     * @param  string      $size
     * @return null|string
     */
    public function statusLabel($size = 'sm')
    {
        $color  = 'default';
        $status = $this->status();

        switch ($status) {
            case 'scheduled':
                $color = 'info';
                break;

            case 'draft':
                $color = 'default';
                break;

            case 'live':
                $color = 'success';
                break;

            case 'expired':
                $color = 'danger';
                break;
        }

        return '<span class="tag tag-' . $size . ' tag-' . $color . '">' . trans(
            'lwv.module.news::field.status.option.' . $status
        ) . '</span>';
    }

    /**
     * Return the status key.
     *
     * @return null|string
     */
    public function status()
    {
        if (!$this->object->isEnabled()) {
            return 'draft';
        }

        if ($this->object->isExpired()) {
            return 'expired';
        }

        if ($this->object->isScheduled()) {
            return 'scheduled';
        }

        if ($this->object->isLive()) {
            return 'live';
        }

        return null;
    }

    /**
     * Catch calls to fields on
     * the page's related entry.
     *
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        $entry = $this->object->getEntry();

        if ($entry->hasField($key)) {
            return (New Decorator())->decorate($entry)->{$key};
        }

        return parent::__get($key);
    }
}
