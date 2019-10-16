<?php namespace Lwv\DropzoneFieldType\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory;

class FilesController extends PublicController
{

    /**
     * Upload photos and format for processing in form handler
     */
    public function upload(Request $request, Factory $validator)
    {

        if ($rules = $request->header('X-RULES')) {
            $file = $request->file('file');
            $target = preg_replace("/[^a-z0-9_\s\.-]/", "", strtolower($file->getClientOriginalName()));
            $target = preg_replace("/[\s-]+/", " ", $target);
            $target = preg_replace("/[\s]/", "-", $target);

            $validation = $validator->make(['file' => $file], ['file' => $rules]);

            if (!$validation->passes()) {
                throw new \Exception($validation->messages()->first(), 1);
            }

            if ($file->move(dirname($file->getRealPath()),$target)) {
                return $this->response->json(['upload' => "tmp::".$target]);
            }
        }

        return $this->response->json(['error' => 'There was a problem uploading the file.'], 500);
    }
}