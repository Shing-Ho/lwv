<?php namespace Lwv\DataModule\Faq;


use Illuminate\Foundation\Bus\DispatchesJobs;
use Anomaly\SelectFieldType\SelectFieldType;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;

class FaqCategoryOptions
{
    use DispatchesJobs;

    /**
     * Handle the select options.
     *
     * @param  SelectFieldType $fieldType
     * @return array
     */
    public function handle(SelectFieldType $fieldType, SettingRepositoryInterface $settings)
    {
        $options = [];
        $config = array_filter(
            explode("\r\n",trim($settings->value('lwv.module.data::faq_categories', ''))),
            function ($line) {
                return trim($line);
            }
        );

        foreach ($config as $category) {
            $options[$category] = $category;
        }

        $fieldType->setOptions($options);
    }
}
