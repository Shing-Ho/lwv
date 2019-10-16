<?php namespace Lwv\DropzoneFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class DropzoneFieldType
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Lwv\DropzoneFieldType
 */
class DropzoneFieldType extends FieldType implements SelfHandling
{

    /**
     * No database column.
     *
     * @var bool
     */
    protected $columnType = false;

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'lwv.field_type.dropzone::input';

    /**
     * The field type config.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Create a new DropzoneFieldType instance.
     *
     * @param Repository $cache
     */
    public function __construct()
    {

    }

    /**
     * Get the config.
     *
     * @return array
     */
    public function getConfig()
    {
        $config = parent::getConfig();

        return $config;
    }

    /**
     * Handle saving the form data ourselves.
     *
     * @param FormBuilder $builder
     */
    public function handle(FormBuilder $builder)
    {
        $entry = $builder->getFormEntry();

        // See the accessor for how IDs are handled.
        $entry->{$this->getField()} = $this->getPostValue();
    }

    /**
     * Get the post value.
     *
     * @param null $default
     * @return array
     */
    public function getPostValue($default = null)
    {
        return explode(',', parent::getPostValue($default));
    }

    public function hasValue() {
        return (is_object($this->value) && get_class($this->value) == 'Anomaly\FilesModule\File\FileModel') ? true : false;
    }

    /**
     * Get the value for repopulating
     * field after failed validation.
     *
     * @param  null $default
     * @return mixed
     */
    public function getRepopulateValue($default = null)
    {
        return $this->getValue();
    }
}
