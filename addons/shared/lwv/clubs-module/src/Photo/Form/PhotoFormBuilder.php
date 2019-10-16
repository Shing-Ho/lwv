<?php namespace Lwv\ClubsModule\Photo\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Lwv\ClubsModule\Club\Contract\ClubInterface;
use Anomaly\Streams\Platform\Asset\AssetPaths;
use Lwv\DropzoneFieldType\File\FileUploader;

class PhotoFormBuilder extends FormBuilder
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
    protected $fields = [
        'image' => [
            'type'   => 'lwv.field_type.dropzone',
            'config' => [
                'accepted'       => 'image/*',
                'rules'          => 'required|mimes:jpeg,jpg|max:4096',
                'maxsize'        => 4,
                'maxfiles'       => 3,
                'message'        => 'Click or drop photo here to upload',
                'caption'        => '(JPG Format | < 4MB)',
            ]
        ],
        'description' => [
            'instructions' => 'Optionally enter a short description for this photo',
            'warning' => '50 Character Max',
            'config' => [
                'max'        => 50,
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
            'href' => 'admin/clubs/websites/photos/{request.route.parameters.club}'
        ]
    ];

    /**
     * The form options.
     *
     * @var array
     */
    protected $options = [
        'redirect' => 'admin/clubs/websites/photos/{request.route.parameters.club}'
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

        // Handle Photo
        $photos = [];

        if (count(array_filter($this->getFormValue('image')))) {
            foreach ($this->getFormValue('image') as $photo) {
                if (strrpos($photo,'::') && strlen(trim($photo))) {
                    // Consistently name files
                    $old = pathinfo($paths->realPath($photo), PATHINFO_BASENAME);
                    $new = uniqid('photo_'.$club->id.'_').'.'.pathinfo($paths->realPath($photo), PATHINFO_EXTENSION);
                    rename(pathinfo($paths->realPath($photo), PATHINFO_DIRNAME).'/'.$old, pathinfo($paths->realPath($photo), PATHINFO_DIRNAME).'/'.$new);
                    $photos[] = 'tmp::'.$new;
                }
            }

            if (count($photos)) {
                $photo = $uploader->upload($photos, 'clubs_images',1024);
                $entry->image = $photo->first();
            }
        }
    }
}
