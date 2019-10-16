<?php namespace Lwv\DocumentsModule;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Lwv\DocumentsModule\Folder\FolderModel;
use Lwv\DocumentsModule\Dccument\DocumentModel;

/**
 * Class DocumentsModulePlugin
 */

class DocumentsModulePlugin extends Plugin
{

    /**
     * Get the plugin functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'documents_folder',
                function ($path, $recursive = true) {
                    $folders = new FolderModel();
                    $folder = $folders->where('path',$path)->first();

                    return ($recursive) ? view('lwv.module.documents::folder/tree', compact('folder'))->render() : view('lwv.module.documents::folder/folder', compact('folder'))->render();
                }
                , ['is_safe' => ['html']]
            ),
            new \Twig_SimpleFunction(
                'documents_resolutions',
                function ($path) {
                    $folders = new FolderModel();
                    $folder = $folders->where('path',$path)->first();

                    return view('lwv.module.documents::resolutions/folder', compact('folder'))->render();
                }
                , ['is_safe' => ['html']]
            ),
        ];
    }
}
