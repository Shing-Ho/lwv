<?php namespace Lwv\FormsExtension\Handler;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Anomaly\CheckboxesFieldType\CheckboxesFieldType;
use Lwv\FormsExtension\FormsExtensionFunctions;

class ContactSubscribeOptions
{
    use DispatchesJobs;

    /**
     * Handle the checkbox options.
     *
     * @param  CheckboxFieldType $fieldType
     * @return array
     */
    public function handle(CheckboxesFieldType $fieldType, FormsExtensionFunctions $functions)
    {
        $options = [];

        if ($config = $functions->setForm('contact')->getFieldConfig('Subscribe','subscribe')) {
            foreach ($config as $key => $value) {
                $options[$key] = $value;
            }
        }

        $fieldType->setOptions($options);
    }
}
