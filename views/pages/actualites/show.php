<?php
$img = (!empty($article['cover_image']) && is_file(ROOT_PATH.'/'.ltrim($article['cover_image'],'/')))
  ? asset($article['cover_image'])
  : atpf_img('news-2022.jpeg');
?>
<article>
  <section class="page-hero">
    <div class="container">
      <nav class="breadcrumb" aria-label="Fil d'Ariane">
        <a href="<?= base_path() ?>">Accueil</a><span>/</span>
        <a href="<?= base_path('actualites') ?>">Actualités</a><span>/</span>
        <span><?= e(truncate($article['title'], 40)) ?></span>
      </nav>
      <div class="meta-row" style="margin-bottom:1rem">
        <span class="chip"><?= e($article['category'] ?: 'Actualité') ?></span>
        <span class="chip chip-gold"><time datetime="<?= e($article['published_at']) ?>"><?= e(format_date($article['published_at'])) ?></time></span>
      </div>
      <h1 class="h1"><?= e($article['title']) ?></h1>
      <p class="lead"><?= e($article['excerpt']) ?></p>
    </div>
  </section>
  <section class="section">
    <div class="container" style="max-width:820px">
      <div class="story-visual" style="min-height:360px;margin-bottom:2rem;position:relative">
        <img src="<?= e($img) ?>" alt="<?= e($article['title']) ?>" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover">
      </div>
      <div class="prose"><?= $article['content'] ?></div>
      <p style="margin-top:2rem"><a class="btn btn-outline" href="<?= base_path('actualites') ?>">← Retour aux actualités</a></p>
    </div>
  </section>
</article>
