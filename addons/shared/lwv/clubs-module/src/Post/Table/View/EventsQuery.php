<?php namespace Lwv\ClubsModule\Post\Table\View;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class EventsQuery
 */
class EventsQuery
{

    /**
     * Handle the query.
     *
     * @param Builder $query
     */
    public function handle(Builder $query)
    {
        $query->where('post_type', 'events');
    }
}
