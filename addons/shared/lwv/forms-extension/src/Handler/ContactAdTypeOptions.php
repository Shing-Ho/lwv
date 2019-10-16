<?php namespace Lwv\FormsExtension\Handler;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Anomaly\SelectFieldType\SelectFieldType;
use Lwv\FormsExtension\FormsExtensionFunctions;

class ContactAdTypeOptions
{
    use DispatchesJobs;

    /**
     * Handle the select options.
     *
     * @param  SelectFieldType $fieldType
     * @return array
     */
    public function handle(SelectFieldType $fieldType, FormsExtensionFunctions $functions)
    {
        $options = [];

        if ($config = $functions->setForm('contact')->getFieldConfig('Trading Post','ad_type')) {
            foreach ($config as $key => $value) {
                $options[$key] = $value;
            }
        }

        $fieldType->setOptions($options);
    }
}
