<?php namespace Lwv\NewsModule\Post\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;

/**
 * Class GetSettings
 */
class GetSettings
{

    /**
     * Return the path for a post.
     *
     */
    public function __construct()
    {

    }

    /**
     * Handle the command.
     *
     */
    public function handle(SettingRepositoryInterface $settings)
    {
        $formatted = array();

        foreach ($settings->findAllByNamespace('lwv.module.news') as $key => $model) {
            $formatted[str_replace('lwv.module.news::','',$key)] = $model->value;
        }

        return $formatted;
    }
}
