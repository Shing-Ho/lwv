<?php namespace Lwv\ClubsModule\Document\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Lwv\ClubsModule\Club\Contract\ClubInterface;
use Anomaly\Streams\Platform\Asset\AssetPaths;
use Lwv\DropzoneFieldType\File\FileUploader;

class DocumentFormBuilder extends FormBuilder
{
    /**
     * The club.
     *
     * @var null|ClubInterface
     */
    protected $club = null;

    /**
     * The form fields.
     *
     * @var array|string
     */
    protected $fieldss = [
        'title',
        'description',
        'document' => [
            'type'   => 'lwv.field_type.dropzone',
            'config' => [
                'accepted'       => 'application/pdf',
                'rules'          => 'required|mimes:pdf|max:8192',
                'maxsize'        => 8,
                'maxfiles'       => 3,
                'message'        => 'Click or drop document here to upload',
                'caption'        => '(PDF | < 8MB)',
            ]
        ],
    ];

    /**
     * Fields to skip.
     *
     * @var array|string
     */
    protected $skips = [
        'club'
    ];

    /**
     * The form actions.
     *
     * @var array|string
     */
    protected $actions = [
        'save'
    ];

    /**
     * The form buttons.
     *
     * @var array|string
     */
    protected $buttons = [
        'cancel' => [
            'href' => 'admin/clubs/websites/documents/{request.route.parameters.club}'
        ]
    ];

    /**
     * The form options.
     *
     * @var array
     */
    protected $options = [
        'redirect' => 'admin/clubs/websites/documents/{request.route.parameters.club}'
    ];

    /**
     * The form sections.
     *
     * @var array
     */
    protected $sections = [];

    /**
     * The form assets.
     *
     * @var array
     */
    protected $assets = [];

    /**
     * Get the club.
     *
     * @return null|ClubInterface
     */
    public function getClub()
    {
        return $this->club;
    }

    /**
     * Set the club.
     *
     * @param  ClubInterface $club
     * @return $this
     */
    public function setClub(ClubInterface $club)
    {
        $this->club = $club;

        return $this;
    }

    /**
     * Fired just before saving the form.
     */
    public function onSaving(FileUploader $uploader, AssetPaths $paths)
    {
        $entry  = $this->getFormEntry();
        $club = $this->getClub();

        // Handle Club
        $entry->club_id = $club->getId();
    }
}
