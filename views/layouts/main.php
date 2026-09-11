<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($title ?? 'ATPF Niger') ?></title>
  <meta name="description" content="<?= e($metaDescription ?? config('tagline')) ?>">
  <link rel="canonical" href="<?= e($canonical ?? url()) ?>">
  <meta property="og:type" content="<?= e($schemaType ?? 'website') === 'Article' ? 'article' : 'website' ?>">
  <meta property="og:title" content="<?= e($ogTitle ?? $title ?? 'ATPF') ?>">
  <meta property="og:description" content="<?= e($ogDescription ?? $metaDescription ?? config('tagline')) ?>">
  <meta property="og:url" content="<?= e($canonical ?? url()) ?>">
  <meta property="og:image" content="<?= e($ogImage ?? asset('assets/images/atpf/hero.jpg')) ?>">
  <meta property="og:locale" content="fr_FR">
  <meta property="og:site_name" content="ATPF">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= e($ogTitle ?? $title ?? 'ATPF') ?>">
  <meta name="twitter:description" content="<?= e($ogDescription ?? $metaDescription ?? config('tagline')) ?>">
  <meta name="twitter:image" content="<?= e($ogImage ?? asset('assets/images/atpf/hero.jpg')) ?>">
  <link rel="icon" href="<?= asset('assets/images/atpf/logo-sm.png') ?>" type="image/png">
  <link rel="apple-touch-icon" href="<?= asset('assets/images/atpf/logo.png') ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= asset('assets/css/app.css') ?>">
  <script>document.documentElement.classList.add('js');</script>
  <noscript><style>.reveal{opacity:1!important;transform:none!important}</style></noscript>
  <script type="application/ld+json">
  <?= json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'NGO',
    'name' => config('full_name'),
    'alternateName' => 'ATPF',
    'url' => config('url'),
    'logo' => asset('assets/images/atpf/logo.png'),
    'foundingDate' => (string) config('founded_year'),
    'address' => [
      '@type' => 'PostalAddress',
      'addressLocality' => 'Niamey',
      'addressCountry' => 'NE',
      'streetAddress' => config('contact.address'),
    ],
    'email' => config('contact.email'),
    'telephone' => config('contact.phone'),
    'areaServed' => 'Niger',
    'description' => config('tagline'),
  ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
  </script>
  <?php if (($schemaType ?? '') === 'Article' && !empty($schemaData)): ?>
  <script type="application/ld+json">
  <?= json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Article',
    'headline' => $schemaData['headline'] ?? '',
    'datePublished' => $schemaData['datePublished'] ?? '',
    'author' => ['@type' => 'Organization', 'name' => $schemaData['author'] ?? 'ATPF'],
    'publisher' => ['@type' => 'Organization', 'name' => 'ATPF'],
  ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>
  </script>
  <?php endif; ?>
</head>
<body data-base="<?= e(rtrim((string) config('base_path'), '/')) ?>">
  <a class="sr-only" href="#main">Aller au contenu</a>
  <?php partial('header'); ?>
  <main id="main">
    <?= $content ?>
  </main>
  <?php partial('footer'); ?>
  <script src="<?= asset('assets/js/app.js') ?>" defer></script>
</body>
</html>
