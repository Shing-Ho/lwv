<?php namespace Lwv\NewsModule\Category\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Interface CategoryInterface
 */
interface CategoryInterface extends EntryInterface
{

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName();

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Get the related posts.
     *
     * @return EntryCollection
     */
    public function getPosts();

    /**
     * Return the category's path.
     *
     * @return string
     */
    public function path();

    /**
     * Return the posts relation.
     *
     * @return HasMany
     */
    public function posts();
}
