<?php namespace Lwv\DataModule\Education\Table\View;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class EmeritusQuery
 */
class EmeritusQuery
{

    /**
     * Handle the query.
     *
     * @param Builder $query
     */
    public function handle(Builder $query)
    {
        $query->where('class_type', 'emeritus')->orderBy('sort_order');
    }
}
