<?php namespace Lwv\CareersModule\Http\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Lwv\CareersModule\Job\JobModel;

class SearchController extends PublicController
{
    public function search(Request $request, JobModel $jobModel)
    {
        if ($request->input('type')) {
            $redirect = $request->input('redirect');
            $jobs = $jobModel->where('active',1)->where('type',$request->input('type'))->get();

            return view('lwv.module.careers::results', compact('jobs','redirect'))->render();
        }

        return json_encode('Error');
    }
}