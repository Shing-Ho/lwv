<?php namespace Lwv\DocumentsModule\Resolution;

use Lwv\DocumentsModule\Resolution\Contract\ResolutionInterface;
use Anomaly\Streams\Platform\Model\Documents\DocumentsResolutionsEntryModel;

class ResolutionModel extends DocumentsResolutionsEntryModel implements ResolutionInterface
{
    /**
     * Return the documents relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function document()
    {
        return $this->hasOne('Lwv\DocumentsModule\Document\DocumentModel', 'id', 'minutes_id');
    }
}
