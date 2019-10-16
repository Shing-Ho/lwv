<?php namespace Lwv\SearchModule;

use Illuminate\Http\Request;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Anomaly\PagesModule\Page\Tree\PageTreeBuilder;
use Lwv\SearchModule\SearchModuleFunctions;
use Mmanos\Search\Search;
use App;

/**
 * Class SearchModulePlugin
 */

class SearchModulePlugin extends Plugin
{

    public function __construct()
    {
    }

    /**
     * Get the plugin functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'search',
                function () {
                    $config = app('Illuminate\Contracts\Config\Repository');
                    $search = new Search();
                    $request = app('request');
                    $functions = new SearchModuleFunctions();
                    $authorizer = app('Anomaly\Streams\Platform\Support\Authorizer');

                    $results = [];
                    $locale = App::getLocale();
                    $query = [
                        'q' => $request->input('q'),
                        'type' => ($request->input('type')) ? $request->input('type') : 'pages',
                        'path' => $request->input('path'),
                        'phrase' => ($request->input('phrase')) ? true : false,
                        //'phrase' => true,
                        'refer' => $request->input('refer')
                        ];

                    if ($query['q']) {
                        switch ($query['type']) {
                            case 'pages':
                                $entries = $search
                                    ->search(['title','content'], $query['q'], ['phrase' => $query['phrase']])
                                    ->get();

                                foreach ($entries as $result) {
                                    if ($result['locale'] == $locale) {
                                        $result['excerpt'] = $functions->relevantExcerpt(explode(' ',$query['q']), $result['content'], 300, 75);
                                        $results[] = $result;
                                    }
                                }

                                $results = array_slice($results,0,$config->get('lwv.module.search::engine.limit'));

                                break;
                            case 'documents':
                                if ($authorizer->authorize('lwv.module.documents::documents.private')) {
                                    $entries = $search
                                        ->index('documents')
                                        ->search(['title','content'], $query['q'], ['phrase' => $request->input('phrase') ? true : false ])
                                        ->get();
                                } else {
                                    $entries = $search
                                        ->index('documents')
                                        ->search(['title','content'], $query['q'], ['phrase' => $request->input('phrase') ? true : false ])
                                        ->where('private', 0)
                                        ->get();
                                }

                                foreach ($entries as $result) {
                                    if ($query['path'] && substr($result['path'],0,strlen($query['path'])) != $query['path']) {
                                        continue;
                                    }

                                    $result['excerpt'] = $functions->relevantExcerpt(explode(' ',$query['q']), $result['content'], 150, 75);
                                    $results[] = $result;
                                }

                                $results = array_slice($results,0,$config->get('lwv.module.search::engine.limit'));

                                break;
                        }
                    }

                    return view('lwv.module.search::results', compact('query','results'))->render();
                }, ['is_safe' => ['html']]
            ),
            new \Twig_SimpleFunction(
                'sitemap',
                function () {
                    $builder = app('Lwv\SearchModule\Sitemap\Tree\SitemapTreeBuilder');
                    $tree = $builder->build()->getTree();

                    return view('lwv.module.search::sitemap/tree', compact('tree'))->render();
                }, ['is_safe' => ['html']]
            ),
        ];
    }
}
