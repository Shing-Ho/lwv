<?php namespace Lwv\BlockTestimonialExtension\Http\Controller\Admin;

use Lwv\BlockTestimonialExtension\Block\Form\BlockFormBuilder;
use Lwv\BlockTestimonialExtension\Block\Table\BlockTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;
use Anomaly\PagesModule\Page\PageModel;
use Lwv\BlockTestimonialExtension\Block\BlockModel;
use Anomaly\Streams\Platform\Support\Authorizer;

class BlocksController extends AdminController
{
    /**
     * Display an index of existing entries.
     *
     * @param BlockTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(BlockTableBuilder $table, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('anomaly.module.pages::pages.write')) {
            abort(403);
        }

        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param BlockFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(BreadcrumbCollection $breadcrumbs, BlockFormBuilder $form, Authorizer $authorizer, $pid)
    {
        if (!$authorizer->authorize('anomaly.module.pages::pages.write')) {
            abort(403);
        }

        // Ensure page exists
        if (!$page = PageModel::find($pid)) {
            return redirect('/admin/pages',302);
        }

        $form->setPage($pid);

        // Add link to page
        $breadcrumbs->add($page->title,'/admin/pages/edit/'.$pid);

        return $form
            ->setActions(
                [
                    'save' => [
                        'redirect' => 'admin/pages/edit/' . $pid
                    ],
                ]
            )
            ->setButtons(
                [
                    'cancel' => [
                        'href' => 'admin/pages/edit/' . $pid
                    ],
                ]
            )
            ->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param BlockFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(BreadcrumbCollection $breadcrumbs,BlockFormBuilder $form, Authorizer $authorizer, $id)
    {
        if (!$authorizer->authorize('anomaly.module.pages::pages.write')) {
            abort(403);
        }

        $block = BlockModel::find($id);

        // Ensure page exists
        if (!$page = PageModel::find($block->page)) {
            return redirect('/admin/pages',302);
        }

        // Add link to page
        $breadcrumbs->add($page->title,'/admin/pages/edit/'.$page->id);

        return $form
            ->setActions(
                [
                    'save' => [
                        'redirect' => 'admin/pages/edit/' . $page->id
                    ],
                ]
            )
            ->setButtons(
                [
                    'cancel' => [
                        'href' => 'admin/pages/edit/' . $page->id
                    ],
                ]
            )
            ->render($id);
    }

    /**
     * Delete an existing entry.
     *
     */
    public function delete(Authorizer $authorizer, $id)
    {
        if (!$authorizer->authorize('anomaly.module.pages::pages.write')) {
            abort(403);
        }

        $block = BlockModel::find($id);

        // Ensure page exists
        if (!$page = PageModel::find($block->page)) {
            return redirect('/admin/pages',302);
        }

        if (!BlockModel::find($id)->delete()) {
            abort(500);
        }

        return redirect('/admin/pages/edit/'.$page->id,302);
    }
}
