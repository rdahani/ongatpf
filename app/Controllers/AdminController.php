<?php

declare(strict_types=1);

class AdminController extends Controller
{
    public function loginForm(): void
    {
        if (Auth::check()) {
            redirect('admin');
        }
        view('admin/login', [
            'title' => 'Connexion admin | ATPF',
            'metaDescription' => '',
        ], 'layouts/admin-auth');
    }

    public function login(): void
    {
        Csrf::verifyRequest();
        $email = trim((string) ($_POST['email'] ?? ''));
        $password = (string) ($_POST['password'] ?? '');

        if (Auth::attempt($email, $password)) {
            flash('success', 'Bienvenue dans l\'espace d\'administration ATPF.');
            redirect('admin');
        }

        flash('error', 'Identifiants incorrects ou trop de tentatives. Réessayez plus tard.');
        redirect('admin/login');
    }

    public function logout(): void
    {
        Auth::logout();
        flash('success', 'Vous êtes déconnecté.');
        redirect('admin/login');
    }

    public function dashboard(): void
    {
        Auth::requireLogin();
        view('admin/dashboard', [
            'title' => 'Tableau de bord',
            'counts' => [
                'projects_active' => Database::count('projects', "status = 'active'"),
                'projects_completed' => Database::count('projects', "status = 'completed'"),
                'news' => Database::count('news'),
                'partners' => Database::count('partners'),
                'publications' => Database::count('resources'),
                'messages' => Database::count('contact_messages', 'is_read = 0'),
                'regions' => Database::count('regions'),
            ],
            'recentMessages' => Database::fetchAll('SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 5'),
        ], 'layouts/admin');
    }

    /* ---------- Projets ---------- */
    public function projects(): void
    {
        Auth::requireLogin();
        view('admin/projects/index', [
            'title' => 'Projets',
            'items' => Project::allAdmin(),
        ], 'layouts/admin');
    }

    public function projectForm(?string $id = null): void
    {
        Auth::requireEdit();
        $item = $id ? Project::find((int) $id) : null;
        view('admin/projects/form', [
            'title' => $item ? 'Modifier le projet' : 'Nouveau projet',
            'item' => $item,
            'regions' => Region::all(),
            'domains' => Domain::published(),
            'selectedRegions' => $item ? array_column(Project::regions((int) $item['id']), 'id') : [],
            'selectedDomains' => $item ? array_column(Project::domains((int) $item['id']), 'id') : [],
        ], 'layouts/admin');
    }

    public function projectSave(): void
    {
        Auth::requireEdit();
        Csrf::verifyRequest();

        $id = (int) ($_POST['id'] ?? 0);
        $title = trim((string) ($_POST['title'] ?? ''));
        $slug = trim((string) ($_POST['slug'] ?? '')) ?: slugify($title);
        $data = [
            'title' => $title,
            'slug' => $slug,
            'summary' => trim((string) ($_POST['summary'] ?? '')),
            'content' => sanitize_html((string) ($_POST['content'] ?? '')),
            'zone' => trim((string) ($_POST['zone'] ?? '')),
            'period_label' => trim((string) ($_POST['period_label'] ?? '')),
            'partner_name' => trim((string) ($_POST['partner_name'] ?? '')),
            'status' => in_array($_POST['status'] ?? '', ['active', 'completed', 'planned', 'draft'], true) ? $_POST['status'] : 'draft',
            'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
            'is_published' => isset($_POST['is_published']) ? 1 : 0,
            'published_at' => isset($_POST['is_published']) ? date('Y-m-d H:i:s') : null,
            'cover_image' => trim((string) ($_POST['cover_image'] ?? '')),
        ];

        if ($title === '' || $data['summary'] === '') {
            flash('error', 'Titre et résumé obligatoires.');
            redirect($id ? "admin/projets/edit/$id" : 'admin/projets/create');
        }

        if ($id) {
            Database::update('projects', $data, 'id = :id', ['id' => $id]);
            $projectId = $id;
        } else {
            $projectId = Database::insert('projects', $data);
        }

        Database::delete('project_regions', 'project_id = ?', [$projectId]);
        Database::delete('project_domains', 'project_id = ?', [$projectId]);
        foreach ((array) ($_POST['regions'] ?? []) as $rid) {
            Database::insert('project_regions', ['project_id' => $projectId, 'region_id' => (int) $rid]);
        }
        foreach ((array) ($_POST['domains'] ?? []) as $did) {
            Database::insert('project_domains', ['project_id' => $projectId, 'domain_id' => (int) $did]);
        }

        flash('success', 'Projet enregistré.');
        redirect('admin/projets');
    }

    public function projectDelete(): void
    {
        Auth::requireEdit();
        Csrf::verifyRequest();
        $id = (int) ($_POST['id'] ?? 0);
        if ($id) {
            Database::delete('projects', 'id = ?', [$id]);
        }
        flash('success', 'Projet supprimé.');
        redirect('admin/projets');
    }

    /* ---------- Actualités ---------- */
    public function news(): void
    {
        Auth::requireLogin();
        view('admin/news/index', ['title' => 'Actualités', 'items' => News::allAdmin()], 'layouts/admin');
    }

    public function newsForm(?string $id = null): void
    {
        Auth::requireEdit();
        $item = $id ? Database::fetch('SELECT * FROM news WHERE id = ?', [(int) $id]) : null;
        view('admin/news/form', [
            'title' => $item ? 'Modifier l\'actualité' : 'Nouvelle actualité',
            'item' => $item,
        ], 'layouts/admin');
    }

    public function newsSave(): void
    {
        Auth::requireEdit();
        Csrf::verifyRequest();
        $id = (int) ($_POST['id'] ?? 0);
        $title = trim((string) ($_POST['title'] ?? ''));
        $data = [
            'title' => $title,
            'slug' => trim((string) ($_POST['slug'] ?? '')) ?: slugify($title),
            'category' => trim((string) ($_POST['category'] ?? 'Actualité')),
            'excerpt' => trim((string) ($_POST['excerpt'] ?? '')),
            'content' => sanitize_html((string) ($_POST['content'] ?? '')),
            'cover_image' => trim((string) ($_POST['cover_image'] ?? '')),
            'is_published' => isset($_POST['is_published']) ? 1 : 0,
            'published_at' => isset($_POST['is_published']) ? date('Y-m-d H:i:s') : null,
        ];
        if ($id) {
            Database::update('news', $data, 'id = :id', ['id' => $id]);
        } else {
            Database::insert('news', $data);
        }
        flash('success', 'Actualité enregistrée.');
        redirect('admin/actualites');
    }

    public function newsDelete(): void
    {
        Auth::requireEdit();
        Csrf::verifyRequest();
        Database::delete('news', 'id = ?', [(int) ($_POST['id'] ?? 0)]);
        flash('success', 'Actualité supprimée.');
        redirect('admin/actualites');
    }

    /* ---------- Partenaires ---------- */
    public function partners(): void
    {
        Auth::requireLogin();
        view('admin/partners/index', ['title' => 'Partenaires', 'items' => Partner::allAdmin()], 'layouts/admin');
    }

    public function partnerSave(): void
    {
        Auth::requireEdit();
        Csrf::verifyRequest();
        $id = (int) ($_POST['id'] ?? 0);
        $name = trim((string) ($_POST['name'] ?? ''));
        $data = [
            'name' => $name,
            'slug' => slugify($name),
            'website' => trim((string) ($_POST['website'] ?? '')),
            'partner_type' => $_POST['partner_type'] ?? 'bailleur',
            'description' => trim((string) ($_POST['description'] ?? '')),
            'logo' => trim((string) ($_POST['logo'] ?? '')),
            'is_published' => isset($_POST['is_published']) ? 1 : 0,
            'sort_order' => (int) ($_POST['sort_order'] ?? 0),
        ];
        if ($id) {
            Database::update('partners', $data, 'id = :id', ['id' => $id]);
        } else {
            Database::insert('partners', $data);
        }
        flash('success', 'Partenaire enregistré.');
        redirect('admin/partenaires');
    }

    public function partnerDelete(): void
    {
        Auth::requireEdit();
        Csrf::verifyRequest();
        Database::delete('partners', 'id = ?', [(int) ($_POST['id'] ?? 0)]);
        flash('success', 'Partenaire supprimé.');
        redirect('admin/partenaires');
    }

    /* ---------- Stats / Settings ---------- */
    public function stats(): void
    {
        Auth::requireLogin();
        view('admin/stats', [
            'title' => 'Chiffres clés',
            'items' => ImpactStat::all(),
        ], 'layouts/admin');
    }

    public function statsSave(): void
    {
        Auth::requireEdit();
        Csrf::verifyRequest();
        foreach ((array) ($_POST['stats'] ?? []) as $id => $row) {
            Database::update('impact_stats', [
                'label' => trim((string) ($row['label'] ?? '')),
                'value_display' => trim((string) ($row['value_display'] ?? '—')),
                'numeric_value' => $row['numeric_value'] !== '' ? (int) $row['numeric_value'] : null,
                'is_published' => isset($row['is_published']) ? 1 : 0,
                'notes' => trim((string) ($row['notes'] ?? '')),
            ], 'id = :id', ['id' => (int) $id]);
        }
        flash('success', 'Chiffres mis à jour. N\'oubliez pas de ne publier que des données validées.');
        redirect('admin/chiffres');
    }

    public function messages(): void
    {
        Auth::requireLogin();
        $items = Database::fetchAll('SELECT * FROM contact_messages ORDER BY created_at DESC');
        view('admin/messages', ['title' => 'Messages', 'items' => $items], 'layouts/admin');
    }

    public function messageRead(): void
    {
        Auth::requireLogin();
        Csrf::verifyRequest();
        Database::update('contact_messages', ['is_read' => 1], 'id = :id', ['id' => (int) ($_POST['id'] ?? 0)]);
        redirect('admin/messages');
    }

    public function resources(): void
    {
        Auth::requireLogin();
        view('admin/resources/index', ['title' => 'Publications', 'items' => Resource::allAdmin()], 'layouts/admin');
    }

    public function resourceSave(): void
    {
        Auth::requireEdit();
        Csrf::verifyRequest();
        $id = (int) ($_POST['id'] ?? 0);
        $title = trim((string) ($_POST['title'] ?? ''));
        $data = [
            'title' => $title,
            'slug' => slugify($title),
            'resource_type' => $_POST['resource_type'] ?? 'rapport',
            'description' => trim((string) ($_POST['description'] ?? '')),
            'file_path' => trim((string) ($_POST['file_path'] ?? '')),
            'external_url' => trim((string) ($_POST['external_url'] ?? '')),
            'year' => $_POST['year'] !== '' ? (int) $_POST['year'] : null,
            'is_published' => isset($_POST['is_published']) ? 1 : 0,
            'published_at' => isset($_POST['is_published']) ? date('Y-m-d H:i:s') : null,
        ];
        if ($id) {
            Database::update('resources', $data, 'id = :id', ['id' => $id]);
        } else {
            Database::insert('resources', $data);
        }
        flash('success', 'Publication enregistrée.');
        redirect('admin/ressources');
    }
}
