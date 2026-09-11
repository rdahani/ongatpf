<div class="login-wrap">
  <div class="login-card">
    <div class="logo" style="margin-bottom:1.25rem">
      <img class="logo-img" src="<?= atpf_img('logo.png') ?>" alt="ATPF" width="52" height="52">
      <span class="logo-text"><strong>Administration</strong><span>Accès sécurisé</span></span>
    </div>
    <?php if ($msg = flash('success')): ?><div class="alert alert-success"><?= e($msg) ?></div><?php endif; ?>
    <?php if ($msg = flash('error')): ?><div class="alert alert-error"><?= e($msg) ?></div><?php endif; ?>
    <form method="post" action="<?= base_path('admin/login') ?>">
      <?= Csrf::field() ?>
      <div class="form-group" style="margin-bottom:1rem">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" required autocomplete="username">
      </div>
      <div class="form-group" style="margin-bottom:1.25rem">
        <label for="password">Mot de passe</label>
        <input id="password" type="password" name="password" required autocomplete="current-password">
      </div>
      <button class="btn btn-primary" type="submit" style="width:100%">Se connecter</button>
    </form>
  </div>
</div>
