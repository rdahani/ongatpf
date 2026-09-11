<header class="site-header is-transparent" data-header data-solid="<?= is_active('') ? 'false' : 'true' ?>">
  <div class="container header-inner">
    <a class="brand" href="<?= base_path() ?>" aria-label="ONG ATPF — Accueil">
      <img src="<?= atpf_img('logo.png') ?>" alt="Logo ONG ATPF" width="46" height="46">
      <span>ATPF</span>
    </a>

    <nav class="nav-desktop" aria-label="Navigation principale">
      <a class="<?= is_active('') ? 'is-active' : '' ?>" href="<?= base_path() ?>">Accueil</a>
      <a class="<?= is_active('a-propos') ? 'is-active' : '' ?>" href="<?= base_path('a-propos') ?>">À propos</a>
      <a class="<?= is_active('domaines') ? 'is-active' : '' ?>" href="<?= base_path('domaines') ?>">Nos domaines</a>
      <a class="<?= is_active('projets') ? 'is-active' : '' ?>" href="<?= base_path('projets') ?>">Nos projets</a>
      <a class="<?= is_active('impact') ? 'is-active' : '' ?>" href="<?= base_path('impact') ?>">Notre impact</a>
      <a class="<?= is_active('actualites') ? 'is-active' : '' ?>" href="<?= base_path('actualites') ?>">Actualités</a>
      <a class="<?= is_active('ressources') ? 'is-active' : '' ?>" href="<?= base_path('ressources') ?>">Ressources</a>
      <a class="<?= is_active('contact') ? 'is-active' : '' ?>" href="<?= base_path('contact') ?>">Contact</a>
    </nav>

    <div class="header-actions">
      <a class="btn btn-primary btn-sm" href="<?= base_path('partenaires') ?>#devenir-partenaire">Devenir partenaire</a>
      <button class="menu-toggle" type="button" data-menu-toggle aria-expanded="false" aria-controls="menu-mobile" aria-label="Ouvrir le menu">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
      </button>
    </div>
  </div>
</header>

<nav id="menu-mobile" class="nav-mobile" data-mobile-nav aria-label="Menu mobile">
  <a href="<?= base_path() ?>">Accueil</a>
  <a href="<?= base_path('a-propos') ?>">À propos</a>
  <a href="<?= base_path('domaines') ?>">Nos domaines</a>
  <a href="<?= base_path('projets') ?>">Nos projets</a>
  <a href="<?= base_path('impact') ?>">Notre impact</a>
  <a href="<?= base_path('actualites') ?>">Actualités</a>
  <a href="<?= base_path('ressources') ?>">Ressources</a>
  <a href="<?= base_path('contact') ?>">Contact</a>
  <a href="<?= base_path('partenaires') ?>#devenir-partenaire" style="color:var(--adk-green)">Devenir partenaire</a>
</nav>
