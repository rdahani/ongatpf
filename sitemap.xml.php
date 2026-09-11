<?php
/**
 * Sitemap dynamique
 */
require __DIR__ . '/app/bootstrap.php';

header('Content-Type: application/xml; charset=utf-8');

$base = rtrim((string) config('url'), '/');
$urls = [
    ['loc' => $base . '/', 'priority' => '1.0'],
    ['loc' => $base . '/a-propos', 'priority' => '0.8'],
    ['loc' => $base . '/domaines', 'priority' => '0.8'],
    ['loc' => $base . '/projets', 'priority' => '0.9'],
    ['loc' => $base . '/impact', 'priority' => '0.7'],
    ['loc' => $base . '/actualites', 'priority' => '0.8'],
    ['loc' => $base . '/ressources', 'priority' => '0.6'],
    ['loc' => $base . '/partenaires', 'priority' => '0.7'],
    ['loc' => $base . '/contact', 'priority' => '0.7'],
];

try {
    foreach (Project::published() as $p) {
        $urls[] = ['loc' => $base . '/projets/' . $p['slug'], 'priority' => '0.7', 'lastmod' => $p['updated_at'] ?? null];
    }
    foreach (News::published() as $n) {
        $urls[] = ['loc' => $base . '/actualites/' . $n['slug'], 'priority' => '0.6', 'lastmod' => $n['updated_at'] ?? null];
    }
} catch (Throwable $e) {
    // ignore
}

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($urls as $u): ?>
  <url>
    <loc><?= htmlspecialchars($u['loc']) ?></loc>
    <?php if (!empty($u['lastmod'])): ?><lastmod><?= date('Y-m-d', strtotime($u['lastmod'])) ?></lastmod><?php endif; ?>
    <priority><?= $u['priority'] ?></priority>
  </url>
<?php endforeach; ?>
</urlset>
