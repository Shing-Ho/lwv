<?php namespace Lwv\BlocksModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

class BlocksModule extends Module
{

    /**
     * This module does not
     * display in navigation.
     *
     * @var bool
     */
    protected $navigation = true;

    /**
     * The navigation icon.
     *
     * @var string
     */
    protected $icon = 'fa fa-cubes';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'blocks' => [],
        'templates' => [
            'buttons' => [
                'new_template'
            ]
        ],
        'manage_pages' => [
            'href'        => 'admin/pages',
        ]
    ];
}