<?php namespace Lwv\ClubsModule\Post;

use Anomaly\Streams\Platform\Entry\EntryCollection;

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
