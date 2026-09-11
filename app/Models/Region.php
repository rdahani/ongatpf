<?php

declare(strict_types=1);

class Region
{
    public static function all(): array
    {
        return Database::fetchAll('SELECT * FROM regions WHERE is_active = 1 ORDER BY sort_order ASC');
    }

    public static function findBySlug(string $slug): ?array
    {
        return Database::fetch('SELECT * FROM regions WHERE slug = ? LIMIT 1', [$slug]);
    }

    public static function withMeta(): array
    {
        $regions = self::all();
        foreach ($regions as &$region) {
            $projects = Project::byRegion((int) $region['id']);
            $region['projects_count'] = count($projects);
            $region['projects'] = $projects;
            $domainIds = [];
            foreach ($projects as $project) {
                foreach (Project::domains((int) $project['id']) as $domain) {
                    $domainIds[$domain['id']] = $domain;
                }
            }
            $region['domains'] = array_values($domainIds);
        }
        return $regions;
    }
}
