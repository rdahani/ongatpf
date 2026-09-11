<?php
/**
 * Icônes institutionnelles – traits fins, sobres (pas d'illustrations stock)
 */
function icon_svg(string $name, int $size = 28): string
{
    $s = (int) $size;
    $common = 'width="'.$s.'" height="'.$s.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"';

    $paths = [
        'leaf' => '<path d="M4 20c6-1 11-6 13-13 0 0-7 1-11 7-1 2-2 4-2 6Z"/><path d="M7 14c2-1 5-4 7-7"/>',
        'cloud' => '<path d="M6.5 18h10a3.5 3.5 0 0 0 .4-7 5.5 5.5 0 0 0-10.6 1.4A3 3 0 0 0 6.5 18Z"/><path d="M8 10.5V9"/><path d="M12 9.5V7"/><path d="M16 11v-1.5"/>',
        'wheat' => '<path d="M12 21V9"/><path d="M12 13c-2.2-1.8-4.5-2-4.5-2s.4 2.5 2.2 4"/><path d="M12 13c2.2-1.8 4.5-2 4.5-2s-.4 2.5-2.2 4"/><path d="M12 9c-2-1.8-3.8-2.8-3.8-2.8S9 8.2 11 9.5"/><path d="M12 9c2-1.8 3.8-2.8 3.8-2.8S15 8.2 13 9.5"/>',
        'coins' => '<ellipse cx="12" cy="6.5" rx="6.5" ry="2.5"/><path d="M5.5 6.5v4c0 1.4 2.9 2.5 6.5 2.5s6.5-1.1 6.5-2.5v-4"/><path d="M5.5 10.5v4c0 1.4 2.9 2.5 6.5 2.5s6.5-1.1 6.5-2.5v-4"/>',
        'droplet' => '<path d="M12 3.5S17.5 10 17.5 14a5.5 5.5 0 1 1-11 0C6.5 10 12 3.5 12 3.5Z"/>',
        'book' => '<path d="M5 5.2A2.2 2.2 0 0 1 7.2 3H19v15.5H7.2A2.2 2.2 0 0 0 5 20.7V5.2Z"/><path d="M5 18.2A2.2 2.2 0 0 1 7.2 16H19"/>',
        'users' => '<circle cx="9" cy="8" r="2.8"/><path d="M3.5 18.5c0-2.8 2.4-4.8 5.5-4.8s5.5 2 5.5 4.8"/><circle cx="16.5" cy="8.2" r="2.2"/><path d="M14.2 13.7c1.7-.4 3.8.4 4.8 2.3"/>',
        'sparkles' => '<path d="M5 12h4l2-7 2 7h4l-3.2 4 1.2 6L11 18l-3.8 4 1.2-6z"/>',
        'map' => '<path d="M3.5 6.5 9 4.5l6 2 5.5-2v13l-5.5 2-6-2-5.5 2Z"/><path d="M9 4.5v13"/><path d="M15 6.5v13"/>',
        'arrow' => '<path d="M5 12h14"/><path d="M13 6l6 6-6 6"/>',
    ];

    $body = $paths[$name] ?? $paths['leaf'];
    return '<svg '.$common.'>'.$body.'</svg>';
}

function domain_icon_key(string $slug): string
{
    $map = [
        'environnement' => 'leaf',
        'changements-climatiques' => 'cloud',
        'securite-alimentaire' => 'wheat',
        'activites-generatrices-de-revenus' => 'coins',
        'hydraulique-villageoise' => 'droplet',
        'education-formation' => 'book',
        'developpement-communautaire' => 'users',
        'autonomisation-femmes' => 'sparkles',
    ];
    return $map[$slug] ?? 'leaf';
}
