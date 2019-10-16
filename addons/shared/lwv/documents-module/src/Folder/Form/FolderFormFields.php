<?php namespace Lwv\DocumentsModule\Folder\Form;

use Lwv\DocumentsModule\Folder\Contract\FolderInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;

class FolderFormFields
{

    use DispatchesJobs;

    /**
     * Handle the folder fields.
     *
     * @param FolderFormBuilder $builder
     */
    public function handle(FolderFormBuilder $builder)
    {
        $parent = $builder->getParent();

        /* @var FolderInterface $entry */
        if (!$parent && $entry = $builder->getFormEntry()) {
            $parent = $entry->getParent();
        }

        $builder->setFields(
            [
                '*'
            ]
        );
    }
}
