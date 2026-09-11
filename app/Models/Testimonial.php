<?php

declare(strict_types=1);

class Testimonial
{
    public static function published(): array
    {
        return Database::fetchAll(
            'SELECT * FROM testimonials WHERE is_published = 1 ORDER BY sort_order ASC'
        );
    }
}
