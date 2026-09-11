<?php
require VIEW_PATH . '/partials/icons.php';
$m = atpf_media();

function project_image_local(array $project, array $fallbacks, int $i): string {
  if (!empty($project['cover_image'])) {
    $path = ltrim($project['cover_image'], '/');
    if (is_file(ROOT_PATH . '/' . $path)) {
      return asset($path);
    }
  }
  return $fallbacks[$i % count($fallbacks)];
}

function news_image_local(array $article, array $fallbacks, int $i): string {
  if (!empty($article['cover_image'])) {
    $path = ltrim($article['cover_image'], '/');
    if (is_file(ROOT_PATH . '/' . $path)) {
      return asset($path);
    }
  }
  return $fallbacks[$i % count($fallbacks)];
}

$featured = $projects[0] ?? null;
$otherProjects = array_slice($projects, 1);
$featuredDomains = array_slice($domains, 0, 4);
$pillDomains = array_slice($domains, 4);
$mosaicDomains = array_slice($domains, 0, 4);
$mosaicTags = ['Environnement', 'Climat', 'Résilience', 'Communautés'];
$domainImages = array_merge($m['projects'], $m['approach'], $m['news']);
$featuredNews = $news[0] ?? null;
$sideNews = array_slice($news, 1, 2);
?>

<section class="hero" aria-label="Introduction">
  <div class="hero-media" data-hero-media style="background-image:url('<?= e($m['hero']) ?>')" role="img" aria-label="Actions ATPF sur le terrain au Niger"></div>
  <div class="hero-overlay" aria-hidden="true"></div>
  <div class="hero-grain" aria-hidden="true"></div>
  <div class="hero-content">
    <p class="hero-brand reveal">ATPF</p>
    <p class="eyebrow hero-eyebrow" style="color:var(--adk-gold-soft)">ONG nigérienne d’aménagement des terroirs et productions forestières</p>
    <h1 class="h1 hero-title">Construire aujourd’hui un avenir plus résilient pour les communautés.</h1>
    <p class="lead hero-lead">Depuis 2001, ATPF accompagne les communautés nigériennes dans la préservation de l’environnement, la restauration des territoires et l’amélioration durable des conditions de vie.</p>
    <div class="hero-actions">
      <a class="btn btn-primary" href="<?= base_path('projets') ?>">Découvrir notre action</a>
      <a class="btn btn-secondary" href="<?= base_path('partenaires') ?>#devenir-partenaire">Devenir partenaire</a>
    </div>
    <p class="hero-meta">Depuis 2001 · +20 ans d’engagement au Niger · Siège à Niamey</p>
  </div>
  <a class="hero-scroll" href="#impact" aria-label="Défiler vers l’impact">
    <span>Découvrir</span>
    <span class="hero-scroll-line" aria-hidden="true"></span>
  </a>
</section>

<section class="stats-band" id="impact">
  <div class="container">
    <div class="stats-band-inner">
      <div class="stats-band-intro reveal">
        <p class="eyebrow" style="color:var(--adk-gold)">Notre impact</p>
        <h2 class="h2" style="color:#fff;margin:0">Des résultats ancrés dans les communautés</h2>
      </div>
      <div class="stats-grid stats-grid-premium">
        <?php foreach ($stats as $stat): ?>
          <?php
            $num = $stat['numeric_value'];
            $display = $stat['value_display'] ?: '—';
            $prefix = $stat['prefix'] ?? '';
            $suffix = $stat['suffix'] ?? '';
            if ($num === null && preg_match('/([\d\s]+)/', $display, $mm)) {
              $num = (int) preg_replace('/\s+/', '', $mm[1]);
            }
            if (str_starts_with(trim($display), '+') && $prefix === '') {
              $prefix = '+';
            }
          ?>
          <article class="stat-card stat-card-dark reveal">
            <div class="stat-value"
                 data-counter="<?= $num !== null ? (int) $num : 0 ?>"
                 data-prefix="<?= e($prefix) ?>"
                 data-suffix="<?= e($suffix) ?>"
                 data-display="<?= e($display) ?>">
              <?= e($display) ?>
            </div>
            <div class="stat-label"><?= e($stat['label']) ?></div>
          </article>
        <?php endforeach; ?>
      </div>
      <p class="stats-note reveal">Indicateurs validés uniquement — les données non confirmées restent affichées en tiret.</p>
    </div>
  </div>
</section>

<section class="section about-section" id="qui-sommes-nous">
  <div class="container about-layout">
    <div class="about-media reveal">
      <div class="media-frame about-photo">
        <img src="<?= e($m['about']) ?>" alt="Communautés accompagnées par ATPF" loading="lazy">
      </div>
      <div class="about-float">
        <strong>ATPF</strong>
        <span>Aménagement des Terroirs et Productions Forestières</span>
      </div>
    </div>
    <div class="reveal">
      <p class="eyebrow">Qui sommes-nous ?</p>
      <h2 class="h2">Une ONG nigérienne enracinée dans les communautés</h2>
      <div class="prose">
        <p><?= e(setting('about_teaser', 'Depuis plus de deux décennies, ATPF agit aux côtés des communautés pour préserver l’environnement, restaurer les territoires sahéliens et ouvrir des perspectives durables face à la pauvreté et au climat.')) ?></p>
      </div>
      <a class="link-arrow" href="<?= base_path('a-propos') ?>">En savoir plus sur ATPF →</a>
      <div class="mini-metrics">
        <div class="mini-metric"><strong>2001</strong><span>Année de création</span></div>
        <div class="mini-metric"><strong>Niger</strong><span>Pays d’intervention</span></div>
        <div class="mini-metric"><strong>7 régions</strong><span>Couverture nationale</span></div>
      </div>
    </div>
  </div>
</section>

<section class="section section-domains">
  <div class="container">
    <div class="section-head split-head reveal">
      <div class="split-head__copy">
        <p class="eyebrow">Domaines</p>
        <h2 class="h2">Nos domaines d’intervention</h2>
        <p class="lead">Des compétences multisectorielles au service de la résilience des communautés rurales.</p>
      </div>
      <div class="split-head__action">
        <a class="btn btn-outline" href="<?= base_path('domaines') ?>">Tous les domaines</a>
      </div>
    </div>
    <div class="domain-featured-grid">
      <?php foreach ($featuredDomains as $i => $domain): ?>
        <article class="domain-card <?= $i === 0 ? 'domain-card-lg' : '' ?> reveal">
          <img src="<?= e($domainImages[$i % count($domainImages)]) ?>" alt="<?= e($domain['title']) ?>" loading="lazy">
          <div class="domain-body">
            <div class="domain-icon"><?= icon_svg(domain_icon_key($domain['slug']), 20) ?></div>
            <h3 class="h3"><?= e($domain['title']) ?></h3>
            <p><?= e($domain['short_description']) ?></p>
            <a class="btn btn-primary btn-sm" href="<?= base_path('domaines') ?>#<?= e($domain['slug']) ?>">Découvrir</a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
    <?php if ($pillDomains): ?>
      <div class="domain-pills reveal">
        <?php foreach ($pillDomains as $domain): ?>
          <a class="domain-pill" href="<?= base_path('domaines') ?>#<?= e($domain['slug']) ?>"><?= e($domain['title']) ?></a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<section class="section mosaic-section" id="sur-le-terrain">
  <div class="container">
    <div class="mosaic-intro reveal">
      <div>
        <p class="eyebrow">Sur le terrain</p>
        <h2 class="h2">Des actions concrètes.<br>Des communautés plus résilientes.</h2>
      </div>
      <div class="mosaic-intro-aside">
        <p>Quatre axes prioritaires qui incarnent l’engagement d’ATPF auprès des communautés du Niger.</p>
        <a class="btn btn-outline" href="<?= base_path('impact') ?>">Voir notre impact</a>
      </div>
    </div>
    <div class="mosaic-grid">
      <?php foreach ($mosaicDomains as $i => $domain): ?>
        <a class="mosaic-card <?= $i === 0 ? 'mosaic-card--lg' : '' ?> reveal" href="<?= base_path('domaines') ?>#<?= e($domain['slug']) ?>">
          <img src="<?= e($domainImages[($i + 2) % count($domainImages)]) ?>" alt="<?= e($domain['title']) ?>" loading="lazy">
          <div class="mosaic-card__shade" aria-hidden="true"></div>
          <div class="mosaic-card__body">
            <div class="mosaic-card__top">
              <span class="mosaic-card__index"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
              <span class="mosaic-card__icon"><?= icon_svg(domain_icon_key($domain['slug']), 20) ?></span>
            </div>
            <span class="mosaic-card__tag"><?= e($mosaicTags[$i] ?? 'Action') ?></span>
            <h3 class="h3"><?= e($domain['title']) ?></h3>
            <p><?= e($domain['short_description']) ?></p>
            <span class="mosaic-card__cta">Explorer <span aria-hidden="true">→</span></span>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section section-projects">
  <div class="container">
    <div class="section-head split-head reveal">
      <div class="split-head__copy">
        <p class="eyebrow">Projets</p>
        <h2 class="h2">Nos projets</h2>
        <p class="lead">Découvrez les actions menées par ATPF au cœur des communautés.</p>
      </div>
      <div class="split-head__action">
        <a class="btn btn-outline" href="<?= base_path('projets') ?>">Tous les projets</a>
      </div>
    </div>

    <?php if ($featured): ?>
      <div class="project-spotlight reveal">
        <div class="project-spotlight-media">
          <img src="<?= e(project_image_local($featured, $m['projects'], 0)) ?>" alt="<?= e($featured['title']) ?>" loading="lazy">
        </div>
        <div class="project-spotlight-body">
          <div class="meta-row">
            <?php if ($featured['zone']): ?><span class="chip"><?= e($featured['zone']) ?></span><?php endif; ?>
            <span class="chip chip-gold">Projet phare</span>
          </div>
          <h3 class="h2" style="font-size:clamp(1.4rem,2.4vw,1.9rem)"><?= e($featured['title']) ?></h3>
          <p class="prose" style="margin:0"><?= e(truncate($featured['summary'], 220)) ?></p>
          <?php if ($featured['partner_name']): ?>
            <p class="project-meta-line">Partenaire / bailleur : <?= e($featured['partner_name']) ?></p>
          <?php endif; ?>
          <a class="btn btn-dark" href="<?= base_path('projets/' . $featured['slug']) ?>">Voir le projet</a>
        </div>
      </div>
    <?php endif; ?>

    <?php if ($otherProjects): ?>
      <div class="grid-2 project-side-grid">
        <?php foreach ($otherProjects as $i => $project): ?>
          <article class="card reveal">
            <div class="card-media">
              <img src="<?= e(project_image_local($project, $m['projects'], $i + 1)) ?>" alt="<?= e($project['title']) ?>" loading="lazy">
            </div>
            <div class="card-body">
              <div class="meta-row">
                <?php if ($project['zone']): ?><span class="chip"><?= e($project['zone']) ?></span><?php endif; ?>
                <?php if ($project['period_label']): ?><span class="chip chip-gold"><?= e($project['period_label']) ?></span><?php endif; ?>
              </div>
              <h3 class="h3"><?= e($project['title']) ?></h3>
              <p><?= e(truncate($project['summary'], 120)) ?></p>
              <a class="link-arrow" href="<?= base_path('projets/' . $project['slug']) ?>">Voir le projet →</a>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<section class="section section-map">
  <div class="container map-wrap">
    <div class="reveal">
      <p class="eyebrow">Territoires</p>
      <h2 class="h2">Où intervenons-nous ?</h2>
      <p class="lead map-lead">ATPF intervient dans sept régions du Niger, avec une coordination nationale à Niamey.</p>
      <div class="map-image map-svg-wrap">
        <?php partial('niger-map'); ?>
      </div>
    </div>
    <div class="region-list reveal" data-region-panel>
      <?php foreach ($regions as $i => $region): ?>
        <article class="region-item <?= $i === 0 ? 'is-active' : '' ?>" data-region-trigger="<?= e($region['slug']) ?>" tabindex="0" role="button">
          <div class="region-item-top">
            <h3 class="h3" data-region-title><?= e($region['name']) ?></h3>
            <span class="region-count"><?= (int) ($region['projects_count'] ?? 0) ?> projet<?= ((int) ($region['projects_count'] ?? 0)) > 1 ? 's' : '' ?></span>
          </div>
          <p class="region-domains">
            <?php
              $titles = [];
              foreach (($region['domains'] ?? []) as $d) {
                $titles[] = $d['title'] ?? '';
              }
              echo e($titles ? implode(', ', array_filter($titles)) : 'Cliquez pour voir le détail');
            ?>
          </p>
        </article>
      <?php endforeach; ?>
      <aside class="region-detail" aria-live="polite">
        <p data-region-desc class="region-domains" style="margin:0"></p>
        <strong data-region-count class="sr-only"></strong>
        <div data-region-domains style="display:flex;flex-wrap:wrap;gap:.4rem;margin:.75rem 0"></div>
        <ul data-region-projects style="margin:0;padding-left:1.1rem;color:var(--adk-muted)"></ul>
      </aside>
      <a class="btn btn-outline" href="<?= base_path('impact') ?>">Voir l’impact territorial</a>
    </div>
  </div>
</section>

<section class="section bg-green approach-section">
  <div class="container">
    <div class="section-head center reveal approach-head">
      <p class="eyebrow" style="color:var(--adk-gold-soft)">Notre approche</p>
      <h2 class="h2">Nous ne faisons pas à la place des communautés.<br>Nous construisons avec elles.</h2>
    </div>
    <div class="approach-grid">
      <article class="approach-item reveal">
        <div class="principle-num">01</div>
        <h3 class="h3">Participation communautaire</h3>
        <p>Les communautés orientent les priorités et participent à la mise en œuvre.</p>
      </article>
      <article class="approach-item reveal">
        <div class="principle-num">02</div>
        <h3 class="h3">Appropriation locale</h3>
        <p>Les acquis sont conçus pour rester entre les mains des acteurs locaux.</p>
      </article>
      <article class="approach-item reveal">
        <div class="principle-num">03</div>
        <h3 class="h3">Résilience</h3>
        <p>Renforcer durablement la capacité à faire face aux chocs climatiques et économiques.</p>
      </article>
      <article class="approach-item reveal">
        <div class="principle-num">04</div>
        <h3 class="h3">Redevabilité</h3>
        <p>Être responsable envers les bénéficiaires, bailleurs et autorités.</p>
      </article>
      <article class="approach-item reveal">
        <div class="principle-num">05</div>
        <h3 class="h3">Dignité humaine</h3>
        <p>Agir dans le respect de chaque personne, sans discrimination.</p>
      </article>
      <article class="approach-item reveal">
        <div class="principle-num">06</div>
        <h3 class="h3">Durabilité</h3>
        <p>Privilégier des progrès viables sans dépendance permanente.</p>
      </article>
    </div>
  </div>
</section>

<section class="section section-vmv">
  <div class="container vmv-grid">
    <div class="vmv-panel vmv-panel-accent reveal">
      <p class="eyebrow">Institutionnel</p>
      <h2 class="h2">Vision & mission</h2>
      <div class="vmv-block">
        <h3 class="h3">Notre vision</h3>
        <p class="prose">Une société paisible dans laquelle chaque composante possède les capacités à satisfaire ses besoins essentiels et à acquérir un mieux-être nécessaire à son épanouissement dans une logique de développement durable.</p>
      </div>
      <div class="vmv-block">
        <h3 class="h3">Notre mission</h3>
        <p class="prose">Contribuer au développement durable du Niger par la conservation, la restauration et la valorisation de l’environnement, la réduction de la pauvreté et le renforcement des capacités des acteurs locaux.</p>
      </div>
    </div>
    <div class="vmv-panel reveal">
      <p class="eyebrow">Éthique</p>
      <h2 class="h2">Nos valeurs</h2>
      <div class="values-list values-stack">
        <div class="value-item">
          <div class="icon-wrap"><?= icon_svg('users', 20) ?></div>
          <div>
            <h3 class="h3">Solidarité</h3>
            <p>Être aux côtés des communautés vulnérables pour la satisfaction de leurs besoins essentiels.</p>
          </div>
        </div>
        <div class="value-item">
          <div class="icon-wrap"><?= icon_svg('leaf', 20) ?></div>
          <div>
            <h3 class="h3">Respect</h3>
            <p>Respect de la dignité humaine, de l’équité et de la diversité des territoires.</p>
          </div>
        </div>
        <div class="value-item">
          <div class="icon-wrap"><?= icon_svg('map', 20) ?></div>
          <div>
            <h3 class="h3">Redevabilité</h3>
            <p>Responsabilité envers les bailleurs, partenaires, bénéficiaires et autorités.</p>
          </div>
        </div>
        <div class="value-item">
          <div class="icon-wrap"><?= icon_svg('sparkles', 20) ?></div>
          <div>
            <h3 class="h3">Qualité</h3>
            <p>Recherche continue du savoir-faire pour un impact durable sur le terrain.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section section-news">
  <div class="container">
    <div class="section-head split-head reveal">
      <div class="split-head__copy">
        <p class="eyebrow">Actualités</p>
        <h2 class="h2">Actualités & terrain</h2>
        <p class="lead">Suivez les activités, événements et histoires de terrain d’ATPF.</p>
      </div>
      <div class="split-head__action">
        <a class="btn btn-outline" href="<?= base_path('actualites') ?>">Toutes les actualités</a>
      </div>
    </div>

    <?php if ($featuredNews): ?>
      <div class="news-spotlight">
        <article class="news-feature reveal">
          <div class="news-feature-media">
            <img src="<?= e(news_image_local($featuredNews, $m['news'], 0)) ?>" alt="<?= e($featuredNews['title']) ?>" loading="lazy">
          </div>
          <div class="news-feature-body">
            <div class="meta-row">
              <span class="chip"><?= e($featuredNews['category'] ?: 'Actualité') ?></span>
              <span class="chip chip-gold"><?= e(format_date($featuredNews['published_at'])) ?></span>
            </div>
            <h3 class="h2" style="font-size:clamp(1.35rem,2.2vw,1.8rem)"><?= e($featuredNews['title']) ?></h3>
            <p><?= e(truncate($featuredNews['excerpt'], 160)) ?></p>
            <a class="link-arrow" href="<?= base_path('actualites/' . $featuredNews['slug']) ?>">Lire l’article →</a>
          </div>
        </article>
        <div class="news-side">
          <?php foreach ($sideNews as $i => $article): ?>
            <article class="news-side-item reveal">
              <img src="<?= e(news_image_local($article, $m['news'], $i + 1)) ?>" alt="<?= e($article['title']) ?>" loading="lazy">
              <div>
                <div class="meta-row">
                  <span class="chip"><?= e($article['category'] ?: 'Actualité') ?></span>
                  <span class="chip chip-gold"><?= e(format_date($article['published_at'], 'd/m/Y')) ?></span>
                </div>
                <h3 class="h3"><?= e($article['title']) ?></h3>
                <a class="link-arrow" href="<?= base_path('actualites/' . $article['slug']) ?>">Lire →</a>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    <?php else: ?>
      <div class="empty-state reveal">Les actualités seront publiées prochainement.</div>
    <?php endif; ?>
  </div>
</section>

<?php if (!empty($testimonials)): ?>
<section class="section section-quotes">
  <div class="container">
    <div class="section-head center reveal">
      <p class="eyebrow">Confiance</p>
      <h2 class="h2">Ils parlent de notre action</h2>
    </div>
    <div class="quote-grid">
      <?php foreach ($testimonials as $t): ?>
        <blockquote class="quote-card reveal">
          <span class="quote-mark" aria-hidden="true">“</span>
          <p><?= e($t['quote']) ?></p>
          <footer>
            <strong><?= e($t['full_name']) ?></strong>
            <span><?= e($t['role_title'] ?: 'Partenaire') ?></span>
          </footer>
        </blockquote>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="section section-partners">
  <div class="container">
    <div class="section-head center reveal">
      <p class="eyebrow">Partenaires</p>
      <h2 class="h2">Ils nous font confiance</h2>
    </div>
  </div>
  <?php if ($partners): ?>
    <div class="partners-marquee" aria-label="Logos des partenaires">
      <div class="partners-track">
        <?php
          $loop = array_merge($partners, $partners);
          foreach ($loop as $partner):
        ?>
          <div class="partner-logo" title="<?= e($partner['name']) ?>">
            <?php if (!empty($partner['logo'])): ?>
              <img src="<?= asset(ltrim($partner['logo'], '/')) ?>" alt="Logo <?= e($partner['name']) ?>" loading="lazy">
            <?php else: ?>
              <span><?= e($partner['name']) ?></span>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>
</section>

<section class="section section-transparency">
  <div class="container transparency-layout">
    <div class="reveal">
      <p class="eyebrow">Transparence</p>
      <h2 class="h2">Transparence & redevabilité</h2>
      <p class="lead">Rapports, documents institutionnels et publications pour renforcer la confiance des bailleurs, partenaires et communautés.</p>
      <a class="btn btn-dark" href="<?= base_path('ressources') ?>">Consulter nos ressources</a>
    </div>
    <div class="transparency-list reveal">
      <a class="transparency-item" href="<?= base_path('ressources') ?>">
        <span class="transparency-num">01</span>
        <span>
          <strong>Rapports annuels</strong>
          <small>Suivi institutionnel et redevabilité</small>
        </span>
        <span class="transparency-arrow" aria-hidden="true">→</span>
      </a>
      <a class="transparency-item" href="<?= base_path('ressources') ?>">
        <span class="transparency-num">02</span>
        <span>
          <strong>Rapports d’activités</strong>
          <small>Restitution des actions de terrain</small>
        </span>
        <span class="transparency-arrow" aria-hidden="true">→</span>
      </a>
      <a class="transparency-item" href="<?= base_path('ressources') ?>">
        <span class="transparency-num">03</span>
        <span>
          <strong>Documents institutionnels</strong>
          <small>Cadre organisationnel</small>
        </span>
        <span class="transparency-arrow" aria-hidden="true">→</span>
      </a>
      <a class="transparency-item" href="<?= base_path('ressources') ?>">
        <span class="transparency-num">04</span>
        <span>
          <strong>Politiques</strong>
          <small>Engagements et standards</small>
        </span>
        <span class="transparency-arrow" aria-hidden="true">→</span>
      </a>
    </div>
  </div>
</section>

<section class="cta-bleed">
  <img src="<?= e($m['cta']) ?>" alt="" aria-hidden="true" loading="lazy">
  <div class="cta-bleed-overlay"></div>
  <div class="container cta-bleed-content">
    <p class="eyebrow" style="color:var(--adk-gold-soft)">Partenariat</p>
    <h2 class="h2">Ensemble, construisons des territoires plus résilients.</h2>
    <p>Vous êtes une institution, un bailleur ou un acteur local souhaitant contribuer au développement durable du Niger ?</p>
    <div class="hero-actions">
      <a class="btn btn-primary" href="<?= base_path('partenaires') ?>#devenir-partenaire">Devenir partenaire</a>
      <a class="btn btn-secondary" href="<?= base_path('contact') ?>">Nous contacter</a>
    </div>
  </div>
</section>
