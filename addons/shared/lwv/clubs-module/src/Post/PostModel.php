<?php namespace Lwv\ClubsModule\Post;

use Lwv\ClubsModule\Post\Contract\PostInterface;
use Lwv\ClubsModule\Post\Command\GetPostPath;
use Anomaly\Streams\Platform\Model\Clubs\ClubsPostsEntryModel;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class PostModel extends ClubsPostsEntryModel implements PostInterface
{
    /**
     * Return the post's `.
     *
     * @return string
     */
    public function path()
    {
        return $this->dispatch(new GetPostPath($this));
    }

    /**
     * Return the publish at date.
     *
     * @return Carbon
     */
    public function getPublishAt()
    {
        return $this->publish_at;
    }

    /**
     * Return the publish until date.
     *
     * @return Carbon
     */
    public function getPublishUntil()
    {
        return $this->publish_until;
    }

    /**
     * Alias for getPublishAt()
     *
     * @return Carbon
     */
    public function getDate()
    {
        return $this->getPublishAt();
    }

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Return if the post is live or not.
     *
     * @return bool
     */
    public function isLive()
    {
        return $this->isEnabled() && $this->getPublishAt() < new \DateTime() && (!$this->getPublishUntil() || $this->getPublishUntil() > new \DateTime());
    }

    /**
     * Return if the post is expired or not.
     *
     * @return bool
     */
    public function isExpired()
    {
        return $this->isEnabled() && $this->getPublishAt() < new \DateTime() && ($this->getPublishUntil() && $this->getPublishUntil() < new \DateTime());
    }

    /**
     * Return if the post is scheduled or not.
     *
     * @return bool
     */
    public function isScheduled()
    {
        return $this->isEnabled() && $this->getPublishAt() > new \DateTime();
    }

    /**
     * Get the enabled flag.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Restrict to live posts only.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeLive(Builder $query)
    {
        return $query
            ->where('enabled', 1)
            ->where('publish_at', '<=', date('Y-m-d H:i:s'))
            ->where(function($query) {
                $query->whereNull('publish_until')
                    ->orWhere('publish_until', '>', date('Y-m-d H:i:s'));
            })
            ->orderBy('publish_at', 'DESC');
    }

    /**
     * Restrict to news posts only.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeNews(Builder $query)
    {
        return $query
            ->where('post_type', 'news');
    }

    /**
     * Restrict to events posts only.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeEvents(Builder $query)
    {
        return $query
            ->where('post_type', 'events');
    }
}
