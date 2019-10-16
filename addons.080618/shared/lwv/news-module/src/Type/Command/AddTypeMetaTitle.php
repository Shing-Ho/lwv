<?php namespace Lwv\NewsModule\Type\Command;

use Lwv\NewsModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\View\ViewTemplate;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class AddTypeMetaTitle
 */
class AddTypeMetaTitle
{

    use DispatchesJobs;

    /**
     * The type instance.
     *
     * @var TypeInterface
     */
    protected $type;

    /**
     * Create a new AddTypeMetaTitle instance.
     *
     * @param TypeInterface $type
     */
    public function __construct(TypeInterface $type)
    {
        $this->type = $type;
    }

    /**
     * Handle the command.
     *
     * @param ViewTemplate $template
     */
    public function handle(ViewTemplate $template)
    {
        $template->set('meta_title', $this->type->getName());
    }
}
