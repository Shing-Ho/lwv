<?php namespace Lwv\ClubsModule\Website\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\Asset\AssetPaths;
use Lwv\DropzoneFieldType\File\FileUploader;

class WebsiteFormBuilder extends FormBuilder
{

    /**
     * The form fields.
     *
     * @var array|string
     */
    protected $fields = [
        'enabled',
        'header',
        'logo' => [
            'type'   => 'lwv.field_type.dropzone',
            'config' => [
                'accepted'       => 'image/*',
                'rules'          => 'required|mimes:jpeg,jpg|max:2048',
                'maxsize'        => 2,
                'maxfiles'       => 1,
                'message'        => 'Click or drop logo here to upload',
                'caption'        => '(JPG Format | < 2MB)',
            ]
        ],
        'web_intro',
        'web_contact',
        'web_body',
        'club',
    ];

    /**
     * Fields to skip.
     *
     * @var array|string
     */
    protected $skips = [];

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
            'href' => 'admin/clubs/websites/manage/{entry.club_id}'
        ]
    ];

    /**
     * The form options.
     *
     * @var array
     */
    protected $options = [
        'redirect' => 'admin/clubs/websites/manage/{entry.club_id}'
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
     * Fired just before building.
     */
    public function onBuilt()
    {
        $this->getFormField('club')->setHidden(true);
    }

    /**
     * Fired just before saving the form.
     */
    public function onSaving(FileUploader $uploader, AssetPaths $paths)
    {
        $entry  = $this->getFormEntry();
        $club = $entry->club()->first();

        // Handle Logo
        $logos = [];

        if (count(array_filter($this->getFormValue('logo')))) {
            foreach ($this->getFormValue('logo') as $logo) {
                if (strrpos($logo,'::') && strlen(trim($logo))) {
                    // Consistently name files
                    $old = pathinfo($paths->realPath($logo), PATHINFO_BASENAME);
                    $new = 'logo_'.$club->id.'.'.pathinfo($paths->realPath($logo), PATHINFO_EXTENSION);
                    rename(pathinfo($paths->realPath($logo), PATHINFO_DIRNAME).'/'.$old, pathinfo($paths->realPath($logo), PATHINFO_DIRNAME).'/'.$new);
                    $logos[] = 'tmp::'.$new;
                }
            }

            if (count($logos)) {
                $logo = $uploader->upload($logos, 'clubs_images', 500);
                $entry->logo = $logo->first();
            }
        } else {
            $entry->logo = null;
        }
    }
}
