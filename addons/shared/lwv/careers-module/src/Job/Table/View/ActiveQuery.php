<?php namespace Lwv\CareersModule\Job\Table\View;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class ActiveQuery
 */
class ActiveQuery
{

    /**
     * Handle the query.
     *
     * @param Builder $query
     */
    public function handle(Builder $query)
    {
        $query->where('active', true);
    }
}
