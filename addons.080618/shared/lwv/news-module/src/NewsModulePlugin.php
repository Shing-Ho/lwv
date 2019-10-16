<?php namespace Lwv\NewsModule;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Lwv\NewsModule\Category\CategoryModel;
use Lwv\NewsModule\Post\PostModel;

/**
 * Class NewsModulePlugin
 */

class NewsModulePlugin extends Plugin
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
                'news_count',
                function ($categories) {
                    if (!is_array($categories)) { return false; }

                    if ($categories = CategoryModel::whereIn('slug',$categories)->get()) {
                        $id = array_map(
                            function ($category) {
                                return $category['id'];
                            },
                            $categories->toArray()
                        );

                        $posts = PostModel::featured()->live()->whereIn('category_id',$id)->take(1)->get();

                        return $posts->count();
                    }
                }
            ),
            new \Twig_SimpleFunction(
                'news_category',
                function ($categories, $limit, $link = false) {
                    if (!is_array($categories)) { return false; }

                    if ($categories = CategoryModel::whereIn('slug',$categories)->get()) {
                        $id = array_map(
                            function ($category) {
                                return $category['id'];
                            },
                            $categories->toArray()
                        );

                        $posts = PostModel::featured()->live()->whereIn('category_id',$id)->OrderBy('publish_at', 'DESC')->take($limit)->get();
                        $link = ($link) ? $link : '/news';

                        return view('lwv.module.news::posts/category', compact('posts','link'))->render();
                    }
                }
                , ['is_safe' => ['html']]
            ),
            new \Twig_SimpleFunction(
                'news_feature',
                function ($limit) {
                    $posts = PostModel::featured()->live()->take($limit)->get();

                    return view('lwv.module.news::posts/feature', compact('posts'))->render();
                }
                , ['is_safe' => ['html']]
            ),
            new \Twig_SimpleFunction(
                'news_folder',
                function ($categories, $limit, $title, $icon = '') {
                    if (!is_array($categories)) { return false; }

                    if ($categories = CategoryModel::whereIn('slug',$categories)->get()) {
                        $id = array_map(
                            function ($category) {
                                return $category['id'];
                            },
                            $categories->toArray()
                        );

                        $posts = PostModel::live()->whereIn('category_id',$id)->OrderBy('publish_at', 'DESC')->take($limit)->get();

                        return view('lwv.module.news::posts/folder', compact('posts','categories','title','icon'))->render();
                    }
                }
                , ['is_safe' => ['html']]
            ),
            new \Twig_SimpleFunction(
                'news_feature_menu',
                function ($limit) {
                    $posts = PostModel::featured()->live()->take($limit)->get();

                    return view('lwv.module.news::posts/feature_menu', compact('posts'))->render();
                }
                , ['is_safe' => ['html']]
            ),
        ];
    }
}
