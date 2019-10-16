<?php namespace Lwv\SearchModule\Search\Command;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Illuminate\Contracts\Config\Repository;

/**
 * Class GetConfig
 */
class GetConfig
{
    /**
     * Entry Type.
     */
    protected $type;

    /**
     * Create a new GetConfig instance.
     */
    public function __construct($type = null)
    {
        $this->type = $type;
    }

    /**
     * Handle the command.
     */
    public function handle(ModuleCollection $modules, Repository $config)
    {
        $items = [];

        foreach ($modules->withConfig('search') as $module) {

            foreach ($config->get($module->getNamespace('search')) as $model => $configuration) {
                $items[$model] = $configuration;
            }

        }

        if ($this->type) {
            $items = array_filter(
                $items,
                function ($item) {
                    return isset($item['type']) && $item['type'] == $this->type;
                }
            );
        }

        return $items;
    }
}