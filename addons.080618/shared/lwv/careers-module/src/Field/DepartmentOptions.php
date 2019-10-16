<?php namespace Lwv\CareersModule\Field;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Anomaly\SelectFieldType\SelectFieldType;
use Lwv\CareersModule\Job\JobModel;

class DepartmentOptions
{
    use DispatchesJobs;


    /**
     * Handle the select options.
     *
     * @param  SelectFieldType $fieldType
     * @param \Lwv\CareersModule\Job\JobModel $model
     *
     * @return array
     */

    public function handle(SelectFieldType $fieldType, JobModel $model)
    {
        $options = [];

        foreach ($model->departments() as $entry) {
            $options[$entry] = $entry;
        }

        $fieldType->setOptions($options);
    }
}
