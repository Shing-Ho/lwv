<?php namespace Lwv\MessagingModule\Queue\Table\View;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class ProcessedQuery
 */
class ProcessedQuery
{

    /**
     * Handle the query.
     *
     * @param Builder $query
     */
    public function handle(Builder $query)
    {
        $query->where('processed', true)->orderBy('created_at','DESC');
    }
}
