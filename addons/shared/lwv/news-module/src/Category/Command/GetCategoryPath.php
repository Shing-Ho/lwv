<?php namespace Lwv\NewsModule\Category\Command;

use Lwv\NewsModule\Category\Contract\CategoryInterface;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;

/**
 * Class GetCategoryPath
 */
class GetCategoryPath
{

    /**
     * The category instance.
     *
     * @var CategoryInterface
     */
    protected $category;

    /**
     * Create a new GetCategoryPath instance.
     *
     * @param CategoryInterface $category
     */
    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }

    /**
     * Handle the command.
     *
     * @param SettingRepositoryInterface $settings
     * @return string
     */
    public function handle(SettingRepositoryInterface $settings)
    {
        return $settings->value('lwv.module.news::module_segment', 'news')
        . '/' . $settings->value('lwv.module.news::category_segment', 'category')
        . '/' . $this->category->getSlug();
    }
}
