<?php namespace Lwv\ClubsModule\Http\Controller;

use Anomaly\FilesModule\File\FileLocator;
use Anomaly\FilesModule\File\FileDownloader;
use Anomaly\FilesModule\File\FileReader;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Support\Authorizer;
use Lwv\ClubsModule\Club\Command\AddClubsBreadcrumb;
use Lwv\ClubsModule\Club\Command\AddClubBreadcrumb;
use Lwv\ClubsModule\Club\Contract\ClubRepositoryInterface;
use Lwv\ClubsModule\Website\Contract\WebsiteRepositoryInterface;
use Lwv\ClubsModule\Post\Contract\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

/**
 * Class ClubsController
 */
class ClubsController extends PublicController
{

    /**
     * Display club microsite.
     */
    public function microsite(ClubRepositoryInterface $clubs, WebsiteRepositoryInterface $websites, PostRepositoryInterface $postRepository, $slug)
    {
        if (!$club = $clubs->findBySlug($slug)) {
            abort(404);
        }

        if (!$website = $websites->findByClub($club->id)) {
            abort(404);
        }

        if (!$website->enabled) {
            abort(404);
        }

        $news = $postRepository->getRecent($club->id,'news',6);
        $events = $postRepository->getRecent($club->id,'events',6);

        $this->dispatch(new AddClubsBreadcrumb());
        $this->dispatch(new AddClubBreadcrumb($club));

        return view('module::microsite', compact('club','website','news','events'));
    }

    /**
     * Preview club microsite.
     */
    public function preview(ClubRepositoryInterface $clubs, WebsiteRepositoryInterface $websites, PostRepositoryInterface $postRepository, Authorizer $authorizer, $slug)
    {
        if (!$authorizer->authorize('lwv.module.clubs::websites.manage')) {
            abort(404);
        }

        if (!$club = $clubs->findBySlug($slug)) {
            abort(404);
        }

        if (!$website = $websites->findByClub($club->id)) {
            abort(404);
        }

        $news = $postRepository->getRecent($club->id,'news',6);
        $events = $postRepository->getRecent($club->id,'events',6);

        $this->dispatch(new AddClubsBreadcrumb());
        $this->dispatch(new AddClubBreadcrumb($club));

        return view('module::microsite', compact('club','website','news','events'));
    }

    /**
     * Download a document
     */
    public function download(FileLocator $locator, FileDownloader $downloader, Request $request, Redirector $redirect, $name)
    {
        if (!$file = $locator->locate('clubs_documents', urldecode($name))) {
            abort(404);
        }

        // Prevent caching by appending version info
        if (!$request->input('v')) {
            return $redirect->to($request->path().'?v='.$file->lastModified()->timestamp);
        }

        return $downloader->download($file);
    }

    /**
     * Return a documents file contents.
     */
    public function read(FileLocator $locator, FileReader $reader, Request $request, Redirector $redirect, $name)
    {
        if (!$file = $locator->locate('clubs_documents', urldecode($name))) {
            abort(404);
        }

        // Prevent caching by appending version info
        if (!$request->input('v')) {
            return $redirect->to($request->path().'?v='.$file->lastModified()->timestamp);
        }

        return $reader->read($file);
    }
}
