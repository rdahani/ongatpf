<?php

declare(strict_types=1);

class Domain
{
    public static function published(): array
    {
        return Database::fetchAll(
            'SELECT * FROM domains WHERE is_published = 1 ORDER BY sort_order ASC'
        );
    }

    public static function findBySlug(string $slug): ?array
    {
        return Database::fetch(
            'SELECT * FROM domains WHERE slug = ? AND is_published = 1 LIMIT 1',
            [$slug]
        );
    }
}
