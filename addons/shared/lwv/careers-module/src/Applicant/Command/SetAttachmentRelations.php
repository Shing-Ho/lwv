<?php namespace Lwv\CareersModule\Applicant\Command;

use Anomaly\FilesModule\File\FileModel;
use Anomaly\FilesModule\File\FileCollection;
use Lwv\CareersModule\Applicant\ApplicantModel;

/**
 * Class SetAttachmentRelations
 */
class SetAttachmentRelations
{

    /**
     * The file collection.
     *
     * @var FileCollection
     */
    protected $files;

    /**
     * @var ApplicantModel
     */
    protected $applicant;


    /**
     * Create a new SetAttachmentsRelations instance.
     *
     * @param ApplicantModel $applicant
     * @param FileCollection $files
     */
    public function __construct(ApplicantModel $applicant, FileCollection $files)
    {
        $this->applicant = $applicant;
        $this->files = $files;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        /* @var FileModel $file */
        foreach ($this->files as $file) {
            $this->applicant->setRelation('children', $this->links->children($link));
        }
    }
}
