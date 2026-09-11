<section class="page-hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Fil d'Ariane">
      <a href="<?= base_path() ?>">Accueil</a><span>/</span><span>À propos</span>
    </nav>
    <p class="eyebrow">Institution</p>
    <h1 class="h1">ATPF, une ONG nigérienne au service des territoires</h1>
    <p class="lead">Créée en 2001 et reconnue en 2004, ATPF agit pour un développement durable ancré dans les communautés du Niger.</p>
  </div>
</section>

<section class="section about-section">
  <div class="container about-layout">
    <div class="about-media reveal">
      <div class="media-frame about-photo">
        <img src="<?= atpf_img('mung3-scaled.jpg') ?>" alt="Actions ATPF au Niger" loading="lazy">
      </div>
      <div class="about-float">
        <strong>Niamey</strong>
        <span>Siège · Antennes régionales</span>
      </div>
    </div>
    <div class="reveal">
      <p class="eyebrow">Qui sommes-nous</p>
      <h2 class="h2">Une organisation nationale, ancrée localement</h2>
      <div class="prose">
        <p>L’ONG <strong>Aménagement des Terroirs et Productions Forestières (ATPF)</strong> est une organisation non gouvernementale à but non lucratif. Elle a été créée en 2001 et reconnue officiellement par <?= e(config('recognition')) ?>.</p>
        <p>ATPF compte environ <?= e(setting('org_members_active', '50')) ?> membres actifs, <?= e(setting('org_sympathizers', '120')) ?> membres sympathisants et plus de <?= e(setting('org_community_orgs', '175+')) ?> organisations communautaires de base.</p>
      </div>
      <div class="mini-metrics">
        <div class="mini-metric"><strong>2001</strong><span>Création</span></div>
        <div class="mini-metric"><strong>2004</strong><span>Reconnaissance</span></div>
        <div class="mini-metric"><strong>7</strong><span>Régions</span></div>
      </div>
    </div>
  </div>
</section>

<section class="section section-vmv">
  <div class="container vmv-grid">
    <div class="vmv-panel vmv-panel-accent reveal" id="vision">
      <p class="eyebrow">Vision</p>
      <h2 class="h2">Une société paisible et durable</h2>
      <p class="prose">« Une société paisible dans laquelle chaque composante possède les capacités à satisfaire ses besoins essentiels et à acquérir un mieux-être nécessaire à son épanouissement dans une logique de Développement Durable. »</p>
    </div>
    <div class="vmv-panel reveal" id="mission">
      <p class="eyebrow">Mission</p>
      <h2 class="h2">Contribuer au développement durable du Niger</h2>
      <p class="prose">Conservation, restauration et valorisation de l’environnement ; réduction de la pauvreté ; renforcement des capacités ; accompagnement des acteurs locaux.</p>
    </div>
  </div>
</section>

<section class="section bg-green-pale" id="approche">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">Objectifs</p>
      <h2 class="h2">Lutter contre la pauvreté et la dégradation de l’environnement</h2>
    </div>
    <div class="approach-grid">
      <article class="approach-item reveal" style="background:#fff;color:var(--adk-ink)">
        <div class="principle-num" style="color:var(--adk-gold)">01</div>
        <h3 class="h3">Conditions de vie</h3>
        <p>Appuyer l’amélioration des conditions de vie des communautés.</p>
      </article>
      <article class="approach-item reveal" style="background:#fff;color:var(--adk-ink)">
        <div class="principle-num" style="color:var(--adk-gold)">02</div>
        <h3 class="h3">Éducation</h3>
        <p>Œuvrer pour l’éducation formelle, non formelle et l’alphabétisation.</p>
      </article>
      <article class="approach-item reveal" style="background:#fff;color:var(--adk-ink)">
        <div class="principle-num" style="color:var(--adk-gold)">03</div>
        <h3 class="h3">Écosystèmes</h3>
        <p>Lutter contre la dégradation des écosystèmes et renforcer la sécurité alimentaire.</p>
      </article>
      <article class="approach-item reveal" style="background:#fff;color:var(--adk-ink)">
        <div class="principle-num" style="color:var(--adk-gold)">04</div>
        <h3 class="h3">Femmes</h3>
        <p>Promouvoir l’autonomisation économique des femmes.</p>
      </article>
    </div>
  </div>
</section>

<?php if (!empty($stats)): ?>
<section class="section">
  <div class="container">
    <div class="section-head center reveal">
      <p class="eyebrow">Repères</p>
      <h2 class="h2">En quelques chiffres</h2>
    </div>
    <div class="stats-grid stats-grid-premium">
      <?php foreach ($stats as $stat): ?>
        <article class="stat-card reveal">
          <div class="stat-value"><?= e($stat['value_display']) ?></div>
          <div class="stat-label"><?= e($stat['label']) ?></div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="cta-bleed">
  <img src="<?= atpf_img('about-3.jpg') ?>" alt="" aria-hidden="true" loading="lazy">
  <div class="cta-bleed-overlay"></div>
  <div class="container cta-bleed-content">
    <p class="eyebrow" style="color:var(--adk-gold-soft)">Partenariat</p>
    <h2 class="h2">Travaillons ensemble</h2>
    <p>Institutions, bailleurs et partenaires techniques : rejoignez une organisation crédible, ancrée et orientée résultats.</p>
    <div class="hero-actions">
      <a class="btn btn-primary" href="<?= base_path('partenaires') ?>#devenir-partenaire">Devenir partenaire</a>
      <a class="btn btn-secondary" href="<?= base_path('contact') ?>">Contact</a>
    </div>
  </div>
</section>
