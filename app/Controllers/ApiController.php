<?php

declare(strict_types=1);

class ApiController extends Controller
{
    public function region(string $slug): void
    {
        $region = Region::findBySlug($slug);
        if (!$region) {
            json_response(['error' => 'Région introuvable'], 404);
        }

        $projects = Project::byRegion((int) $region['id']);
        $domains = [];
        foreach ($projects as $project) {
            foreach (Project::domains((int) $project['id']) as $domain) {
                $domains[$domain['id']] = [
                    'title' => $domain['title'],
                    'slug' => $domain['slug'],
                ];
            }
        }

        json_response([
            'name' => $region['name'],
            'slug' => $region['slug'],
            'description' => $region['description'],
            'photo' => $region['photo'],
            'projects_count' => count($projects),
            'projects' => array_map(fn($p) => [
                'title' => $p['title'],
                'slug' => $p['slug'],
                'summary' => $p['summary'],
                'zone' => $p['zone'],
                'url' => base_path('projets/' . $p['slug']),
            ], $projects),
            'domains' => array_values($domains),
        ]);
    }
}
