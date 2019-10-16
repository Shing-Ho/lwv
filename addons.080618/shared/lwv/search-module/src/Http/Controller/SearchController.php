<?php namespace Lwv\SearchModule\Http\Controller;

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\PagesModule\Page\Contract\PageRepositoryInterface;
use Anomaly\Streams\Platform\Stream\StreamModel;
use Lwv\SearchModule\Search\Index\IndexManager;
use Lwv\SearchModule\Search\Command\GetConfig;

class SearchController extends PublicController
{
    public function page(PageRepositoryInterface $pages, Application $application, IndexManager $index, $id) {
        if (!$page = $pages->findByStrId($id)) {
            abort(404);
        }

        // Delete index entries for this page
        $index->deleteBy(['field' => 'page', 'value' => $id]);

        foreach ($page->getTranslations() as $translation) {
            $application->setLocale($translation->locale);
            $content = $page->content();
            $key = 'page-'.$page->id.'-'.$translation->locale;

            // Create index entry
            $ix = [
                'id' => $key,
                'fields' => [
                    'title' => $translation->title,
                    'content' => $this->cleanse($content),
                    'locale' => $translation->locale,
                    'page' => $page->id,
                ],
                'extra' => [
                    'title' => $translation->title,
                    'content' => $this->cleanse($content),
                    'locale' => $translation->locale,
                    'page' => $page->id,
                    'type' => 'page',
                    'link' => $page->getPath(),
                    'timestamp' => $page->lastModified()->timestamp,
                ]
            ];

            $index->insert($ix);
            return $ix['fields']['content'];
        }
    }

    public function entry(StreamModel $streams, Application $application, IndexManager $index, $namespace, $slug, $id) {
        $stream = $streams->where('namespace',$namespace)->where('slug',$slug)->first();
        $model = $stream->getEntryModel();
        $config = $this->dispatch(new GetConfig());
        $config = $config[get_class($model)];

        $fieldId = is_int($id) ? 'id' : 'str_id';
        $fieldIx = $config['namespace'].$config['stream'];
        $fieldContent = $config['content'];
        $fieldTitle = $config['title'];
        $methodPath = $config['path'];

        if (!$entry = $model->where($fieldId,$id)->first()) {
            abort(404);
        }

        // Delete index entries for this page
        $index->deleteBy(['field' => $fieldIx, 'value' => $entry->id]);

        foreach ($entry->getTranslations() as $translation) {
            $application->setLocale($translation->locale);
            $path = str_replace('//','/','/'.$entry->$methodPath());
            $content = $entry->getEntry()->$fieldContent;
            $key = $fieldIx.'-'.$entry->id.'-'.$translation->locale;

            // Create index entry
            $ix = [
                'id' => $key,
                'fields' => [
                    'title' => $translation->$fieldTitle,
                    'content' => $this->cleanse($content),
                    'locale' => $translation->locale,
                    $fieldIx => $entry->id,
                ],
                'extra' => [
                    'title' => $translation->$fieldTitle,
                    'content' => $this->cleanse($content),
                    'locale' => $translation->locale,
                    $fieldIx => $entry->id,
                    'type' => $config['namespace'],
                    'link' => $path,
                    'timestamp' => $entry->lastModified()->timestamp,
                ]
            ];

            $index->insert($ix);
            return $ix['fields']['content'];
        }
    }

    private function cleanse($text) {
        $tags = array("script","style");

        foreach ($tags as $tag) {
            $text = preg_replace('/<' . $tag . '.*?>.*?<\/' . $tag . '>/is','',$text);
        }

        $text = preg_replace('/\r\n|\r|\n/u', ' ', strip_tags($text));
        $text = preg_replace('/\s\s+/u', ' ', $text);

        return trim($text);
    }
}