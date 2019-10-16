<?php namespace Lwv\DataModule\Floorplan\Table\Filter;

use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Query\GenericFilterQuery;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class SizeFilterQuery
 */
class SizeFilterQuery extends GenericFilterQuery
{

    /**
     * Handle the filter query.
     *
     * @param Builder         $query
     * @param FilterInterface $filter
     */
    public function handle(Builder $query, FilterInterface $filter)
    {
        if ($filter->getValue() == '<1000') {
            $query->where('size', '<', 1000);
        }

        if ($filter->getValue() == '>1000') {
            $query->where('size', '>=', 1000);
        }
    }
}
