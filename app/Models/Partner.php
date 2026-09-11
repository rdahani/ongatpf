<?php

declare(strict_types=1);

class Partner
{
    public static function published(): array
    {
        return Database::fetchAll(
            'SELECT * FROM partners WHERE is_published = 1 ORDER BY sort_order ASC, name ASC'
        );
    }

    public static function allAdmin(): array
    {
        return Database::fetchAll('SELECT * FROM partners ORDER BY sort_order ASC');
    }
}
