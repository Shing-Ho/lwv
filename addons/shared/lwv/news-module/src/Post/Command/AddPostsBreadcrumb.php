<?php namespace Lwv\NewsModule\Post\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;

/**
 * Class AddPostsBreadcrumb
 */
class AddPostsBreadcrumb
{

    /**
     * Handle the command.
     *
     * @param SettingRepositoryInterface $settings
     * @param BreadcrumbCollection       $breadcrumbs
     */
    public function handle(SettingRepositoryInterface $settings, BreadcrumbCollection $breadcrumbs)
    {
        $breadcrumbs->add(
            'lwv.module.news::breadcrumb.posts',
            $settings->value('lwv.module.news::module_segment', 'news')
        );
    }
}
