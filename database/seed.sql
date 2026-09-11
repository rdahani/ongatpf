-- ============================================================
-- ONG ATPF – Données initiales
-- ============================================================
USE ongatpf;

-- Mot de passe: Admin@ATPF2026! (à changer immédiatement)
INSERT INTO admin_users (name, email, password_hash, role) VALUES
('Administrateur ATPF', 'admin@ongatpf.org', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'superadmin');
-- Note: hash ci-dessus = "password" — sera remplacé à l'installation

INSERT INTO site_settings (setting_key, setting_value, setting_type, label, group_name) VALUES
('hero_title', 'Construire un Niger plus résilient,\ndurable et solidaire', 'text', 'Titre hero', 'home'),
('hero_subtitle', 'Depuis 2001, ATPF accompagne les communautés nigériennes dans la préservation de l''environnement, la restauration des territoires et l''amélioration durable des conditions de vie.', 'text', 'Sous-titre hero', 'home'),
('about_teaser', 'Depuis plus de deux décennies, ATPF agit aux côtés des communautés pour préserver l''environnement, restaurer les territoires sahéliens et ouvrir des perspectives durables face à la pauvreté et au climat.', 'text', 'Teaser à propos', 'home'),
('cta_title', 'Ensemble, construisons des territoires plus résilients.', 'text', 'Titre CTA', 'home'),
('cta_text', 'Vous êtes une institution, un bailleur, une organisation ou un acteur local souhaitant contribuer au développement durable du Niger ?', 'text', 'Texte CTA', 'home'),
('projects_count_display', '—', 'text', 'Nombre de projets (affichage)', 'stats'),
('communities_count_display', '—', 'text', 'Communautés accompagnées (affichage)', 'stats'),
('org_members_active', '50', 'number', 'Membres actifs', 'org'),
('org_sympathizers', '120', 'number', 'Membres sympathisants', 'org'),
('org_community_orgs', '175+', 'text', 'Organisations communautaires de base', 'org');

-- Chiffres clés : seuls les faits vérifiés sont publiés
INSERT INTO impact_stats (stat_key, label, value_display, numeric_value, suffix, prefix, icon, sort_order, is_published, notes) VALUES
('experience_years', 'd''expérience', '+20 ans', 20, '', '', 'calendar', 1, 1, 'Créée en 2001'),
('regions_count', 'régions d''intervention', '7', 7, '', '', 'map', 2, 1, 'Diffa, Dosso, Maradi, Niamey, Tahoua, Tillabéri, Zinder'),
('projects_done', 'projets réalisés', '—', NULL, '', '', 'folder', 3, 1, 'À renseigner par ATPF'),
('communities_supported', 'communautés accompagnées', '—', NULL, '', '', 'users', 4, 1, 'À renseigner par ATPF'),
('beneficiaries', 'bénéficiaires', '—', NULL, '', '', 'heart', 5, 0, 'À valider'),
('women_supported', 'femmes accompagnées', '—', NULL, '', '', 'users', 6, 0, 'À valider'),
('land_restored', 'terres restaurées', '—', NULL, '', '', 'leaf', 7, 0, 'À valider'),
('trainings', 'formations réalisées', '—', NULL, '', '', 'book', 8, 0, 'À valider'),
('community_orgs', 'organisations communautaires', '175+', 175, '', '', 'network', 9, 1, 'Source PPI/UICN');

INSERT INTO regions (name, slug, description, map_path_id, sort_order) VALUES
('Diffa', 'diffa', 'Interventions en gestion des ressources naturelles et résilience communautaire.', 'diffa', 1),
('Dosso', 'dosso', 'Actions de développement communautaire et environnemental.', 'dosso', 2),
('Maradi', 'maradi', 'Accompagnement des communautés rurales et valorisation des territoires.', 'maradi', 3),
('Niamey', 'niamey', 'Siège social et coordination nationale des programmes.', 'niamey', 4),
('Tahoua', 'tahoua', 'Projets de restauration et d''appui aux moyens de subsistance.', 'tahoua', 5),
('Tillabéri', 'tillaberi', 'Éducation, environnement et développement communautaire (dont Kollo et Say).', 'tillaberi', 6),
('Zinder', 'zinder', 'Interventions de terrain et renforcement des capacités locales.', 'zinder', 7);

INSERT INTO domains (title, slug, short_description, full_description, icon, sort_order) VALUES
('Environnement', 'environnement', 'Conservation, restauration et valorisation des écosystèmes et de la biodiversité.', 'ATPF œuvre pour la protection, la restauration et la gouvernance locale des ressources naturelles, afin de lutter contre la dégradation des écosystèmes sahéliens.', 'leaf', 1),
('Changements climatiques', 'changements-climatiques', 'Adaptation et résilience des communautés face aux effets du climat.', 'Nous accompagnons les populations pour anticiper, s''adapter et réduire la vulnérabilité face aux aléas climatiques qui fragilisent les territoires.', 'cloud', 2),
('Sécurité alimentaire', 'securite-alimentaire', 'Amélioration durable de la production et de la nutrition des ménages.', 'ATPF soutient des pratiques agricoles résilientes et des chaînes de valeur locales pour renforcer la sécurité alimentaire et nutritionnelle.', 'wheat', 3),
('Activités génératrices de revenus', 'activites-generatrices-de-revenus', 'Création de revenus durables et autonomisation économique.', 'Nous appuyons des initiatives économiques locales, notamment autour de produits forestiers non ligneux et de filières communautaires.', 'coins', 4),
('Hydraulique villageoise et pastorale', 'hydraulique-villageoise', 'Accès à l''eau pour les communautés villageoises et pastorales.', 'L''accès durable à l''eau est un levier essentiel pour la santé, l''élevage et la résilience des territoires d''intervention.', 'droplet', 5),
('Éducation et formation', 'education-formation', 'Éducation formelle, non formelle et renforcement des compétences.', 'ATPF contribue à l''éducation et à l''alphabétisation, notamment via des partenariats comme la Fondation Strømme dans la région de Tillabéri.', 'book', 6),
('Développement communautaire', 'developpement-communautaire', 'Renforcement des organisations locales et de la gouvernance participative.', 'Notre approche place les communautés au centre : identification, mise en œuvre et suivi des actions de développement.', 'users', 7),
('Autonomisation des femmes', 'autonomisation-femmes', 'Émancipation économique et sociale des femmes rurales.', 'Nous développons des chaînes de valeur (ex. feuilles séchées de baobab) pour renforcer l''autonomie économique des femmes.', 'sparkles', 8);

INSERT INTO projects (title, slug, summary, content, cover_image, zone, period_label, partner_name, status, is_featured, is_published, published_at, sort_order) VALUES
(
  'Restauration du paysage au Sahel',
  'restauration-paysage-sahel',
  'Créer des terres d''opportunités : transformer les moyens de subsistance grâce à la restauration du paysage au Sahel.',
  '<p>Ce projet vise à restaurer les paysages dégradés du Sahel et à ouvrir de nouvelles perspectives économiques pour les communautés locales. À travers des pratiques de restauration écologique et de gestion durable des terres, ATPF accompagne les populations vers des moyens de subsistance plus résilients.</p><p>L''approche combine restauration écologique, gouvernance locale des ressources naturelles et appui aux initiatives communautaires.</p>',
  'assets/images/projects/restauration-sahel.jpg',
  'Sahel – Niger',
  'En cours',
  'Partenaires techniques et financiers',
  'active',
  1,
  1,
  NOW(),
  1
),
(
  'Gestion durable des ressources naturelles – Parc W & Zone Girafe',
  'gestion-durable-parc-w-zone-girafe',
  'Appui à la gestion durable des ressources naturelles à la périphérie du Parc W et de la Zone Girafe au Niger (PAGD/RN/PW/ZG).',
  '<p>Le projet PAGD/RN/PW/ZG renforce la gestion durable des ressources naturelles autour du Parc W et de la Zone Girafe. Il mobilise les communautés riveraines, les communes et les partenaires techniques pour préserver la biodiversité tout en améliorant les conditions de vie.</p><p>Mis en œuvre avec l''appui de partenaires tels que RBT-WAP / GIC-WAP / GIZ, ce programme s''inscrit dans une logique de gouvernance partagée des territoires.</p>',
  'assets/images/projects/parc-w.jpg',
  'Périphérie du Parc W et Zone Girafe',
  'Réalisé / en suivi',
  'GIZ / RBT-WAP / GIC-WAP',
  'completed',
  1,
  1,
  NOW(),
  2
),
(
  'Autonomisation des femmes – feuilles séchées de baobab',
  'autonomisation-femmes-baobab',
  'Renforcement de l''autonomisation des femmes par le développement de la chaîne de valeur « feuilles séchées de baobab » à Kouré et Dantchandou.',
  '<p>Dans les communes de Kouré et Dantchandou (Zone Girafe), ATPF accompagne les femmes dans la valorisation des feuilles séchées de baobab. Le projet structure une chaîne de valeur ajoutée : production, transformation, organisation communautaire et accès au marché.</p><p>Objectif : renforcer l''autonomie économique des femmes tout en valorisant durablement un produit forestier non ligneux emblématique du territoire.</p>',
  'assets/images/projects/baobab-femmes.jpg',
  'Communes de Kouré et Dantchandou (Zone Girafe)',
  'Réalisé',
  'PPI / FFEM / UICN',
  'completed',
  1,
  1,
  NOW(),
  3
);

INSERT INTO project_regions (project_id, region_id)
SELECT p.id, r.id FROM projects p, regions r
WHERE p.slug = 'gestion-durable-parc-w-zone-girafe' AND r.slug IN ('tillaberi','dosso');

INSERT INTO project_regions (project_id, region_id)
SELECT p.id, r.id FROM projects p, regions r
WHERE p.slug = 'autonomisation-femmes-baobab' AND r.slug = 'tillaberi';

INSERT INTO project_domains (project_id, domain_id)
SELECT p.id, d.id FROM projects p, domains d
WHERE p.slug = 'restauration-paysage-sahel' AND d.slug IN ('environnement','changements-climatiques','securite-alimentaire');

INSERT INTO project_domains (project_id, domain_id)
SELECT p.id, d.id FROM projects p, domains d
WHERE p.slug = 'gestion-durable-parc-w-zone-girafe' AND d.slug IN ('environnement','developpement-communautaire');

INSERT INTO project_domains (project_id, domain_id)
SELECT p.id, d.id FROM projects p, domains d
WHERE p.slug = 'autonomisation-femmes-baobab' AND d.slug IN ('autonomisation-femmes','activites-generatrices-de-revenus');

INSERT INTO partners (name, slug, logo, website, partner_type, description, sort_order, is_published) VALUES
('PPI / FFEM', 'ppi-ffem', NULL, 'https://www.programmeppi.org/', 'bailleur', 'Programme de Petites Initiatives / Fonds Français pour l''Environnement Mondial', 1, 1),
('GIZ', 'giz', NULL, 'https://www.giz.de/', 'bailleur', 'Deutsche Gesellschaft für Internationale Zusammenarbeit', 2, 1),
('Union Européenne', 'union-europeenne', NULL, 'https://europa.eu/', 'bailleur', 'Union Européenne', 3, 1),
('Union Africaine', 'union-africaine', NULL, 'https://au.int/', 'institutionnel', 'Union Africaine', 4, 1),
('Fondation Strømme', 'fondation-stromme', NULL, 'https://stromme.org/', 'bailleur', 'Partenaire éducation – région de Tillabéri', 5, 1),
('Ambassade de France au Niger', 'ambassade-france-niger', NULL, 'https://ne.ambafrance.org/', 'institutionnel', 'Ambassade de France au Niger', 6, 1),
('UICN', 'uicn', NULL, 'https://www.iucn.org/', 'technique', 'Union Internationale pour la Conservation de la Nature', 7, 1);

INSERT INTO news (title, slug, category, excerpt, content, cover_image, is_published, published_at) VALUES
(
  'ATPF poursuit son engagement pour la restauration des territoires sahéliens',
  'engagement-restauration-territoires-saheliens',
  'Environnement',
  'Retour sur l''approche d''ATPF pour restaurer les paysages et renforcer la résilience des communautés au Niger.',
  '<p>Depuis 2001, ATPF place la restauration des territoires et la préservation de l''environnement au cœur de son action. Dans un contexte sahélien marqué par la dégradation des sols et la pression climatique, l''organisation accompagne les communautés pour reconstruire des paysages productifs et résilients.</p><p>Cette actualité présente les axes prioritaires de l''organisation et invite les partenaires à rejoindre cette dynamique.</p>',
  'assets/images/news/restauration.jpg',
  1,
  NOW() - INTERVAL 12 DAY
),
(
  'Autonomisation des femmes : valoriser les filières locales',
  'autonomisation-femmes-filieres-locales',
  'Genre & revenus',
  'Comment la valorisation des feuilles séchées de baobab renforce l''autonomie économique des femmes en Zone Girafe.',
  '<p>À Kouré et Dantchandou, ATPF a appuyé le développement d''une chaîne de valeur autour des feuilles séchées de baobab. Ce modèle illustre la capacité des femmes rurales à transformer un produit forestier en levier d''autonomie.</p>',
  'assets/images/news/femmes-baobab.jpg',
  1,
  NOW() - INTERVAL 28 DAY
),
(
  'Éducation inclusive à Tillabéri : un partenariat pour les enfants hors école',
  'education-inclusive-tillaberi',
  'Éducation',
  'Avec la Fondation Strømme, ATPF renforce l''accès à une éducation accélérée et inclusive dans le département de Kollo.',
  '<p>Dans le département de Kollo (Tillabéri), ATPF met en œuvre des centres inclusifs SSA/P en partenariat avec la Fondation Strømme. Ces centres offrent aux enfants non scolarisés ou déscolarisés une passerelle vers le système éducatif formel.</p>',
  'assets/images/news/education.jpg',
  1,
  NOW() - INTERVAL 45 DAY
),
(
  'Gouvernance locale des ressources naturelles autour du Parc W',
  'gouvernance-locale-parc-w',
  'Biodiversité',
  'Les communautés riveraines du Parc W et de la Zone Girafe au cœur de la gestion durable des ressources naturelles.',
  '<p>La gestion durable des ressources naturelles à la périphérie du Parc W repose sur une alliance entre communautés, communes et partenaires techniques. ATPF accompagne cette gouvernance partagée pour concilier biodiversité et développement local.</p>',
  'assets/images/news/parc-w.jpg',
  1,
  NOW() - INTERVAL 60 DAY
);

-- Témoignages : placeholders non publiés (à valider par ATPF)
INSERT INTO testimonials (full_name, role_title, community, quote, is_placeholder, is_published, sort_order) VALUES
('Nom à confirmer', 'Bénéficiaire', 'Communauté – à confirmer', '« Témoignage à valider par ATPF avant publication. Ce placeholder illustre l''emplacement prévu pour les voix du terrain. »', 1, 0, 1),
('Nom à confirmer', 'Responsable de groupement', 'Communauté – à confirmer', '« Placeholder témoignage terrain. Remplacer par un récit authentique validé par l''organisation. »', 1, 0, 2),
('Nom à confirmer', 'Partenaire communautaire', 'Communauté – à confirmer', '« Placeholder en attente de validation ATPF. »', 1, 0, 3);

INSERT INTO resources (title, slug, resource_type, description, year, is_published, published_at) VALUES
('Présentation institutionnelle ATPF', 'presentation-institutionnelle', 'brochure', 'Document de présentation de l''organisation, de sa mission et de ses domaines d''intervention.', 2024, 0, NULL),
('Rapport d''activités (à publier)', 'rapport-activites', 'rapport', 'Espace réservé pour les rapports d''activités validés par ATPF.', NULL, 0, NULL);
