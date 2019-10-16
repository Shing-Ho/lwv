<?php namespace Lwv\ClubsModule\Club\Command;

use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;
use Lwv\ClubsModule\Club\Contract\ClubInterface;

/**
 * Class AddClubBreadcrumb
 */
class AddClubBreadcrumb
{

    /**
     * The club instance.
     *
     * @var ClubInterface
     */
    protected $club;

    /**
     * Create a new AddClubBreadcrumb instance.
     *
     * @param ClubInterface $club
     */
    public function __construct(ClubInterface $club)
    {
        $this->club = $club;
    }

    /**
     * Handle the command.
     *
     * @param SettingRepositoryInterface $settings
     * @param BreadcrumbCollection       $breadcrumbs
     */
    public function handle(BreadcrumbCollection $breadcrumbs)
    {
        $breadcrumbs->add(
            $this->club->title,
            $this->club->microsite()
        );
    }
}
