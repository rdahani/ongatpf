<?php require VIEW_PATH . '/partials/icons.php'; ?>
<section class="page-hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Fil d'Ariane">
      <a href="<?= base_path() ?>">Accueil</a><span>/</span><span>Domaines</span>
    </nav>
    <p class="eyebrow">Expertise</p>
    <h1 class="h1">Nos domaines d’intervention</h1>
    <p class="lead">Une offre intégrée pour restaurer les territoires, renforcer les communautés et bâtir la résilience au Niger.</p>
  </div>
</section>

<section class="section section-domains">
  <div class="container">
    <div class="domain-featured-grid" style="grid-template-columns:1fr">
      <?php
      $imgs = array_merge(atpf_media()['projects'], atpf_media()['approach']);
      foreach ($domains as $i => $domain):
      ?>
        <article class="domain-card reveal" id="<?= e($domain['slug']) ?>" style="display:grid;grid-template-columns:minmax(0,.9fr) minmax(0,1.1fr);min-height:auto">
          <img src="<?= e($imgs[$i % count($imgs)]) ?>" alt="<?= e($domain['title']) ?>" loading="lazy" style="min-height:220px;height:100%">
          <div class="domain-body" style="padding:1.75rem">
            <div class="domain-icon"><?= icon_svg(domain_icon_key($domain['slug']), 20) ?></div>
            <p class="eyebrow" style="margin-bottom:.5rem"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></p>
            <h2 class="h2" style="font-size:clamp(1.35rem,2vw,1.75rem)"><?= e($domain['title']) ?></h2>
            <p><?= e($domain['short_description']) ?></p>
            <?php if (!empty($domain['full_description'])): ?>
              <p class="prose" style="margin-top:.75rem"><?= e($domain['full_description']) ?></p>
            <?php endif; ?>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<style>
@media (max-width:800px){
  .domain-featured-grid .domain-card{grid-template-columns:1fr!important}
}
</style>
