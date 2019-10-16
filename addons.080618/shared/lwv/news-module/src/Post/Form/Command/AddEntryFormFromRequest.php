<?php namespace Lwv\NewsModule\Post\Form\Command;

use Lwv\NewsModule\Entry\Form\EntryFormBuilder;
use Lwv\NewsModule\Post\Form\PostEntryFormBuilder;
use Lwv\NewsModule\Type\Contract\TypeRepositoryInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

/**
 * Class AddEntryFormFromRequest
 */
class AddEntryFormFromRequest
{

    use DispatchesJobs;

    /**
     * The multiple form builder.
     *
     * @var PostEntryFormBuilder
     */
    protected $builder;

    /**
     * Create a new AddEntryFormFromRequest instance.
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
     * @param EntryFormBuilder        $builder
     * @param Request                 $request
     */
    public function handle(TypeRepositoryInterface $types, EntryFormBuilder $builder, Request $request)
    {
        $type = $types->find($request->get('type'));

        $this->builder->addForm('entry', $builder->setModel($type->getEntryModelName()));
    }
}
