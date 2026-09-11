<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e(($title ?? 'Admin') . ' | ATPF Admin') ?></title>
  <meta name="robots" content="noindex,nofollow">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@600;700&family=Fraunces:opsz,wght@9..144,600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= asset('assets/css/app.css') ?>">
  <script>document.documentElement.classList.add('js');</script>
</head>
<body class="admin-body">
  <div class="admin-shell">
    <aside class="admin-sidebar">
      <div class="logo" style="margin-bottom:1.5rem;padding:.5rem">
        <img class="logo-img" src="<?= atpf_img('logo.png') ?>" alt="ATPF" width="44" height="44">
        <span class="logo-text"><strong style="color:#E9D8A6">Admin</strong><span>Espace sécurisé</span></span>
      </div>
      <a href="<?= base_path('admin') ?>" class="<?= is_active('admin') && !is_active('admin/') ? 'is-active' : '' ?>">Tableau de bord</a>
      <a href="<?= base_path('admin/projets') ?>" class="<?= is_active('admin/projets') ? 'is-active' : '' ?>">Projets</a>
      <a href="<?= base_path('admin/actualites') ?>" class="<?= is_active('admin/actualites') ? 'is-active' : '' ?>">Actualités</a>
      <a href="<?= base_path('admin/partenaires') ?>" class="<?= is_active('admin/partenaires') ? 'is-active' : '' ?>">Partenaires</a>
      <a href="<?= base_path('admin/ressources') ?>" class="<?= is_active('admin/ressources') ? 'is-active' : '' ?>">Publications</a>
      <a href="<?= base_path('admin/chiffres') ?>" class="<?= is_active('admin/chiffres') ? 'is-active' : '' ?>">Chiffres clés</a>
      <a href="<?= base_path('admin/messages') ?>" class="<?= is_active('admin/messages') ? 'is-active' : '' ?>">Messages</a>
      <a href="<?= base_path() ?>" target="_blank" rel="noopener">Voir le site ↗</a>
      <a href="<?= base_path('admin/logout') ?>">Déconnexion</a>
    </aside>
    <div class="admin-main">
      <div class="admin-top">
        <h1 style="font-size:1.6rem;margin:0"><?= e($title ?? 'Admin') ?></h1>
        <div style="color:var(--muted);font-weight:600"><?= e(Auth::user()['name'] ?? '') ?></div>
      </div>
      <?php if ($msg = flash('success')): ?><div class="alert alert-success"><?= e($msg) ?></div><?php endif; ?>
      <?php if ($msg = flash('error')): ?><div class="alert alert-error"><?= e($msg) ?></div><?php endif; ?>
      <?= $content ?>
    </div>
  </div>
</body>
</html>
