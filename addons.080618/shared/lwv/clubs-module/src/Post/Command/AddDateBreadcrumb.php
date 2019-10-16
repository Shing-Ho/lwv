<?php namespace Lwv\ClubsModule\Post\Command;

use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;
use Illuminate\Http\Request;
use Carbon\Carbon;

/**
 * Class AddDateBreadcrumb
 */
class AddDateBreadcrumb
{
    /**
     * The date
     **/
    protected $date;

    /**
     * Create a new AddDateBreadcrumb instance.
     *
     * @param Carbon $date
     */
    public function __construct($date)
    {
        $this->date = $date;
    }

    /**
     * Handle the command.
     *
     * @param Request              $request
     * @param BreadcrumbCollection $breadcrumbs
     */
    public function handle(Request $request, BreadcrumbCollection $breadcrumbs)
    {
        $breadcrumbs->add(
            $this->date,
            $request->fullUrl()
        );
    }
}
