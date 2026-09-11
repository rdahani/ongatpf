<?php
/**
 * Installateur ATPF – crée la BDD, importe schéma + seed, génère le mot de passe admin
 * Accès : http://localhost/ongatpf/install.php
 * À supprimer ou protéger après installation.
 */
declare(strict_types=1);

$app = require __DIR__ . '/config/app.php';
$db = require __DIR__ . '/config/database.php';

$message = null;
$error = null;
$done = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $adminEmail = trim($_POST['email'] ?? 'admin@ongatpf.org');
        $adminPass = $_POST['password'] ?? '';
        if (strlen($adminPass) < 10) {
            throw new RuntimeException('Mot de passe admin : 10 caractères minimum.');
        }

        // Connexion à la base déjà créée (hébergeur / XAMPP)
        $pdo = new PDO(
            sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
                $db['host'],
                $db['port'],
                $db['database']
            ),
            $db['username'],
            $db['password'],
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );

        $stripDbDirectives = static function (string $sql): string {
            $sql = preg_replace('/CREATE\s+DATABASE\s+.*?;/is', '', $sql) ?? $sql;
            $sql = preg_replace('/USE\s+[`\w]+\s*;/i', '', $sql) ?? $sql;
            return trim($sql);
        };

        $schema = $stripDbDirectives((string) file_get_contents(__DIR__ . '/database/schema.sql'));
        $seed = $stripDbDirectives((string) file_get_contents(__DIR__ . '/database/seed.sql'));
        $pdo->exec($schema);
        $pdo->exec($seed);

        $hash = password_hash($adminPass, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('UPDATE admin_users SET email = ?, password_hash = ?, name = ? WHERE id = 1');
        $stmt->execute([$adminEmail, $hash, 'Administrateur ATPF']);

        $done = true;
        $message = 'Installation réussie. Connectez-vous à /admin/login puis supprimez install.php.';
    } catch (Throwable $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Installation ATPF</title>
  <link rel="stylesheet" href="assets/css/app.css">
</head>
<body>
<div class="login-wrap">
  <div class="login-card" style="width:min(100% - 2rem, 520px)">
    <h1 style="font-size:1.5rem">Installation du site ATPF</h1>
    <p style="color:var(--muted)">Cette procédure crée la base <strong><?= htmlspecialchars($db['database']) ?></strong> et charge les données initiales.</p>
    <?php if ($message): ?><div class="alert alert-success"><?= htmlspecialchars($message) ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <?php if ($done): ?>
      <a class="btn btn-primary" href="admin/login">Aller à l’administration</a>
      <a class="btn btn-outline" href="./">Voir le site</a>
    <?php else: ?>
      <form method="post">
        <div class="form-group" style="margin-bottom:1rem">
          <label>Email administrateur</label>
          <input type="email" name="email" value="admin@ongatpf.org" required>
        </div>
        <div class="form-group" style="margin-bottom:1rem">
          <label>Mot de passe (min. 10 caractères)</label>
          <input type="password" name="password" required minlength="10">
        </div>
        <button class="btn btn-primary" type="submit">Installer</button>
      </form>
    <?php endif; ?>
  </div>
</div>
</body>
</html>
