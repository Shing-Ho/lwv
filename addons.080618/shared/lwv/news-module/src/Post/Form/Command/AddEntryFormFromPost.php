<?php namespace Lwv\NewsModule\Post\Form\Command;

use Lwv\NewsModule\Entry\Form\EntryFormBuilder;
use Lwv\NewsModule\Post\Contract\PostInterface;
use Lwv\NewsModule\Post\Form\PostEntryFormBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class AddEntryFormFromPost
 */
class AddEntryFormFromPost
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
     * Create a new AddEntryFormFromPost instance.
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
     * @param EntryFormBuilder $builder
     */
    public function handle(EntryFormBuilder $builder)
    {
        $type = $this->post->getType();

        $builder->setModel($type->getEntryModelName());
        $builder->setEntry($this->post->getEntryId());

        $this->builder->addForm('entry', $builder);
    }
}
