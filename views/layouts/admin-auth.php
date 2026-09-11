<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($title ?? 'Connexion') ?></title>
  <meta name="robots" content="noindex,nofollow">
  <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@600&family=Fraunces:opsz,wght@9..144,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= asset('assets/css/app.css') ?>">
  <script>document.documentElement.classList.add('js');</script>
</head>
<body>
  <?= $content ?>
</body>
</html>
