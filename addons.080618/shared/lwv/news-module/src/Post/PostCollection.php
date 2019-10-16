<?php namespace Lwv\NewsModule\Post;

use Anomaly\Streams\Platform\Entry\EntryCollection;

/**
 * Class PostCollection
 */
class PostCollection extends EntryCollection
{

    /**
     * Return only live posts.
     *
     * @return PostCollection
     */
    public function live()
    {
        return $this->filter(
            function (PostInterface $post) {
                return $post->isLive();
            }
        );
    }
}
