<?php namespace Lwv\ClubsModule\Club\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;

/**
 * Class AddClubsBreadcrumb
 */
class AddClubsBreadcrumb
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
            'Clubs',
            $settings->value('lwv.module.clubs::module_root', 'clubs')
        );
    }
}
