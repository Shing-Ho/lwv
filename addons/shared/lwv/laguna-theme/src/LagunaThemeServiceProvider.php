<?php namespace Lwv\LagunaTheme;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class LagunaThemeServiceProvider
 *
 * @link          http://www.pyrocms.com/streams-platform
 * @author        Ryan McDaniel <ryan@itinnovative.com>
 * @package       Lwv\LagunaTheme
 */
class LagunaThemeServiceProvider extends AddonServiceProvider
{

    /**
     * The view overrides.
     *
     * @var array
     */
    protected $overrides = [
        'streams::errors/500' => 'theme::overrides/errors/500',
        'streams::errors/404' => 'theme::overrides/errors/404',
        'anomaly.field_type.select::dropdown' => 'theme::overrides/fields/dropdown',
    ];

}
