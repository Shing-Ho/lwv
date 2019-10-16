<?php namespace Lwv\SpamFieldType;

use Illuminate\Container\Container;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

class SpamFieldType extends FieldType
{
    use DispatchesJobs;

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
    protected $inputView = 'lwv.field_type.spam::input';

    /**
     * The field type config.
     *
     * @var array
     */
    protected $config = [];

    /**
     * The field
     *
     * @var null|array
     */
    protected $spam = null;

    /**
     * Create a new SpamFieldType instance.
     */
    public function __construct() {
    }

    /**
     * Get the field value.
     *
     * @return string
     */
    public function getSpam()
    {
        if ($this->spam === null) {
            return base64_encode(time());
        }

        return $this->spam;
    }

    /**
     * Set the field.
     *
     * @param string $spam
     * @return $this
     */
    public function setSpam($spam)
    {
        $this->spam = $spam;

        return $this;
    }

    /**
     * Reset the field value.
     *
     * @return string
     */
    public function resetSpam()
    {
        $this->spam = base64_encode(time());

        return $this->spam;
    }

    public function handle()
    {
        return;
    }
}
