<?php namespace Lwv\NewsModule\Post\Table\Filter;

use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Query\GenericFilterQuery;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class StatusFilterQuery
 */
class StatusFilterQuery extends GenericFilterQuery
{

    /**
     * Handle the filter query.
     *
     * @param Builder         $query
     * @param FilterInterface $filter
     */
    public function handle(Builder $query, FilterInterface $filter)
    {
        if ($filter->getValue() == 'live') {
            $query->live();
        }

        if ($filter->getValue() == 'scheduled') {
            $query->where('enabled', true)->where('publish_at', '>', date('Y-m-d H:i:s'));
        }

        if ($filter->getValue() == 'draft') {
            $query->where('enabled', false);
        }

        if ($filter->getValue() == 'expired') {
            $query->where('enabled', true)->where('publish_until', '<', date('Y-m-d H:i:s'));
        }
    }
}
