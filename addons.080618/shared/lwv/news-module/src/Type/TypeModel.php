<?php namespace Lwv\NewsModule\Type;

use Lwv\NewsModule\Type\Command\GetTypeStream;
use Lwv\NewsModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Model\News\NewsTypesEntryModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Class TypeModel
 */
class TypeModel extends NewsTypesEntryModel implements TypeInterface
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
     * Get the slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->desciption;
    }

    /**
     * Get the related entry stream.
     *
     * @return StreamInterface
     */
    public function getEntryStream()
    {
        return $this->dispatch(new GetTypeStream($this));
    }

    /**
     * Get the related entry stream ID.
     *
     * @return integer
     */
    public function getEntryStreamId()
    {
        $stream = $this->getEntryStream();

        return $stream->getId();
    }

    /**
     * Get the related entry model name.
     *
     * @return string
     */
    public function getEntryModelName()
    {
        $stream = $this->getEntryStream();

        return $stream->getEntryModelName();
    }

    /**
     * Get related posts.
     *
     * @return PostCollection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Return the posts relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('Lwv\NewsModule\Post\PostModel', 'type_id');
    }
}
