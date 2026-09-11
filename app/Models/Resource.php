<?php

declare(strict_types=1);

class Resource
{
    public static function published(): array
    {
        return Database::fetchAll(
            'SELECT * FROM resources WHERE is_published = 1 ORDER BY published_at DESC, created_at DESC'
        );
    }

    public static function allAdmin(): array
    {
        return Database::fetchAll('SELECT * FROM resources ORDER BY created_at DESC');
    }
}
