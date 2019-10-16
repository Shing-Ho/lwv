<?php namespace Lwv\NewsModule\Type\Command;

use Lwv\NewsModule\Type\Contract\TypeInterface;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;

/**
 * Class GetTypePath
 */
class GetTypePath
{

    /**
     * The category instance.
     *
     * @var TypeInterface
     */
    protected $category;

    /**
     * Create a new GetTypePath instance.
     *
     * @param TypeInterface $category
     */
    public function __construct(TypeInterface $category)
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
        . '/' . $this->category->getSlug();
    }
}
