<?php namespace Lwv\SearchModule;

use Illuminate\Http\Request;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Anomaly\PagesModule\Page\Tree\PageTreeBuilder;
use Lwv\SearchModule\SearchModuleFunctions;
use Mmanos\Search\Search;
use Anomaly\Streams\Platform\Model\News\NewsPostsEntryModel;
use App;

/**
 * Class SearchModulePlugin
 */

class SearchModulePlugin extends Plugin
{

    public function __construct()
    {
    }

    
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
                     $results1 = [];
                    $locale = App::getLocale();
                    $category = $request->input('category')?$request->input('category'):"";
                    $query = [
                        'q' => $request->input('q'),
                        'category' => $request->input('category'),
                        'type' => ($request->input('type')) ? $request->input('type') : 'pages',
                        'path' => $request->input('path'),
                        'phrase' => ($request->input('phrase')) ? true : false,
                        'refer' => $request->input('refer')
                        ];

                    if ($query['q']) {
                        switch ($query['type']) {
                            case 'pages':
                                   $respo = $search
                                         ->search(['title','content'], $query['q'], ['phrase' => $query['phrase']]);
                                    $entries1 =$search
                                         ->search(['title','content'], $query['q'], ['phrase' => $query['phrase']])->get();
                                   if($category==""){
                                      $entries =$respo->paginate(10);
                                      $pages['total']       = $entries->total(); 
                                      $pages['currentPage'] = $entries->currentPage(); 

                                    }else { $entries =$respo->get(); 
                                       $pages['total']       = 10; 
                                       $pages['currentPage'] = 1; 
                                    }
                                     
                                $paginate = $entries;
                                foreach ($entries as $result) { 
                                        if ($result['locale'] == $locale) {
                                        $result['excerpt'] = $functions->relevantExcerpt(explode(' ',$query['q']), $result['content'], 300, 75);
                                        $results[] = $result;
                                    }
                                }

                                  foreach ($entries1 as $result1) { 
                                        if ($result1['locale'] == $locale) {
                                        $result1['excerpt'] = $functions->relevantExcerpt(explode(' ',$query['q']), $result1['content'], 300, 75);
                                        $results1[] = $result1;
                                    }
                                }
                               
                               
                                 $results = array_slice($results,0,$config->get('lwv.module.search::engine.limit'));
                                 $results1 = array_slice($results1,0,$config->get('lwv.module.search::engine.limit'));

 
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
                    

                     $json = file_get_contents(dirname(__FILE__).'/pageid.json');
                     $page = (json_decode($json,true));
                  
                     $inf['events_count']=$inf['news_count']=$inf['others_count']=$inf['residents_count']=$inf['amenities_count']=$inf['document_count']=0;
                    
                     $res['data']=[]; 

                  
                     foreach ($results1 as &$data) {
                         
                         if(isset($data['page'])){
                          $data['type']=isset($page[$data['page']])?$page[$data['page']]:$data['type'];
                          }
                          else if(isset($data['newsposts'])){
                              $info= NewsPostsEntryModel::where('id',$data['newsposts'])->first(); 
                              if($info['category_id']==6) { $data['type']="events";  }
                         }
                       
                         if($data['type']=="news") 
                            $inf['news_count']++;
                         else if($data['type']=="events")   
                           $inf['events_count']++;
                         else if($data['type']=="residents") 
                            $inf['residents_count']++;
                         else if($data['type']=="amenities") 
                            $inf['amenities_count']++;
                         else if($data['type']=="document") 
                           $inf['document_count']++;
                         else  {
                            $inf['others_count']++;
                         }

                      }
 
                     foreach ($results as &$data) {
                         
                         if(isset($data['page'])){
                          $data['type']=isset($page[$data['page']])?$page[$data['page']]:$data['type'];
                          }
                          else if(isset($data['newsposts'])){
                              $info= NewsPostsEntryModel::where('id',$data['newsposts'])->first(); 
                              if($info['category_id']==6) { $data['type']="events";  }
                         }
                       
                       
                         
                         
                          $data['title']=str_ireplace($query['q'],"<span class='search-res'>".ucfirst($query['q'])."</span>",$data['title']);
                          $data['excerpt']=str_ireplace($query['q'],"<span class='search-res'>".$query['q']."</span>",$data['excerpt']);

                         if($category!="") {
                              if($data['type']==$category) {
                                 $res['data'][]=$data;
                              }
                          }else $res['data'][]=$data;
                      
                     }
                     
                     $results= $res['data'];
                    
                  
                    
                   
                    return view('lwv.module.search::results', compact('pages','query','results','inf'))->render();
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
