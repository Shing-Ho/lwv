<?php namespace Lwv\DataModule\Education\Table\View;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class ResidentQuery
 */
class ResidentQuery
{

    /**
     * Handle the query.
     *
     * @param Builder $query
     */
    public function handle(Builder $query)
    {
        $query->where('class_type', 'resident')->orderBy('sort_order');
    }
}
