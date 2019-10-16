<?php namespace Lwv\ClubsModule\Post\Table\View;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class NewsQuery
 */
class NewsQuery
{

    /**
     * Handle the query.
     *
     * @param Builder $query
     */
    public function handle(Builder $query)
    {
        $query->where('post_type', 'news');
    }
}
