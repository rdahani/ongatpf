<?php

declare(strict_types=1);

abstract class Controller
{
    protected function seo(string $title, string $description = '', array $extra = []): array
    {
        $site = config('full_name');
        return array_merge([
            'title' => $title,
            'metaDescription' => $description ?: config('tagline'),
            'ogTitle' => $title,
            'ogDescription' => $description ?: config('tagline'),
            'ogImage' => asset('assets/images/atpf/hero.jpg'),
            'canonical' => url(ltrim($_SERVER['REQUEST_URI'] ?? '', '/')),
        ], $extra);
    }
}
