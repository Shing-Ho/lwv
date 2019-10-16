<?php namespace Lwv\DataModule\Http\Controller\Admin;

use Illuminate\Http\Request;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Anomaly\Streams\Platform\Support\Authorizer;


class StreamsController extends AdminController
{
    /**
     * Streams Index
     */
    public function index(StreamRepositoryInterface $streamRepository, Authorizer $authorizer)
    {
        $streams = [];
        $all = $streamRepository->findAllByNamespace('data');

        foreach ($all as $stream) {
            if ($authorizer->authorize('lwv.module.data::'.$stream->slug.'.manage')) {
                $streams[] = $stream;
            }
        }

        return view('lwv.module.data::admin.streams', compact('streams'));
    }
}