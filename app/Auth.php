<?php

declare(strict_types=1);

class Auth
{
    public static function attempt(string $email, string $password): bool
    {
        if (self::tooManyAttempts($email)) {
            return false;
        }

        self::recordAttempt($email);

        $user = Database::fetch(
            'SELECT * FROM admin_users WHERE email = ? AND is_active = 1 LIMIT 1',
            [$email]
        );

        if (!$user || !password_verify($password, $user['password_hash'])) {
            return false;
        }

        session_regenerate_id(true);
        $_SESSION['admin_user'] = [
            'id' => (int) $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
        ];

        Database::update('admin_users', [
            'last_login_at' => date('Y-m-d H:i:s'),
        ], 'id = :id', ['id' => $user['id']]);

        return true;
    }

    public static function check(): bool
    {
        return isset($_SESSION['admin_user']['id']);
    }

    public static function user(): ?array
    {
        return $_SESSION['admin_user'] ?? null;
    }

    public static function id(): ?int
    {
        return isset($_SESSION['admin_user']['id']) ? (int) $_SESSION['admin_user']['id'] : null;
    }

    public static function role(): ?string
    {
        return $_SESSION['admin_user']['role'] ?? null;
    }

    public static function canEdit(): bool
    {
        return in_array(self::role(), ['superadmin', 'editor'], true);
    }

    public static function logout(): void
    {
        unset($_SESSION['admin_user']);
        session_regenerate_id(true);
    }

    public static function requireLogin(): void
    {
        if (!self::check()) {
            flash('error', 'Veuillez vous connecter.');
            redirect('admin/login');
        }
    }

    public static function requireEdit(): void
    {
        self::requireLogin();
        if (!self::canEdit()) {
            http_response_code(403);
            exit('Accès refusé.');
        }
    }

    private static function tooManyAttempts(string $email): bool
    {
        $limit = (int) config('rate_limit.login_attempts', 5);
        $window = (int) config('rate_limit.login_window_minutes', 15);
        $since = date('Y-m-d H:i:s', time() - ($window * 60));
        $count = Database::count(
            'login_attempts',
            'ip_address = ? AND attempted_at >= ?',
            [client_ip(), $since]
        );
        return $count >= $limit;
    }

    private static function recordAttempt(string $email): void
    {
        try {
            Database::insert('login_attempts', [
                'ip_address' => client_ip(),
                'email' => $email,
                'attempted_at' => date('Y-m-d H:i:s'),
            ]);
        } catch (Throwable $e) {
            // silencieux
        }
    }
}
