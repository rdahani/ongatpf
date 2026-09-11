<section class="page-hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Fil d'Ariane">
      <a href="<?= base_path() ?>">Accueil</a><span>/</span><span>Contact</span>
    </nav>
    <p class="eyebrow">Échange</p>
    <h1 class="h1">Contactez ATPF</h1>
    <p class="lead">Siège à Niamey. Une équipe prête à répondre aux institutions, partenaires et acteurs locaux.</p>
  </div>
</section>

<section class="section">
  <div class="container contact-layout">
    <aside class="vmv-panel reveal">
      <p class="eyebrow">Coordonnées</p>
      <h2 class="h2" style="font-size:1.4rem">Nous trouver</h2>
      <div class="footer-links" style="gap:.85rem">
        <p style="margin:0"><strong>Adresse</strong><br><?= e(config('contact.address')) ?><br><?= e(config('contact.bp')) ?><br><?= e(config('contact.city')) ?></p>
        <p style="margin:0"><strong>Téléphone</strong><br>
          <a href="tel:<?= e(preg_replace('/\s+/', '', config('contact.phone'))) ?>"><?= e(config('contact.phone')) ?></a><br>
          <?php foreach (config('contact.mobile') as $m): ?>
            <a href="tel:<?= e(preg_replace('/\s+/', '', $m)) ?>"><?= e($m) ?></a><br>
          <?php endforeach; ?>
        </p>
        <p style="margin:0"><strong>Email</strong><br>
          <a href="mailto:<?= e(config('contact.email')) ?>"><?= e(config('contact.email')) ?></a>
        </p>
      </div>
    </aside>
    <div class="reveal">
      <?php if ($msg = flash('success')): ?><div class="alert alert-success"><?= e($msg) ?></div><?php endif; ?>
      <?php if ($msg = flash('error')): ?><div class="alert alert-error"><?= e($msg) ?></div><?php endif; ?>
      <form class="admin-form" method="post" action="<?= base_path('contact') ?>" novalidate>
        <?= Csrf::field() ?>
        <div class="form-grid two">
          <div>
            <label for="full_name">Nom complet *</label>
            <input id="full_name" name="full_name" required value="<?= old('name') ?>">
          </div>
          <div>
            <label for="organization">Organisation</label>
            <input id="organization" name="organization" value="<?= old('org') ?>">
          </div>
          <div>
            <label for="email">Email *</label>
            <input id="email" type="email" name="email" required value="<?= old('email') ?>">
          </div>
          <div>
            <label for="phone">Téléphone</label>
            <input id="phone" name="phone" value="<?= old('phone') ?>">
          </div>
          <div style="grid-column:1/-1">
            <label for="subject">Objet *</label>
            <input id="subject" name="subject" required value="<?= old('subject') ?>">
          </div>
          <div style="grid-column:1/-1">
            <label for="message">Message *</label>
            <textarea id="message" name="message" rows="6" required><?= old('message') ?></textarea>
          </div>
        </div>
        <button class="btn btn-primary" type="submit" style="margin-top:1rem">Envoyer le message</button>
      </form>
    </div>
  </div>
</section>
<style>
.contact-layout{display:grid;gap:2rem}
@media(min-width:900px){.contact-layout{grid-template-columns:.85fr 1.15fr;align-items:start}}
</style>
