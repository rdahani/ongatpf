<?php

declare(strict_types=1);

class PageController extends Controller
{
    public function about(): void
    {
        view('pages/a-propos', $this->seo(
            'À propos d\'ATPF | ONG nigérienne depuis 2001',
            'Découvrez la vision, la mission et l\'approche participative d\'ATPF – Aménagement des Terroirs et Productions Forestières, basée à Niamey.'
        ) + [
            'stats' => ImpactStat::published(),
        ]);
    }

    public function domains(): void
    {
        view('pages/domaines', $this->seo(
            'Nos domaines d\'intervention | ATPF Niger',
            'Environnement, climat, sécurité alimentaire, hydraulique, éducation, développement communautaire et autonomisation des femmes.'
        ) + [
            'domains' => Domain::published(),
        ]);
    }

    public function impact(): void
    {
        view('pages/impact', $this->seo(
            'Notre impact sur le terrain | ATPF',
            'Bénéficiaires, communautés, restauration des terres et résultats des actions d\'ATPF au Niger.'
        ) + [
            'stats' => ImpactStat::published(),
            'regions' => Region::withMeta(),
        ]);
    }

    public function resources(): void
    {
        view('pages/ressources', $this->seo(
            'Ressources et publications | ATPF',
            'Rapports, publications et documents institutionnels d\'ATPF.'
        ) + [
            'resources' => Resource::published(),
        ]);
    }

    public function partners(): void
    {
        view('pages/partenaires', $this->seo(
            'Nos partenaires | ATPF Niger',
            'Bailleurs, partenaires techniques et institutionnels qui soutiennent l\'action d\'ATPF au Niger.'
        ) + [
            'partners' => Partner::published(),
        ]);
    }

    public function contact(): void
    {
        view('pages/contact', $this->seo(
            'Contact | ATPF Niamey',
            'Contactez ATPF à Niamey pour un partenariat, une collaboration ou une demande d\'information.'
        ));
    }

    public function contactSubmit(): void
    {
        Csrf::verifyRequest();

        $name = trim((string) ($_POST['full_name'] ?? ''));
        $org = trim((string) ($_POST['organization'] ?? ''));
        $email = trim((string) ($_POST['email'] ?? ''));
        $phone = trim((string) ($_POST['phone'] ?? ''));
        $subject = trim((string) ($_POST['subject'] ?? ''));
        $message = trim((string) ($_POST['message'] ?? ''));

        $_SESSION['_old'] = compact('name', 'org', 'email', 'phone', 'subject', 'message');

        if ($name === '' || $email === '' || $subject === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            flash('error', 'Veuillez remplir correctement tous les champs obligatoires.');
            redirect('contact');
        }

        // Rate limiting simple
        $window = (int) config('rate_limit.contact_window_minutes', 10);
        $limit = (int) config('rate_limit.contact_attempts', 3);
        $since = date('Y-m-d H:i:s', time() - $window * 60);
        $count = Database::count('contact_messages', 'ip_address = ? AND created_at >= ?', [client_ip(), $since]);
        if ($count >= $limit) {
            flash('error', 'Trop de messages envoyés. Réessayez dans quelques minutes.');
            redirect('contact');
        }

        Database::insert('contact_messages', [
            'full_name' => mb_substr($name, 0, 120),
            'organization' => mb_substr($org, 0, 190),
            'email' => mb_substr($email, 0, 190),
            'phone' => mb_substr($phone, 0, 60),
            'subject' => mb_substr($subject, 0, 255),
            'message' => $message,
            'ip_address' => client_ip(),
        ]);

        unset($_SESSION['_old']);
        flash('success', 'Merci. Votre message a bien été envoyé. ATPF vous répondra rapidement.');
        redirect('contact');
    }
}
