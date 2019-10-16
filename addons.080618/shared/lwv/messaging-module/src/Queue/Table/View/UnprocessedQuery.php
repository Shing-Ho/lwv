<?php namespace Lwv\MessagingModule\Queue\Table\View;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class UnprocessedQuery
 */
class UnprocessedQuery
{

    /**
     * Handle the query.
     *
     * @param Builder $query
     */
    public function handle(Builder $query)
    {
        $query->where('processed', false)->orderBy('created_at','DESC');
    }
}
