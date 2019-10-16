<?php namespace Lwv\NewsModule\Post\Form\Command;

use Lwv\NewsModule\Post\Contract\PostInterface;
use Lwv\NewsModule\Post\Form\PostEntryFormBuilder;
use Lwv\NewsModule\Post\Form\PostFormBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class AddPostFormFromPost
 */
class AddPostFormFromPost
{

    use DispatchesJobs;

    /**
     * The multiple form builder.
     *
     * @var PostEntryFormBuilder
     */
    protected $builder;

    /**
     * The post instance.
     *
     * @var PostInterface
     */
    protected $post;

    /**
     * Create a new AddPostFormFromPost instance.
     *
     * @param PostEntryFormBuilder $builder
     * @param PostInterface        $post
     */
    public function __construct(PostEntryFormBuilder $builder, PostInterface $post)
    {
        $this->builder = $builder;
        $this->post    = $post;
    }

    /**
     * Handle the command.
     *
     * @param PostFormBuilder $builder
     */
    public function handle(PostFormBuilder $builder)
    {
        $builder->setEntry($this->post->getId());

        $this->builder->addForm('post', $builder);
    }
}
