<?php namespace Lwv\CareersModule\Job;

use Lwv\CareersModule\Job\Contract\JobInterface;
use Anomaly\Streams\Platform\Model\Careers\CareersJobsEntryModel;

class JobModel extends CareersJobsEntryModel implements JobInterface
{
    public function types() {
        $settings = app('Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface');

        return array_unique(
            array_filter(
                array_map(
                    function ($entry) {
                        return trim($entry);
                    },
                    explode(PHP_EOL,$settings->value('lwv.module.careers::careers_types'))
                )
            )
        );
    }

    public function departments() {
        $settings = app('Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface');

        return array_unique(
            array_filter(
                array_map(
                    function ($entry) {
                        return trim($entry);
                    },
                    explode(PHP_EOL,$settings->value('lwv.module.careers::careers_departments'))
                )
            )
        );
    }
}
