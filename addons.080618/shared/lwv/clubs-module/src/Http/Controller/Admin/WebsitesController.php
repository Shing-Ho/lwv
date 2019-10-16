<?php namespace Lwv\ClubsModule\Http\Controller\Admin;

use Lwv\ClubsModule\Club\Contract\ClubRepositoryInterface;
use Lwv\ClubsModule\Club\Table\ClubTableBuilder;
use Lwv\ClubsModule\Header\Contract\HeaderRepositoryInterface;
use Lwv\ClubsModule\Website\Contract\WebsiteRepositoryInterface;
use Lwv\ClubsModule\Post\Contract\PostRepositoryInterface;
use Lwv\ClubsModule\Website\Form\WebsiteFormBuilder;
use Lwv\ClubsModule\Club\ClubModel;
use Lwv\ClubsModule\Website\WebsiteModel;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;


class WebsitesController extends AdminController
{

    /**
     * Display an index of existing entries.
     */
    public function index(ClubTableBuilder $table, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.clubs::websites.manage')) {
            abort(403);
        }

        return $table->setOption('websites',true)->render();
    }

    /**
     * Display website management landing page.
     */
    public function manage(ClubRepositoryInterface $clubRepository, WebsiteRepositoryInterface $websites, HeaderRepositoryInterface $headers, Authorizer $authorizer, $id)
    {
        if (!$authorizer->authorize('lwv.module.clubs::websites.manage')) {
            abort(403);
        }

        $clubs = $clubRepository->myClubs();

        if (!$club = $clubs->find($id)) {
            abort(404);
        }

        if (!$website = $websites->findByClub($id)) {
            $website = new WebsiteModel();
            $website->club_id = $id;
            $website->web_intro = $club->intro;
            $website->web_contact = '<p>'.$club->contact.'</p>';

            if ($headers->first()) {
                $website->header_id = $headers->first()->id;
            }

            $website->save();
        }

        return view('lwv.module.clubs::admin.website', compact('club'));
    }

    /**
     * Edit an existing entry.
     *
     * @param WebsiteFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(ClubRepositoryInterface $clubRepository, WebsiteRepositoryInterface $websites, HeaderRepositoryInterface $headers, WebsiteFormBuilder $form, Authorizer $authorizer, $id)
    {
        if (!$authorizer->authorize('lwv.module.clubs::websites.manage')) {
            abort(403);
        }

        $clubs = $clubRepository->myClubs();

        if (!$club = $clubs->find($id)) {
            abort(404);
        }

        if (!$website = $websites->findByClub($id)) {
            $website = new WebsiteModel();
            $website->club_id = $id;
            $website->web_intro = $club->intro;
            $website->web_contact = '<p>'.$club->contact.'</p>';

            if ($headers->first()) {
                $website->header_id = $headers->first()->id;
            }

            $website->save();
        }

        return $form->render($website->id);
    }

    /**
     * Preview club microsite.
     */
    public function preview(ClubRepositoryInterface $clubs, SettingRepositoryInterface $settings, Authorizer $authorizer, $id)
    {
        $module    = $settings->value('lwv.module.clubs::module_root', 'clubs');

        if (!$authorizer->authorize('lwv.module.clubs::websites.manage')) {
            abort(404);
        }

        if (!$club = $clubs->find($id)) {
            abort(404);
        }

        return redirect($module.'/preview/'.$club->slug,302);
    }
}
