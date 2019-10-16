<?php namespace Lwv\CareersModule\Applicant;

use Lwv\CareersModule\Applicant\Contract\ApplicantInterface;
use Anomaly\Streams\Platform\Model\Careers\CareersApplicantsEntryModel;

class ApplicantModel extends CareersApplicantsEntryModel implements ApplicantInterface
{
    /**
     * Get the associated job for this applicant
     */
    public function job()
    {
        return $this->hasOne('Lwv\CareersModule\Job\JobModel','id','job_id');
    }
}
