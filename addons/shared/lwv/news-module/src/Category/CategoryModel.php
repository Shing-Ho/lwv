<?php namespace Lwv\NewsModule\Category;

use Lwv\NewsModule\Category\Command\GetCategoryPath;
use Lwv\NewsModule\Category\Contract\CategoryInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;
use Anomaly\Streams\Platform\Model\News\NewsCategoriesEntryModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class CategoryModel
 */
class CategoryModel extends NewsCategoriesEntryModel implements CategoryInterface
{

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
     * Get the related posts.
     *
     * @return EntryCollection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Return the category's path.
     *
     * @return string
     */
    public function path()
    {
        return $this->dispatch(new GetCategoryPath($this));
    }

    /**
     * Return the posts relation.
     *
     * @return HasMany
     */
    public function posts()
    {
        return $this->hasMany('Lwv\NewsModule\Post\PostModel', 'category_id');
    }
}
