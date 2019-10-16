<?php namespace Lwv\NewsModule\Post\Form\Command;

use Lwv\NewsModule\Post\Form\PostEntryFormBuilder;
use Lwv\NewsModule\Post\Form\PostFormBuilder;
use Lwv\NewsModule\Type\Contract\TypeRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class AddPostFormFromRequest
 */
class AddPostFormFromRequest
{

    /**
     * The multiple form builder.
     *
     * @var PostEntryFormBuilder
     */
    protected $builder;

    /**
     * Create a new AddPostFormFromRequest instance.
     *
     * @param PostEntryFormBuilder $builder
     */
    public function __construct(PostEntryFormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param TypeRepositoryInterface $types
     * @param PostFormBuilder         $builder
     * @param Request                 $request
     */
    public function handle(TypeRepositoryInterface $types, PostFormBuilder $builder, Request $request)
    {
        $this->builder->addForm('post', $builder->setType($types->find($request->get('type'))));
    }
}
