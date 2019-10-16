<?php namespace Lwv\DataModule\Http\Controller\Admin;

use Lwv\DataModule\Testimonial\Form\TestimonialFormBuilder;
use Lwv\DataModule\Testimonial\Table\TestimonialTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;

class TestimonialsController extends AdminController
{

    /**
     * Display an index of existing entries.
     */
    public function index(TestimonialTableBuilder $table, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.data::testimonials.manage')) {
            abort(403);
        }

        return $table->render();
    }

    /**
     * Create a new entry.
     */
    public function create(TestimonialFormBuilder $form, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.data::testimonials.manage')) {
            abort(403);
        }

        return $form->render();
    }

    /**
     * Edit an existing entry.
     */
    public function edit(TestimonialFormBuilder $form, Authorizer $authorizer, $id)
    {
        if (!$authorizer->authorize('lwv.module.data::testimonials.manage')) {
            abort(403);
        }

        return $form->render($id);
    }
}
