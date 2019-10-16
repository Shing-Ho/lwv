<?php namespace Lwv\DropzoneFieldType\File;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\File\FileCollection;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Factory;
use League\Flysystem\MountManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Anomaly\Streams\Platform\Asset\AssetPaths;
use Anomaly\Streams\Platform\Image\Image;

/**
 * Class FileUploader
 *
 */
class FileUploader
{
    /**
     * The file repository.
     *
     * @var FileRepositoryInterface
     */
    protected $files;

    /**
     * The folder repository.
     *
     * @var FolderRepositoryInterface
     */
    protected $folders;

    /**
     * Asset paths
     *
     * @var AssetPaths
     */
    protected $paths;

    /**
     * The config repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * The mount manager.
     *
     * @var MountManager
     */
    protected $manager;

    /**
     * The validation factory.
     *
     * @var Factory
     */
    protected $validator;

    /**
     * The image manager.
     *
     * @var Image
     */
    protected $image;


    /**
     * Create a new FileUploader instance.
     * 
     * @param Factory $validator
     * @param MountManager $manager
     * @param Repository $config
     * @param FileRepositoryInterface $files
     * @param FolderRepositoryInterface $folders
     */
    public function __construct(
        Factory $validator,
        MountManager $manager,
        Repository $config,
        FileRepositoryInterface $files,
        FolderRepositoryInterface $folders,
        AssetPaths $paths,
        Image $image
    ) {
        $this->files     = $files;
        $this->folders   = $folders;
        $this->config    = $config;
        $this->manager   = $manager;
        $this->validator = $validator;
        $this->paths     = $paths;
        $this->image     = $image;
    }


    /**
     * Upload a file.
     *
     * @param array $tempfiles
     * @param string $target
     * @return FileCollection
     */
    public function upload($tempfiles, $target, $width = false, $height = false)
    {
        // Cleanse input
        $tempfiles = array_filter(
            array_map(
                function ($entry) {
                    return trim($entry);
                },
                $tempfiles
            )
        );
        
        // Get folder
        if (!$folder = $this->folders->findBySlug($target)) {
            abort(500,'Unable to locate folder ('.$target.')');
        }

        // Get Disk
        $disk = $folder->getDisk();

        // Build folder rules
        $rules = 'required';

        if ($allowed = $folder->getAllowedTypes()) {
            $rules .= '|mimes:' . implode(',', $allowed);
        }

        // Upload files
        $uploads = new FileCollection();

        foreach ($tempfiles as $tempfile) {
            $upload = new UploadedFile(
                $this->paths->realPath($tempfile),
                pathinfo($this->paths->realPath($tempfile), PATHINFO_BASENAME),
                mime_content_type($this->paths->realPath($tempfile)),
                filesize($this->paths->realPath($tempfile)),
                null,
                true
            );

            // Run validation
            $validation = $this->validator->make(['file' => $upload], ['file' => $rules]);

            if (!$validation->passes()) {
                abort(500,$validation->messages()->first());
            }

            // Is this file an image?  If so orientate it
            if (in_array($upload->getExtension(), $this->config->get('anomaly.module.files::mimes.types.image'))) {
                if ($width) {
                    if ($height) {
                        $orientated = $this->image->make($tempfile)->orientate()->fit($width, $height, function ($constraint) {
                            $constraint->aspectRatio();
                        })->path();
                    } else {
                        $orientated = $this->image->make($tempfile)->orientate()->resize($width, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })->path();
                    }
                } else {
                    $orientated = $this->image->make($tempfile)->orientate()->path();
                }

                $upload = new UploadedFile(
                    public_path(ltrim($this->paths->realPath($orientated),'/')),
                    pathinfo($this->paths->realPath($tempfile), PATHINFO_BASENAME),
                    mime_content_type(public_path(ltrim($this->paths->realPath($orientated),'/'))),
                    filesize(public_path(ltrim($this->paths->realPath($orientated),'/'))),
                    null,
                    true
                );
            }

            // Save file
            $file = $this->manager->put(
                $disk->getSlug() . '://' . $folder->getSlug() . '/' . $upload->getClientOriginalName(),
                file_get_contents($upload)
            );

            // Is this file an image?  If so set image attributes
            if (in_array($file->getExtension(), $this->config->get('anomaly.module.files::mimes.types.image'))) {
                $size = getimagesize($upload->getRealPath());
                $this->files->save($file->setAttribute('width', $size[0])->setAttribute('height', $size[1]));
            }

            unlink($this->paths->realPath($tempfile));
            $uploads->push($file);
        }

        return $uploads;
    }
}
