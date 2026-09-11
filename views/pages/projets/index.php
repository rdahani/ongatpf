<section class="page-hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Fil d'Ariane">
      <a href="<?= base_path() ?>">Accueil</a><span>/</span><span>Projets</span>
    </nav>
    <p class="eyebrow">Portfolio</p>
    <h1 class="h1">Nos projets</h1>
    <p class="lead">Interventions concrètes pour restaurer les paysages, protéger la biodiversité et autonomiser les communautés.</p>
  </div>
</section>

<section class="section section-projects">
  <div class="container">
    <?php if (empty($projects)): ?>
      <div class="empty-state">Aucun projet publié pour le moment.</div>
    <?php else: ?>
      <?php
      $fallbacks = [atpf_img('photo-mung1.jpg'), atpf_img('mung3-scaled.jpg'), atpf_img('wa-184256.jpeg')];
      $featured = $projects[0];
      $rest = array_slice($projects, 1);
      $img0 = (!empty($featured['cover_image']) && is_file(ROOT_PATH.'/'.ltrim($featured['cover_image'],'/')))
        ? asset($featured['cover_image']) : $fallbacks[0];
      ?>
      <div class="project-spotlight reveal">
        <div class="project-spotlight-media">
          <img src="<?= e($img0) ?>" alt="<?= e($featured['title']) ?>" loading="lazy">
        </div>
        <div class="project-spotlight-body">
          <div class="meta-row">
            <?php if ($featured['zone']): ?><span class="chip"><?= e($featured['zone']) ?></span><?php endif; ?>
            <?php if ($featured['period_label']): ?><span class="chip chip-gold"><?= e($featured['period_label']) ?></span><?php endif; ?>
          </div>
          <h2 class="h2" style="font-size:clamp(1.4rem,2.4vw,1.9rem)"><?= e($featured['title']) ?></h2>
          <?php if ($featured['partner_name']): ?>
            <p class="project-meta-line">Partenaire / bailleur : <?= e($featured['partner_name']) ?></p>
          <?php endif; ?>
          <p class="prose" style="margin:0"><?= e(truncate($featured['summary'], 200)) ?></p>
          <a class="btn btn-dark" href="<?= base_path('projets/' . $featured['slug']) ?>">Voir le projet</a>
        </div>
      </div>

      <?php if ($rest): ?>
        <div class="grid-2 project-side-grid" style="margin-top:1.5rem">
          <?php foreach ($rest as $i => $project):
            $img = (!empty($project['cover_image']) && is_file(ROOT_PATH.'/'.ltrim($project['cover_image'],'/')))
              ? asset($project['cover_image']) : $fallbacks[($i + 1) % 3];
          ?>
            <article class="card reveal">
              <div class="card-media">
                <img src="<?= e($img) ?>" alt="<?= e($project['title']) ?>" loading="lazy">
              </div>
              <div class="card-body">
                <div class="meta-row">
                  <?php if ($project['zone']): ?><span class="chip"><?= e($project['zone']) ?></span><?php endif; ?>
                  <?php if ($project['period_label']): ?><span class="chip chip-gold"><?= e($project['period_label']) ?></span><?php endif; ?>
                </div>
                <h3 class="h3"><?= e($project['title']) ?></h3>
                <p><?= e(truncate($project['summary'], 140)) ?></p>
                <a class="link-arrow" href="<?= base_path('projets/' . $project['slug']) ?>">Voir le projet →</a>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</section>
