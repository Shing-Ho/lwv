<?php namespace Lwv\NewsModule\Post\Form;

use Lwv\NewsModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class PostFormBuilder
 */
class PostFormBuilder extends FormBuilder
{

    /**
     * The post type.
     *
     * @var null|TypeInterface
     */
    protected $type = null;

    /**
     * The skipped fields.
     *
     * @var array
     */
    protected $skips = [
        'summary',
        'type',
        'entry',
        'str_id'
    ];

    /**
     * Fired when the builder is ready to build.
     *
     * @throws \Exception
     */
    public function onReady()
    {
        if (!$this->getType() && !$this->getEntry()) {
            throw new \Exception('The $type parameter is required when creating a post.');
        }
    }

    /**
     * Fired just before saving the form.
     */
    public function onSaving()
    {
        $entry = $this->getFormEntry();
        $type  = $this->getType();

        if (!$entry->type_id) {
            $entry->type_id = $type->getId();
        }
    }

    /**
     * Get the type.
     *
     * @return TypeInterface|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the type.
     *
     * @param TypeInterface $type
     * @return $this
     */
    public function setType(TypeInterface $type)
    {
        $this->type = $type;

        return $this;
    }
}
