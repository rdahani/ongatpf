<?php

declare(strict_types=1);

class ProjectController extends Controller
{
    public function index(): void
    {
        view('pages/projets/index', $this->seo(
            'Nos projets | ATPF Niger',
            'Découvrez les projets d\'ATPF : restauration des paysages, Parc W, Zone Girafe et autonomisation des femmes.'
        ) + [
            'projects' => Project::published(),
        ]);
    }

    public function show(string $slug): void
    {
        $project = Project::findBySlug($slug);
        if (!$project) {
            http_response_code(404);
            view('pages/404', ['title' => 'Projet introuvable', 'metaDescription' => '']);
            return;
        }

        view('pages/projets/show', $this->seo(
            $project['meta_title'] ?: ($project['title'] . ' | ATPF'),
            $project['meta_description'] ?: truncate($project['summary'], 155)
        ) + [
            'project' => $project,
            'regions' => Project::regions((int) $project['id']),
            'domains' => Project::domains((int) $project['id']),
            'related' => array_slice(array_filter(
                Project::published(),
                fn($p) => $p['id'] !== $project['id']
            ), 0, 2),
        ]);
    }
}
