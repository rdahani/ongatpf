<?php

declare(strict_types=1);

class ImpactStat
{
    public static function published(): array
    {
        return Database::fetchAll(
            'SELECT * FROM impact_stats WHERE is_published = 1 ORDER BY sort_order ASC'
        );
    }

    public static function all(): array
    {
        return Database::fetchAll('SELECT * FROM impact_stats ORDER BY sort_order ASC');
    }

    public static function forHome(): array
    {
        $keys = ['experience_years', 'regions_count', 'projects_done', 'communities_supported'];
        $placeholders = implode(',', array_fill(0, count($keys), '?'));
        return Database::fetchAll(
            "SELECT * FROM impact_stats WHERE stat_key IN ($placeholders) AND is_published = 1 ORDER BY sort_order ASC",
            $keys
        );
    }
}
