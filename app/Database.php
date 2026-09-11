<?php

declare(strict_types=1);

class Database
{
    private static ?PDO $pdo = null;

    public static function connect(array $config): void
    {
        if (self::$pdo) {
            return;
        }
        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
            $config['host'],
            $config['port'],
            $config['database']
        );
        self::$pdo = new PDO($dsn, $config['username'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci",
        ]);
        self::$pdo->exec("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
    }

    public static function pdo(): PDO
    {
        if (!self::$pdo) {
            throw new RuntimeException('Base de données non connectée.');
        }
        return self::$pdo;
    }

    public static function query(string $sql, array $params = []): PDOStatement
    {
        $stmt = self::pdo()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public static function fetch(string $sql, array $params = []): ?array
    {
        $row = self::query($sql, $params)->fetch();
        return $row ?: null;
    }

    public static function fetchAll(string $sql, array $params = []): array
    {
        return self::query($sql, $params)->fetchAll();
    }

    public static function insert(string $table, array $data): int
    {
        $cols = array_keys($data);
        $fields = implode(', ', array_map(fn($c) => "`$c`", $cols));
        $placeholders = implode(', ', array_map(fn($c) => ':' . $c, $cols));
        self::query("INSERT INTO `$table` ($fields) VALUES ($placeholders)", $data);
        return (int) self::pdo()->lastInsertId();
    }

    public static function update(string $table, array $data, string $where, array $whereParams = []): int
    {
        $sets = [];
        foreach (array_keys($data) as $col) {
            $sets[] = "`$col` = :$col";
        }
        $sql = "UPDATE `$table` SET " . implode(', ', $sets) . " WHERE $where";
        $stmt = self::query($sql, array_merge($data, $whereParams));
        return $stmt->rowCount();
    }

    public static function delete(string $table, string $where, array $params = []): int
    {
        return self::query("DELETE FROM `$table` WHERE $where", $params)->rowCount();
    }

    public static function count(string $table, string $where = '1=1', array $params = []): int
    {
        $row = self::fetch("SELECT COUNT(*) AS c FROM `$table` WHERE $where", $params);
        return (int) ($row['c'] ?? 0);
    }
}
