<?php namespace Lwv\DocumentsModule\Http\Controller\Admin;

use Lwv\DocumentsModule\Folder\Form\FolderFormBuilder;
use Lwv\DocumentsModule\Folder\Tree\FolderTreeBuilder;
use Lwv\DocumentsModule\Folder\Contract\FolderRepositoryInterface;
use Lwv\DocumentsModule\Document\Contract\DocumentRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;
use Illuminate\Routing\Redirector;

class FoldersController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param FolderTreeBuilder $tree
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(FolderTreeBuilder $tree, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.documents::folders.manage')) {
            $tree->setOption('sortable',false);
        }

        return $tree->render();
    }

    /**
     * Create a new entry.
     *
     * @param FolderFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(FolderFormBuilder $form, FolderRepositoryInterface $folders, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.documents::folders.manage')) {
            abort(403);
        }

        if ($parent = $this->request->get('parent')) {

            $form->setParent($folders->find($parent));
        }

        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param FolderFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(FolderFormBuilder $form, Authorizer $authorizer, $id)
    {
        if (!$authorizer->authorize('lwv.module.documents::folders.manage')) {
            abort(403);
        }

        return $form->render($id);
    }

    /**
     * Delete a page and go back.
     *
     * @param  FolderRepositoryInterface           $folders
     * @param  Authorizer                        $authorizer
     * @param                                    $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(FolderRepositoryInterface $folders, DocumentRepositoryInterface $documents, Authorizer $authorizer, $id)
    {
        if (!$authorizer->authorize('lwv.module.documents::folders.manage')) {
            abort(403);
        }

        $folders->delete($folder = $folders->find($id));

        return redirect()->back();
    }

    /**
     * Return the modal for choosing a folder.
     *
     * @param  ExtensionCollection $extensions
     * @param  string              $menu
     * @return \Illuminate\View\View
     */
    public function choose(FolderRepositoryInterface $folders)
    {
        return view(
            'module::admin/ajax/choose_folder',
            [
                'folders' => $folders->getModel()->orderBy('path')->get()
            ]
        );
    }

    /**
     * Return the modal for choosing a folder.
     *
     * @param  ExtensionCollection $extensions
     * @param  string              $menu
     * @return \Illuminate\View\View
     */
    public function minutes(FolderRepositoryInterface $folders)
    {
        return view(
            'module::admin/ajax/choose_folder',
            [
                'folders' => $folders->getModel()->where('folder_type','minutes')->orderBy('path')->get()
            ]
        );
    }
}
