<?php namespace Lwv\BlockHeaderExtension\Block;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Anomaly\SelectFieldType\SelectFieldType;
use Anomaly\NavigationModule\Menu\MenuModel;

class MenuOptions
{
    use DispatchesJobs;

    /**
     * Handle the select options.
     *
     * @param  SelectFieldType $fieldType
     * @return array
     */
    public function handle(SelectFieldType $fieldType, MenuModel $menuModel)
    {
        $options = [];

        foreach ($menuModel->where('slug','like','featured_%')->get() as $menu) {
            $options[$menu->slug] = $menu->name;
        }

        $fieldType->setOptions($options);
    }
}
