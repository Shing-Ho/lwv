<?php namespace Lwv\NewsModule\Post;

use Anomaly\EditorFieldType\EditorFieldType;
use Lwv\NewsModule\Category\Contract\CategoryInterface;
use Lwv\NewsModule\Post\Command\GetPostPath;
use Lwv\NewsModule\Post\Contract\PostInterface;
use Lwv\NewsModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\News\NewsPostsEntryModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PostModel
 */
class PostModel extends NewsPostsEntryModel implements PostInterface
{

    /**
     * The posts's content.
     *
     * @var null|string
     */
    protected $content = null;

    /**
     * The post's response.
     *
     * @var null|Response
     */
    protected $response = null;

    /**
     * Eager load these relations.
     *
     * @var array
     */
    protected $with = [
        'entry',
        'translations',
    ];

    /**
     * The cascaded relations.
     *
     * @var array
     */
    protected $cascades = [
        'entry',
    ];

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
     * Exclude any categories requested in settings.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeExclude(Builder $query)
    {
        $settings = app('Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface');
        $exclude = explode(',',$settings->value('lwv.module.news::category_exclude',''));
        return $query->whereNotIn('category_id', $exclude);
    }

    /**
     * Restrict to featured posts only.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeFeatured(Builder $query)
    {
        return $query
            ->where('featured', 1);
    }

    /**
     * Return the post's path.
     *
     * @return string
     */
    public function path()
    {
        return $this->dispatch(new GetPostPath($this));
    }

    /**
     * Get the string ID.
     *
     * @return string
     */
    public function getStrId()
    {
        return $this->str_id;
    }

    /**
     * Get the tags.
     *
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
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
     * Get the type.
     *
     * @return null|TypeInterface
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the type name.
     *
     * @return string
     */
    public function getTypeName()
    {
        $type = $this->getType();

        return $type->getName();
    }

    /**
     * Get the type description.
     *
     * @return string
     */
    public function getTypeDescription()
    {
        return $this->getType()->getDescription();
    }

    /**
     * Get the category.
     *
     * @return null|CategoryInterface
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Get the related entry.
     *
     * @return EntryInterface
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * Get the related entry's ID.
     *
     * @return null|int
     */
    public function getEntryId()
    {
        $entry = $this->getEntry();

        return $entry->getId();
    }

    /**
     * Return if the post is live or not.
     *
     * @return bool
     */
    public function isLive()
    {
        //return $this->isEnabled() && $this->getPublishAt()->diff(new \DateTime())->invert == 0;
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
     * Get the meta title.
     *
     * @return string
     */
    public function getMetaTitle()
    {
        if (!$this->meta_title) {
            return $this->getTitle();
        }

        return $this->meta_title;
    }

    /**
     * Get the meta keywords.
     *
     * @return array
     */
    public function getMetaKeywords()
    {
        return $this->meta_keywords;
    }

    /**
     * Get the meta description.
     *
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->meta_description;
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
     * Return if the model is
     * restorable or not.
     *
     * @return bool
     */
    public function isRestorable()
    {
        return $this->getType() ? true : false;
    }

    /**
     * Get the path to the post's type layout.
     *
     * @return string
     */
    public function getLayoutViewPath()
    {
        $type = $this->getType();

        /* @var EditorFieldType $layout */
        $layout = $type->getFieldType('layout');

        return $layout->getViewPath();
    }

    /**
     * Get the content.
     *
     * @return null|string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the content.
     *
     * @param $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the response.
     *
     * @return Response|null
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set the response.
     *
     * @param $response
     * @return $this
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Return the category relation.
     *
     * @return HasOne
     */
    public function category()
    {
        return $this->belongsTo('Lwv\NewsModule\Category\CategoryModel', 'category_id');
    }
}
