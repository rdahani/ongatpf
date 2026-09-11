<?php
/**
 * Configuration principale – ONG ATPF
 */
return [
    'name' => 'ATPF',
    'full_name' => 'Aménagement des Terroirs et Productions Forestières',
    'tagline' => 'Développement durable et restauration des territoires au Niger',
    'url' => getenv('APP_URL') ?: 'http://localhost/ongatpf',
    'base_path' => getenv('APP_BASE_PATH') ?: '/ongatpf',
    'env' => getenv('APP_ENV') ?: 'local',
    'debug' => (getenv('APP_DEBUG') ?: 'true') === 'true',
    'timezone' => 'Africa/Niamey',
    'locale' => 'fr_FR',
    'contact' => [
        'address' => 'Quartier Koira Kano Nord Extension (SONUCI), près du CSI Koira Kano Nord',
        'city' => 'Niamey, Niger',
        'bp' => 'BP 10 479',
        'phone' => '+227 20 37 22 71',
        'mobile' => ['+227 96 96 20 55', '+227 90 31 71 80'],
        'email' => 'atpf073@gmail.com',
        'email_alt' => 'atpf073@ongatpf.org',
    ],
    'social' => [
        'facebook' => '#',
        'linkedin' => 'https://linkedin.com/company/ong-atpf',
        'twitter' => '#',
        'youtube' => '#',
    ],
    'founded_year' => 2001,
    'recognition' => 'Arrêté N°174/MI/DGAPJ/DPL du 7/05/2004',
    'upload_max_mb' => 5,
    'session_name' => 'atpf_session',
    'csrf_token_key' => '_csrf_token',
    'rate_limit' => [
        'login_attempts' => 5,
        'login_window_minutes' => 15,
        'contact_attempts' => 3,
        'contact_window_minutes' => 10,
    ],
];
