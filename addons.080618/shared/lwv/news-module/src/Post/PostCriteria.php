<?php namespace Lwv\NewsModule\Post;

use Lwv\NewsModule\Type\Command\GetType;
use Lwv\NewsModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Entry\EntryCriteria;

/**
 * Class PostCriteria
 */
class PostCriteria extends EntryCriteria
{

    /**
     * Return only live.
     *
     * @return $this
     */
    public function live()
    {
        $this->query->where('enabled', true)
        ->where('publish_at', '<=', date('Y-m-d H:i:s'))
        ->where(function($query) {
            $query->whereNull('publish_until')
                ->orWhere('publish_until', '>', date('Y-m-d H:i:s'));
        });

        return $this;
    }

    /**
     * Return chronologically.
     *
     * @return $this
     */
    public function recent()
    {
        $this->live();

        $this->query->orderBy('publish_at', 'DESC');

        return $this;
    }

    /**
     * Return only featured.
     *
     * @return $this
     */
    public function featured()
    {
        $this->recent();

        $this->query->where('featured', true);

        return $this;
    }

    /**
     * Add the type constraint.
     *
     * @param $identifier
     * @return $this
     */
    public function type($identifier)
    {
        /* @var TypeInterface $type */
        $type = $this->dispatch(new GetType($identifier));

        $stream = $type->getEntryStream();
        $table  = $stream->getEntryTableName();

        $this->query
            ->select('posts_posts.*')
            ->where('type_id', $type->getId())
            ->join($table . ' AS entry', 'entry.id', '=', 'posts_posts.entry_id');

        return $this;
    }
}
