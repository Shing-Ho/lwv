<?php namespace Lwv\FormsExtension\Handler;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Anomaly\SelectFieldType\SelectFieldType;
use Lwv\FormsExtension\FormsExtensionFunctions;

class ContactInterestOptions
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

        // Load options from settings if we have them
        if ($config = $functions->setForm('contact')->getConfig()) {
            foreach ($config as $key => $option) {
                $options[$key] = $key;
            }

            // Did we pass in a value for this field?
            if (isset($_GET['interest'])) {
                $fieldType->setValue($_GET['interest']);
            }
        }

        $fieldType->setOptions($options);
    }
}
