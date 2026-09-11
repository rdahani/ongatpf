<section class="page-hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Fil d'Ariane">
      <a href="<?= base_path() ?>">Accueil</a><span>/</span><span>Impact</span>
    </nav>
    <p class="eyebrow">Résultats</p>
    <h1 class="h1">Notre impact sur le terrain</h1>
    <p class="lead">ATPF publie uniquement des indicateurs validés. Les données manquantes restent modifiables dans l’administration.</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="stats-grid stats-grid-premium">
      <?php foreach ($stats as $stat): ?>
        <article class="stat-card reveal">
          <div class="stat-value"><?= e($stat['value_display']) ?></div>
          <div class="stat-label"><?= e($stat['label']) ?></div>
          <?php if (!empty($stat['notes'])): ?>
            <p style="margin:.75rem 0 0;font-size:.85rem;color:var(--adk-muted)"><?= e($stat['notes']) ?></p>
          <?php endif; ?>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section section-map bg-green-pale">
  <div class="container map-wrap">
    <div class="reveal">
      <p class="eyebrow">Territoires</p>
      <h2 class="h2">Couverture territoriale</h2>
      <p class="lead map-lead">Sept régions d’intervention pour une envergure nationale.</p>
      <div class="map-image map-svg-wrap">
        <?php partial('niger-map'); ?>
      </div>
    </div>
    <div class="region-list reveal">
      <?php foreach ($regions as $region): ?>
        <article class="region-item">
          <div class="region-item-top">
            <h3 class="h3"><?= e($region['name']) ?></h3>
            <span class="region-count"><?= (int) $region['projects_count'] ?> projet<?= ((int) $region['projects_count']) > 1 ? 's' : '' ?></span>
          </div>
          <p class="region-domains"><?= e($region['description'] ?? '') ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
