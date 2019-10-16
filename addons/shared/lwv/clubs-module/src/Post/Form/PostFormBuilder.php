<?php namespace Lwv\ClubsModule\Post\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\Asset\AssetPaths;
use Lwv\ClubsModule\Club\Contract\ClubInterface;
use Lwv\DropzoneFieldType\File\FileUploader;
use Carbon\Carbon;

class PostFormBuilder extends FormBuilder
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
        'title',
        'slug' => [
            'label' => 'Friendly URL',
            'instructions' => 'The URL below will be appended to the website address to form the URL for this post.',
        ],
        'post_type',
        'image' => [
            'label' => 'Hero Image',
            'type'   => 'lwv.field_type.dropzone',
            'config' => [
                'accepted'       => 'image/*',
                'rules'          => 'required|mimes:jpeg,jpg|max:8192',
                'maxsize'        => 8,
                'maxfiles'       => 3,
                'message'        => 'Click or drop photo here to upload',
                'caption'        => '(JPG Format | < 8MB)',
            ]
        ],
        'teaser',
        'body',
        'enabled',
        'publish_at',
        'publish_until'
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
            'href' => 'admin/clubs/websites/posts/{request.route.parameters.club}?view={request.input.view}'
        ]
    ];

    /**
     * The form options.
     *
     * @var array
     */
    protected $options = [
        'redirect' => 'admin/clubs/websites/posts/{request.route.parameters.club}?view={request.input.view}'
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
     * Default publish_at to now.
     *
     * @param  ClubInterface $club
     * @return $this
     */
    public function setPublishNow()
    {
        $this->setFormValue('publish_at',Carbon::now());

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
                    $new = uniqid('post_'.$club->id.'_').'.'.pathinfo($paths->realPath($photo), PATHINFO_EXTENSION);
                    rename(pathinfo($paths->realPath($photo), PATHINFO_DIRNAME).'/'.$old, pathinfo($paths->realPath($photo), PATHINFO_DIRNAME).'/'.$new);
                    $photos[] = 'tmp::'.$new;
                }
            }

            if (count($photos)) {
                $photo = $uploader->upload($photos, 'clubs_images',1024);
                $entry->image = $photo->first();
            }
        } else {
            $entry->image = null;
        }
    }
}
