<?php

use Lwv\NewsModule\Post\Contract\PostInterface;
use Lwv\NewsModule\Post\Contract\PostRepositoryInterface;
use Illuminate\Contracts\Config\Repository;
use Roumen\Sitemap\Sitemap;

return [
    'lastmod' => function (PostRepositoryInterface $posts) {

        if (!$post = $posts->lastModified()) {
            return null;
        }

        return $post->lastModified()->toAtomString();
    },
    'entries' => function (PostRepositoryInterface $posts) {
        return $posts->getLive();
    },
    'handler' => function (Sitemap $sitemap, Repository $config, PostInterface $entry) {

        $translations = [];

        foreach ($config->get('streams::locales.enabled') as $locale) {
            if ($locale != $config->get('streams::locales.default')) {
                $translations[] = [
                    'language' => $locale,
                    'url'      => url($locale . $entry->route('view')),
                ];
            }
        }

        $sitemap->add(
            url($entry->path()),
            $entry->lastModified()->toAtomString(),
            0.5,
            'monthly',
            [],
            null,
            $translations
        );
    },
];
