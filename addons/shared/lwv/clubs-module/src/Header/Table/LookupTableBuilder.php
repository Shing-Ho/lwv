<?php namespace Lwv\ClubsModule\Header\Table;

use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class LookupTableBuilder
 */
class LookupTableBuilder extends TableBuilder
{

    /**
     * The field type configuration.
     *
     * @var null|Collection
     */
    protected $config = null;

    /**
     * The ajax flag.
     *
     * @var bool
     */
    protected $ajax = true;

    /**
     * The table filters.
     *
     * @var string
     */
    protected $filters = [];

    /**
     * The table columns.
     *
     * @var string
     */
    protected $columns = [
        'entry.image.preview(120,120)',
        'entry.image_layout.value',
        'entry.image_position.value',
    ];

    /**
     * The table buttons.
     *
     * @var string
     */
    protected $buttons = LookupTableButtons::class;

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [
        'sortable' => false,
        'title'    => 'lwv.module.clubs::message.choose_header'
    ];

    /**
     * Return a config value.
     *
     * @param      $key
     * @param null $default
     * @return mixed
     */
    public function config($key, $default = null)
    {
        return $this->config->get($key, $default);
    }

    /**
     * Get the config.
     *
     * @return Collection|null
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Set the config.
     *
     * @param Collection $config
     * @return $this
     */
    public function setConfig(Collection $config)
    {
        $this->config = $config;

        return $this;
    }
}
