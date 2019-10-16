<?php namespace Lwv\NewsModule\Post;

use Lwv\NewsModule\Post\Contract\PostInterface;
use Anomaly\Streams\Platform\Support\Authorizer;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class PostAuthorizer
 */
class PostAuthorizer
{

    /**
     * The authorization utility.
     *
     * @var Guard
     */
    protected $guard;

    /**
     * The authorizer utility.
     *
     * @var Authorizer
     */
    protected $authorizer;

    /**
     * Create a new PostAuthorizer instance.
     *
     * @param Guard      $guard
     * @param Authorizer $authorizer
     */
    public function __construct(Guard $guard, Authorizer $authorizer)
    {
        $this->guard      = $guard;
        $this->authorizer = $authorizer;
    }

    /**
     * Authorize the post.
     *
     * @param PostInterface $post
     */
    public function authorize(PostInterface $post)
    {
        if (!$post->isEnabled() && !$this->authorizer->authorize('lwv.module.news::posts.manage')) {
            abort(404);
        }
    }
}
