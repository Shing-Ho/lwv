<?php namespace Lwv\CareersModule\Job\Table\View;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class ArchivedQuery
 */
class ArchivedQuery
{

    /**
     * Handle the query.
     *
     * @param Builder $query
     */
    public function handle(Builder $query)
    {
        $query->where('active', false);
    }
}
