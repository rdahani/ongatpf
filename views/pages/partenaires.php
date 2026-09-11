<section class="page-hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Fil d'Ariane">
      <a href="<?= base_path() ?>">Accueil</a><span>/</span><span>Partenaires</span>
    </nav>
    <p class="eyebrow">Alliances</p>
    <h1 class="h1">Nos partenaires</h1>
    <p class="lead">ATPF collabore avec des bailleurs, institutions et partenaires techniques pour maximiser l’impact au Niger.</p>
  </div>
</section>

<section class="section section-partners">
  <div class="container">
    <div class="partners-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:1rem">
      <?php foreach ($partners as $partner): ?>
        <a class="partner-logo" style="min-height:130px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:.5rem;background:#fff;border:1px solid rgba(12,74,54,.1);border-radius:1rem;padding:1.25rem;text-align:center"
           href="<?= e($partner['website'] ?: '#') ?>"
           <?= $partner['website'] ? 'target="_blank" rel="noopener"' : '' ?>>
          <?php if (!empty($partner['logo'])): ?>
            <img src="<?= asset(ltrim($partner['logo'], '/')) ?>" alt="<?= e($partner['name']) ?>" loading="lazy" style="max-height:48px;width:auto">
          <?php endif; ?>
          <strong><?= e($partner['name']) ?></strong>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section bg-green-pale" id="devenir-partenaire">
  <div class="container" style="max-width:760px">
    <p class="eyebrow">Collaborer</p>
    <h2 class="h2">Devenir partenaire</h2>
    <p class="lead">Bailleur, agence des Nations Unies, ONG internationale, institution publique ou acteur privé : construisons ensemble des programmes durables.</p>
    <ul style="list-style:disc;padding-left:1.2rem;color:var(--adk-muted);margin:1.5rem 0">
      <li>Approche participative depuis 2001</li>
      <li>Couverture nationale (7 régions)</li>
      <li>Expertise environnement, climat, communautés et genre</li>
      <li>Gouvernance orientée résultats</li>
    </ul>
    <div class="hero-actions">
      <a class="btn btn-primary" href="<?= base_path('contact') ?>">Nous écrire</a>
      <a class="btn btn-outline" href="<?= base_path('a-propos') ?>">Découvrir ATPF</a>
    </div>
  </div>
</section>
