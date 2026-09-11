<section class="page-hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Fil d'Ariane">
      <a href="<?= base_path() ?>">Accueil</a><span>/</span><span>Actualités</span>
    </nav>
    <p class="eyebrow">Journal</p>
    <h1 class="h1">Actualités</h1>
    <p class="lead">Initiatives, partenariats et récits de terrain.</p>
  </div>
</section>

<section class="section section-news">
  <div class="container">
    <div class="grid-3" style="display:grid;gap:1.25rem;grid-template-columns:repeat(auto-fit,minmax(260px,1fr))">
      <?php
      $fallbacks = [atpf_img('news-2022.jpeg'), atpf_img('wa-184848.jpeg'), atpf_img('wa-184302.jpeg'), atpf_img('wa-184258.jpeg')];
      foreach ($articles as $i => $article):
        $img = (!empty($article['cover_image']) && is_file(ROOT_PATH.'/'.ltrim($article['cover_image'],'/')))
          ? asset($article['cover_image']) : $fallbacks[$i % 4];
      ?>
        <article class="card reveal">
          <div class="card-media">
            <img src="<?= e($img) ?>" alt="<?= e($article['title']) ?>" loading="lazy">
          </div>
          <div class="card-body">
            <div class="meta-row">
              <span class="chip"><?= e($article['category'] ?: 'Actualité') ?></span>
              <span class="chip chip-gold"><time datetime="<?= e($article['published_at']) ?>"><?= e(format_date($article['published_at'])) ?></time></span>
            </div>
            <h2 class="h3"><?= e($article['title']) ?></h2>
            <p><?= e(truncate($article['excerpt'], 130)) ?></p>
            <a class="link-arrow" href="<?= base_path('actualites/' . $article['slug']) ?>">Lire l’article →</a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
