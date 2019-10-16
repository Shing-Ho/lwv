<?php namespace Lwv\BlocksModule\Page\Table;

use Illuminate\Contracts\Cache\Repository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

/**
 * Class PagesTableFilters
 */
class PageTableFilters
{

    use DispatchesJobs;

    /**
     * Handle the filters.
     *
     * @param PageTableBuilder          $builder
     */
    public function handle(
        PageTableBuilder $builder
    ) {
        $allowed = [];

        $builder
            ->setFilters(
                [
                    'search' => [
                        'fields' => [
                            'title',
                        ]
                    ],
                ]
            );
    }
}
