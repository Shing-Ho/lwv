<?php namespace Lwv\BlockHeaderExtension\Http\Controller\Admin;

use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;
use Anomaly\PagesModule\Page\PageModel;
use Anomaly\Streams\Platform\Support\Authorizer;
use Lwv\BlocksModule\Block\BlockService;
use Lwv\BlockHeaderExtension\Image\Form\ImageFormBuilder;
use Lwv\BlockHeaderExtension\Image\Table\ImageTableBuilder;
use Lwv\BlockHeaderExtension\Block\BlockModel;
use Lwv\BlockHeaderExtension\Image\ImageModel;

class ImagesController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param ImageTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ImageTableBuilder $table, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('anomaly.module.pages::pages.write')) {
            abort(403);
        }

        return $table->render();
    }


    /**
     * Create a new entry.
     */
    public function create(BreadcrumbCollection $breadcrumbs, ImageFormBuilder $form, Authorizer $authorizer, BlockService $blockService, $id)
    {
        if (!$authorizer->authorize('anomaly.module.pages::pages.write')) {
            abort(403);
        }

        // Ensure block exists
        if (!$block = BlockModel::find($id)) {
            return redirect('/admin/pages',302);
        }

        // Ensure page exists
        if (!$page = PageModel::find($block->page)) {
            return redirect('/admin/pages',302);
        }

        // Init form
        $form->setBlock($block);
        $form->setExtension($blockService->getTypeBySlug($block->getStreamNamespace()));

        // Add breadcrumbs
        $breadcrumbs->add($page->title,'/admin/pages/edit/'.$page->id);
        $breadcrumbs->add($block->title,'/admin/blocks/'.$form->getExtension()->getSlug().'/edit/'.$form->getBlock()->getId());

        return $form
            ->setActions(
                [
                    'save' => [
                        'redirect' => 'admin/blocks/'.$form->getExtension()->getSlug().'/edit/' . $form->getBlock()->getId()
                    ],
                ]
            )
            ->setButtons(
                [
                    'cancel' => [
                        'href' => 'admin/blocks/'.$form->getExtension()->getSlug().'/edit/' . $form->getBlock()->getId()
                    ],
                ]
            )
            ->render();
    }

    /**
     * Edit an existing entry.
     */
    public function edit(BreadcrumbCollection $breadcrumbs, ImageFormBuilder $form, Authorizer $authorizer, BlockService $blockService, $id)
    {
        if (!$authorizer->authorize('anomaly.module.pages::pages.write')) {
            abort(403);
        }

        // Ensure image exists
        if (!$image = ImageModel::find($id)) {
            return redirect('/admin/pages',302);
        }

        // Ensure block exists
        if (!$block = BlockModel::find($image->block)) {
            return redirect('/admin/pages',302);
        }

        // Ensure page exists
        if (!$page = PageModel::find($block->page)) {
            return redirect('/admin/pages',302);
        }

        // Init form
        $form->setBlock($block);
        $form->setExtension($blockService->getTypeBySlug($block->getStreamNamespace()));

        // Add breadcrumbs
        $breadcrumbs->add($page->title,'/admin/pages/edit/'.$page->id);
        $breadcrumbs->add($block->title,'/admin/blocks/'.$form->getExtension()->getSlug().'/edit/'.$form->getBlock()->getId());


        return $form
            ->setActions(
                [
                    'save' => [
                        'redirect' => 'admin/blocks/'.$form->getExtension()->getSlug().'/edit/' . $form->getBlock()->getId()
                    ],
                ]
            )
            ->setButtons(
                [
                    'cancel' => [
                        'href' => 'admin/blocks/'.$form->getExtension()->getSlug().'/edit/' . $form->getBlock()->getId()
                    ],
                ]
            )
            ->render($id);
    }

    /**
     * Delete an existing entry.
     *
     */
    public function delete(Authorizer $authorizer, BlockService $blockService, $id)
    {
        if (!$authorizer->authorize('anomaly.module.pages::pages.write')) {
            abort(403);
        }

        // Ensure image exists
        if (!$image = ImageModel::find($id)) {
            return redirect('/admin/pages',302);
        }

        // Ensure block exists
        if (!$block = BlockModel::find($image->block)) {
            return redirect('/admin/pages',302);
        }

        if (!ImageModel::find($id)->delete()) {
            abort(500);
        }

        return redirect('admin/blocks/'.$blockService->getTypeBySlug($block->getStreamNamespace())->getSlug().'/edit/' . $block->id,302);
    }
}
