<?php

declare(strict_types=1);

class News
{
    public static function published(int $limit = 0): array
    {
        $sql = 'SELECT * FROM news WHERE is_published = 1 ORDER BY published_at DESC';
        if ($limit > 0) {
            $sql .= ' LIMIT ' . (int) $limit;
        }
        return Database::fetchAll($sql);
    }

    public static function findBySlug(string $slug): ?array
    {
        return Database::fetch(
            'SELECT * FROM news WHERE slug = ? AND is_published = 1 LIMIT 1',
            [$slug]
        );
    }

    public static function allAdmin(): array
    {
        return Database::fetchAll('SELECT * FROM news ORDER BY created_at DESC');
    }
}
