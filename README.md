# Site institutionnel ATPF

Nouveau site web premium pour l’ONG **Aménagement des Terroirs et Productions Forestières** (Niamey, Niger).

## Stack

- PHP 8.2+
- MySQL / MariaDB
- Architecture MVC légère (router front controller)
- CSS design system Sahel (compatible approche Tailwind)
- Admin CMS sécurisé (CSRF, XSS, SQLi via PDO, rate limiting login/contact)

## Prérequis

- XAMPP (Apache + MySQL + PHP)
- `mod_rewrite` activé

## Installation

1. Placer le projet dans `C:\xampp\htdocs\ongatpf`
2. Démarrer Apache et MySQL
3. Ouvrir [http://localhost/ongatpf/install.php](http://localhost/ongatpf/install.php)
4. Définir l’email et le mot de passe administrateur
5. **Supprimer `install.php`** après installation
6. Site : [http://localhost/ongatpf/](http://localhost/ongatpf/)
7. Admin : [http://localhost/ongatpf/admin/login](http://localhost/ongatpf/admin/login)

## Configuration

Fichiers :

- `config/app.php` — URL, base path (`/ongatpf`), contact, réseaux
- `config/database.php` — identifiants MySQL

En production, adapter :

- `url` → `https://ongatpf.org`
- `base_path` → `` (vide) si le site est à la racine
- `RewriteBase` dans `.htaccess`
- `robots.txt` (URL du sitemap)

## Contenu administrable

Depuis `/admin` :

- Projets (CRUD, publish/unpublish, régions, domaines)
- Actualités
- Partenaires
- Publications / ressources
- Chiffres clés (ne jamais inventer : utiliser `—` si non validé)
- Messages de contact

## Pages publiques

| URL | Page |
|-----|------|
| `/` | Accueil |
| `/a-propos` | Institution |
| `/domaines` | Domaines d’intervention |
| `/projets` | Liste projets |
| `/projets/{slug}` | Fiche projet |
| `/impact` | Impact |
| `/actualites` | Actualités |
| `/actualites/{slug}` | Article |
| `/ressources` | Publications |
| `/partenaires` | Partenaires + CTA |
| `/contact` | Contact |

## Sécurité

- Jetons CSRF sur tous les formulaires POST
- Requêtes préparées PDO
- Échappement HTML systématique (`e()`)
- Sessions httponly / samesite
- Rate limiting login & contact
- Rôles admin : `superadmin`, `editor`, `viewer`
- Dossiers sensibles bloqués via `.htaccess`

## Performances

- CSS critique local (pas de framework lourd runtime)
- Images Unsplash en lazy-loading (+ `fetchpriority` sur le hero)
- Fonts Google avec `display=swap` + preconnect
- Animations légères respectant `prefers-reduced-motion`

## Notes importantes

- Les chiffres non validés s’affichent comme `—`
- Les témoignages réels ne sont **pas** inventés (placeholders non publiés)
- Remplacer les images Unsplash par des photos terrain ATPF (dossier `uploads/` ou `assets/images/`)
- Ajouter les logos partenaires dans `uploads/partners/`

## Structure

```
ongatpf/
├── app/           # Core, modèles, contrôleurs
├── assets/        # CSS, JS, images
├── config/        # Configuration
├── database/      # schema.sql + seed.sql
├── uploads/       # Médias uploadés
├── views/         # Templates publics + admin
├── index.php      # Front controller
└── install.php    # Installateur (à supprimer)
```
