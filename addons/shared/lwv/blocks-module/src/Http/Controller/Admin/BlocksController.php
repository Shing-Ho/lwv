<?php namespace Lwv\BlocksModule\Http\Controller\Admin;

use Illuminate\Http\Request;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\PagesModule\Page\PageModel;
use Anomaly\Streams\Platform\Support\Authorizer;
use Lwv\BlocksModule\Block\BlockService;
use Lwv\BlocksModule\Block\BlockModel;
use Lwv\BlocksModule\Block\Command\PurgeBlockCache;
use Lwv\BlocksModule\Template\Form\TemplateFormBuilder;

class BlocksController extends AdminController
{
    /**
     * Block Index
     */
    public function index(BlockService $blockService)
    {
        $types = $blockService->getTypes();
        return view('lwv.module.blocks::admin.blocks', compact('types'));
    }

    /**
     * Reorder blocks
     */
    public function order(Request $request)
    {
        // Did user send in a block ordering POST?
        if ($request->isMethod('post')) {
            if ($request->order) {
                $ids = explode(',', $request->order);
                $order_count = 1;

                foreach ($ids as $id)
                {
                    $items = explode('|', $id);
                    $weight = $order_count;
                    $model = new BlockModel();
                    $model->updateWeight($items[0],$items[1],$weight);
                    $order_count++;
                }

                // Purge the block cache on reorder
                $page = PageModel::find($request->page);
                $this->dispatch(new PurgeBlockCache($page));

                return 'ordered';
            }
            abort(404);
        }

        abort(404);
    }

    /**
     * Choose a block type from supported block types
     */
    public function choose(BlockService $blockService, $page) {
        return $this->response->view(
            'module::ajax/choose',
            [
                'types' => $blockService->getTypes(),
                'page' => $page
            ]
        );
    }

    /**
     * Copy specified block to target page
     */
    public function copy(Request $request, BlockService $blockService, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('anomaly.module.pages::pages.write')) {
            abort(403);
        }

        if ($request->isMethod('post')) {
            $block_type = $request->block_type;
            $block_id = $request->block_id;
            $page = $request->page;

            // Ensure page exists
            if (!$page = PageModel::find($page)) {
                abort(500);
            }


            if ($blockService->copy($block_type, $block_id, $page)) {
                $this->messages->success('Block Successfully Copied');
                return json_encode('success');
            } else {
                abort(500);
            }
        }
    }


    /**
     * Copy specified block to target page
     */
    public function bulk_copy(Request $request, BlockService $blockService, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('anomaly.module.pages::pages.write')) {
            abort(403);
        }

        if ($request->isMethod('get')) {
            $block_type = $request->block_type;
            $block_id = $request->block_id;
            $pages = $request->pages;

            foreach (explode(',',$pages) as $page) {
                // Ensure page exists
                if (!$page = PageModel::find($page)) {
                    abort(500);
                }

                if (!$blockService->copy($block_type, $block_id, $page)) {
                    abort(500);
                }
            }

            return 'Block Successfully Copied';
        }
    }
}