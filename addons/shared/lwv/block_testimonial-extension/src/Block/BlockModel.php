<?php namespace Lwv\BlockTestimonialExtension\Block;

use Lwv\BlockTestimonialExtension\Block\Contract\BlockInterface;
use Anomaly\Streams\Platform\Model\BlockTestimonial\BlockTestimonialBlocksEntryModel;
use Lwv\DataModule\Testimonial\TestimonialModel;
use DB;

class BlockModel extends BlockTestimonialBlocksEntryModel implements BlockInterface
{
    /**
     * Retrieve the testimonials for this block
     */
    public function testimonials()
    {
        if ($this->order == 'random') {
            return TestimonialModel::where('testimonial_category',$this->category)->where('approved',1)->orderBy(\DB::raw('RAND()'))->take($this->count)->get();
        } else {
            return TestimonialModel::where('testimonial_category',$this->category)->where('approved',1)->orderBy('created_at','DESC')->take($this->count)->get();
        }
    }
}
