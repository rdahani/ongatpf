<section class="page-hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Fil d'Ariane">
      <a href="<?= base_path() ?>">Accueil</a><span>/</span><span>Ressources</span>
    </nav>
    <p class="eyebrow">Documentation</p>
    <h1 class="h1">Ressources & publications</h1>
    <p class="lead">Rapports, brochures et documents institutionnels publiés depuis l’administration.</p>
  </div>
</section>

<section class="section section-transparency">
  <div class="container">
    <?php if (empty($resources)): ?>
      <div class="empty-state">
        Aucune publication n’est encore disponible en ligne.<br>
        ATPF pourra ajouter rapports et documents via le tableau de bord.
      </div>
    <?php else: ?>
      <div class="transparency-list" style="max-width:720px">
        <?php foreach ($resources as $i => $resource): ?>
          <a class="transparency-item" href="<?= e($resource['external_url'] ?: ($resource['file_path'] ? asset($resource['file_path']) : '#')) ?>" <?= ($resource['file_path'] || $resource['external_url']) ? 'target="_blank" rel="noopener"' : '' ?>>
            <span class="transparency-num"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
            <span>
              <strong><?= e($resource['title']) ?></strong>
              <small><?= e(ucfirst($resource['resource_type'])) ?><?= $resource['year'] ? ' · ' . (int) $resource['year'] : '' ?><?= $resource['description'] ? ' — ' . e(truncate($resource['description'], 80)) : '' ?></small>
            </span>
            <span class="transparency-arrow" aria-hidden="true">→</span>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
