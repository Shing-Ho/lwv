<?php namespace Lwv\ClubsModule\Post;

use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Anomaly\Streams\Platform\Image\Image;
use Intervention\Image\Constraint;

class PostPresenter extends EntryPresenter
{
    /**
     * Return the publish at date.
     *
     * @return Carbon
     */
    public function date()
    {
        return $this->object->getPublishAt();
    }

    /**
     * Return the post's image preview
     */
    public function imagePreview()
    {
        /* @var Image $image */
        $image = app(Image::class);

        return $image->make(($this->object->image) ? $this->object->image : 'module::img/'.$this->object->post_type.'.jpg')
            ->resize(
                64,
                64,
                function (Constraint $constraint) {
                    $constraint->aspectRatio();
                }
            )->image();
    }

    /**
     * Return the post's image preview
     */
    public function postImage()
    {
        /* @var Image $image */
        $image = app(Image::class);

        return $image->make(($this->object->image) ? $this->object->image : 'module::img/'.$this->object->post_type.'.jpg')
            ->fit(640,400)
            ->output();
    }

    /**
     * Return the post's status as a label.
     *
     * @param  string      $size
     * @return null|string
     */
    public function statusLabel($size = 'sm')
    {
        $color  = 'default';
        $status = $this->status();

        switch ($status) {
            case 'scheduled':
                $color = 'info';
                break;

            case 'draft':
                $color = 'default';
                break;

            case 'live':
                $color = 'success';
                break;

            case 'expired':
                $color = 'danger';
                break;
        }

        return '<span class="tag tag-' . $size . ' tag-' . $color . '">' . trans(
                'lwv.module.clubs::field.status.option.' . $status
            ) . '</span>';
    }

    /**
     * Return the status key.
     *
     * @return null|string
     */
    public function status()
    {
        if (!$this->object->isEnabled()) {
            return 'draft';
        }

        if ($this->object->isExpired()) {
            return 'expired';
        }

        if ($this->object->isScheduled()) {
            return 'scheduled';
        }

        if ($this->object->isLive()) {
            return 'live';
        }

        return null;
    }
}
