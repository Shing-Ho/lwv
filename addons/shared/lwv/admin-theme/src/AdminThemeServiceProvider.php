<?php namespace Lwv\AdminTheme;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Illuminate\Pagination\AbstractPaginator;


/**
 * Class AdminThemeServiceProvider
 *
 * @author        ITInnovative <ryan@itinnovative.com>
 * @author        Ryan McDaniel <ryan@itinnovative.com>
 * @package       Lwv\AdminTheme
 */
class AdminThemeServiceProvider extends AddonServiceProvider
{

    /**
     * Register the addon.
     */
    public function register()
    {
        AbstractPaginator::$defaultView       = 'lwv.theme.admin::pagination/bootstrap-4';
        AbstractPaginator::$defaultSimpleView = 'streams::pagination/simple-bootstrap-4';
    }
}
