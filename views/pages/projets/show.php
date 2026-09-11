<?php
$img = (!empty($project['cover_image']) && is_file(ROOT_PATH.'/'.ltrim($project['cover_image'],'/')))
  ? asset($project['cover_image'])
  : atpf_img('mung3-scaled.jpg');
?>
<section class="page-hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Fil d'Ariane">
      <a href="<?= base_path() ?>">Accueil</a><span>/</span>
      <a href="<?= base_path('projets') ?>">Projets</a><span>/</span>
      <span><?= e(truncate($project['title'], 40)) ?></span>
    </nav>
    <div class="meta-row" style="margin-bottom:1rem">
      <?php if ($project['status'] === 'active'): ?><span class="chip chip-gold">En cours</span><?php endif; ?>
      <?php if ($project['status'] === 'completed'): ?><span class="chip">Réalisé</span><?php endif; ?>
      <?php if ($project['period_label']): ?><span class="chip"><?= e($project['period_label']) ?></span><?php endif; ?>
    </div>
    <h1 class="h1"><?= e($project['title']) ?></h1>
    <p class="lead"><?= e($project['summary']) ?></p>
  </div>
</section>

<section class="section">
  <div class="container" style="display:grid;grid-template-columns:1.35fr .75fr;gap:2rem">
    <div>
      <div class="story-visual" style="min-height:360px;margin-bottom:2rem;position:relative">
        <img src="<?= e($img) ?>" alt="<?= e($project['title']) ?>" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover">
      </div>
      <div class="prose"><?= $project['content'] ?></div>
    </div>
    <aside>
      <div class="region-panel sticky-aside">
        <h2 class="h3">Fiche projet</h2>
        <?php if ($project['zone']): ?><p><strong>Zone</strong><br><?= e($project['zone']) ?></p><?php endif; ?>
        <?php if ($project['partner_name']): ?><p><strong>Partenaire</strong><br><?= e($project['partner_name']) ?></p><?php endif; ?>
        <?php if ($project['period_label']): ?><p><strong>Période</strong><br><?= e($project['period_label']) ?></p><?php endif; ?>
        <?php if (!empty($regions)): ?>
          <p><strong>Régions</strong><br><?= e(implode(', ', array_column($regions, 'name'))) ?></p>
        <?php endif; ?>
        <?php if (!empty($domains)): ?>
          <div style="display:flex;flex-wrap:wrap;gap:.4rem;margin-top:.5rem">
            <?php foreach ($domains as $d): ?><span class="chip"><?= e($d['title']) ?></span><?php endforeach; ?>
          </div>
        <?php endif; ?>
        <a class="btn btn-primary" style="margin-top:1rem" href="<?= base_path('contact') ?>">Échanger sur ce projet</a>
      </div>
    </aside>
  </div>
</section>

<style>@media (max-width:900px){.section .container[style*="grid-template-columns:1.35fr"]{grid-template-columns:1fr!important}}</style>
