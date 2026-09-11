<footer class="site-footer">
  <div class="container footer-grid">
    <div>
      <div class="brand" style="margin-bottom:1rem">
        <img src="<?= atpf_img('logo.png') ?>" alt="Logo ONG ATPF" width="46" height="46">
        <span>ATPF</span>
      </div>
      <p style="max-width:22rem;margin:0 0 1rem">Aménagement des Terroirs et Productions Forestières — développement durable au Niger.</p>
      <p style="margin:0;font-size:.9rem;opacity:.8">ONG nigérienne créée en 2001 — Niamey.</p>
      <div class="socials" style="margin-top:1.25rem">
        <a href="<?= e(config('social.facebook')) ?>" aria-label="Facebook" rel="noopener">f</a>
        <a href="<?= e(config('social.linkedin')) ?>" target="_blank" rel="noopener" aria-label="LinkedIn">in</a>
        <a href="<?= e(config('social.youtube')) ?>" aria-label="YouTube" rel="noopener">▶</a>
      </div>
    </div>

    <div>
      <h3 class="h3" style="color:#fff;margin-bottom:1rem">Navigation</h3>
      <div class="footer-links">
        <a href="<?= base_path('a-propos') ?>">À propos</a>
        <a href="<?= base_path('domaines') ?>">Nos domaines</a>
        <a href="<?= base_path('projets') ?>">Nos projets</a>
        <a href="<?= base_path('actualites') ?>">Actualités</a>
        <a href="<?= base_path('ressources') ?>">Ressources</a>
        <a href="<?= base_path('contact') ?>">Contact</a>
      </div>
    </div>

    <div>
      <h3 class="h3" style="color:#fff;margin-bottom:1rem">Contact</h3>
      <div class="footer-links">
        <span><?= e(config('contact.city')) ?></span>
        <a href="tel:<?= e(preg_replace('/\s+/', '', config('contact.phone'))) ?>"><?= e(config('contact.phone')) ?></a>
        <?php foreach (config('contact.mobile') as $m): ?>
          <a href="tel:<?= e(preg_replace('/\s+/', '', $m)) ?>"><?= e($m) ?></a>
        <?php endforeach; ?>
        <a href="mailto:<?= e(config('contact.email')) ?>"><?= e(config('contact.email')) ?></a>
      </div>
    </div>

    <div>
      <h3 class="h3" style="color:#fff;margin-bottom:1rem">Partenariat</h3>
      <p style="margin:0 0 1rem;font-size:.92rem">Institutions, bailleurs et acteurs locaux : construisons ensemble.</p>
      <a class="btn btn-primary" href="<?= base_path('partenaires') ?>#devenir-partenaire">Devenir partenaire</a>
    </div>
  </div>

  <div class="container footer-bottom">
    <div>© <?= date('Y') ?> ONG ATPF. Tous droits réservés.</div>
    <div style="display:flex;gap:1rem;flex-wrap:wrap">
      <a href="<?= base_path('ressources') ?>">Ressources</a>
      <a href="<?= base_path('admin') ?>">Administration</a>
    </div>
  </div>
</footer>
