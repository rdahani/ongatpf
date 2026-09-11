<?php

declare(strict_types=1);

class Project
{
    public static function published(int $limit = 0, bool $featuredOnly = false): array
    {
        $sql = "SELECT * FROM projects WHERE is_published = 1";
        if ($featuredOnly) {
            $sql .= " AND is_featured = 1";
        }
        $sql .= " ORDER BY sort_order ASC, published_at DESC";
        if ($limit > 0) {
            $sql .= " LIMIT " . (int) $limit;
        }
        return Database::fetchAll($sql);
    }

    public static function findBySlug(string $slug): ?array
    {
        return Database::fetch(
            'SELECT * FROM projects WHERE slug = ? AND is_published = 1 LIMIT 1',
            [$slug]
        );
    }

    public static function find(int $id): ?array
    {
        return Database::fetch('SELECT * FROM projects WHERE id = ? LIMIT 1', [$id]);
    }

    public static function allAdmin(): array
    {
        return Database::fetchAll('SELECT * FROM projects ORDER BY updated_at DESC');
    }

    public static function regions(int $projectId): array
    {
        return Database::fetchAll(
            'SELECT r.* FROM regions r
             INNER JOIN project_regions pr ON pr.region_id = r.id
             WHERE pr.project_id = ?',
            [$projectId]
        );
    }

    public static function domains(int $projectId): array
    {
        return Database::fetchAll(
            'SELECT d.* FROM domains d
             INNER JOIN project_domains pd ON pd.domain_id = d.id
             WHERE pd.project_id = ?',
            [$projectId]
        );
    }

    public static function byRegion(int $regionId): array
    {
        return Database::fetchAll(
            'SELECT p.* FROM projects p
             INNER JOIN project_regions pr ON pr.project_id = p.id
             WHERE pr.region_id = ? AND p.is_published = 1
             ORDER BY p.sort_order ASC',
            [$regionId]
        );
    }
}
