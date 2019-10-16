<?php namespace Lwv\MessagingModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

class MessagingModule extends Module
{
    /**
     * The navigation icon.
     *
     * @var string
     */
    protected $icon = 'fa fa-external-link';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'queue' => [],
    ];
}
