<?php
/**
 * Chemins des médias officiels ATPF (issus de ongatpf.org)
 */
function atpf_img(string $file): string
{
    return asset('assets/images/atpf/' . ltrim($file, '/'));
}

function atpf_media(): array
{
    return [
        'logo' => atpf_img('logo.png'),
        'logo_sm' => atpf_img('logo-sm.png'),
        'hero' => atpf_img('hero.jpg'),
        'about' => atpf_img('mung3-scaled.jpg'),
        'field' => atpf_img('photo-field.jpg'),
        'approach' => [
            atpf_img('about-1.jpg'),
            atpf_img('about-2.jpg'),
            atpf_img('about-4.jpg'),
        ],
        'projects' => [
            atpf_img('photo-mung1.jpg'),
            atpf_img('mung3-scaled.jpg'),
            atpf_img('wa-184256.jpeg'),
        ],
        'news' => [
            atpf_img('news-2022.jpeg'),
            atpf_img('wa-184848.jpeg'),
            atpf_img('wa-184302.jpeg'),
            atpf_img('wa-184258.jpeg'),
        ],
        'cta' => atpf_img('about-3.jpg'),
        'icons' => [], // icônes SVG institutionnelles via icon_svg() — pas d'illustrations stock
    ];
}
