<?php namespace Lwv\ClubsModule\Post\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

interface PostInterface extends EntryInterface
{
    /**
     * Return the post's path.
     *
     * @return string
     */
    public function path();

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Return the publish at date.
     *
     * @return Carbon
     */
    public function getPublishAt();

    /**
     * Return the publish until date.
     *
     * @return Carbon
     */
    public function getPublishUntil();

    /**
     * Alias for getPublishAt()
     *
     * @return Carbon
     */
    public function getDate();

    /**
     * Return if the post is live or not.
     *
     * @return bool
     */
    public function isLive();

    /**
     * Return if the post is expired or not.
     *
     * @return bool
     */
    public function isExpired();

    /**
     * Return if the post is scheduled or not.
     *
     * @return bool
     */
    public function isScheduled();

    /**
     * Get the enabled flag.
     *
     * @return bool
     */
    public function isEnabled();
}
