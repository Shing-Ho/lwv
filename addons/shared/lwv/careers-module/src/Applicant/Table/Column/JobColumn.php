<?php namespace Lwv\CareersModule\Applicant\Table\Column;

use Anomaly\Streams\Platform\Ui\Table\Component\Column\Column;

/**
 * Class JobColumn
 *
 */
class JobColumn extends Column
{
    /**
     * Create a new PreviewColumn instance.
     *
     * @param
     */
    public function __construct()
    {

    }

    /**
     * Get the value.
     *
     * @return string
     */
    public function getValue()
    {
        if ($job = $this->entry->job) {
            return $job->title.' (<i>'.$job->type.'</i>)';
        }

        return null;
    }
}
