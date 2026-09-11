<?php

declare(strict_types=1);

class NewsController extends Controller
{
    public function index(): void
    {
        view('pages/actualites/index', $this->seo(
            'Actualités | ATPF Niger',
            'Suivez les actualités, projets et initiatives d\'ATPF sur le terrain.'
        ) + [
            'articles' => News::published(),
        ]);
    }

    public function show(string $slug): void
    {
        $article = News::findBySlug($slug);
        if (!$article) {
            http_response_code(404);
            view('pages/404', ['title' => 'Article introuvable', 'metaDescription' => '']);
            return;
        }

        view('pages/actualites/show', $this->seo(
            $article['meta_title'] ?: ($article['title'] . ' | ATPF'),
            $article['meta_description'] ?: truncate($article['excerpt'], 155),
            [
                'schemaType' => 'Article',
                'schemaData' => [
                    'headline' => $article['title'],
                    'datePublished' => $article['published_at'],
                    'author' => $article['author_name'] ?: 'ATPF',
                ],
            ]
        ) + [
            'article' => $article,
            'related' => array_slice(array_filter(
                News::published(),
                fn($n) => $n['id'] !== $article['id']
            ), 0, 3),
        ]);
    }
}
