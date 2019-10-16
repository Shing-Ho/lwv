<?php namespace Lwv\CareersModule\Job;

use Anomaly\Streams\Platform\Entry\EntryCollection;

class JobCollection extends EntryCollection
{
    public function filters() {
        return array_unique(
            array_filter(
                array_map(
                    function ($entry) {
                        return $entry['department'];
                    },
                    $this->sortBy('department')->toArray()
                )
            )
        );
    }
}
