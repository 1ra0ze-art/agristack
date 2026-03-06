<?php
// ============================================================
// AgriStack — UserModel
// ============================================================
class UserModel {
    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function findByEmail(string $email): ?array {
        return $this->db->fetchOne(
            "SELECT * FROM users WHERE email = ? LIMIT 1",
            's', [$email]
        );
    }

    public function findById(int $id): ?array {
        return $this->db->fetchOne(
            "SELECT id, name, email, phone, role, sector, is_active, created_at FROM users WHERE id = ?",
            'i', [$id]
        );
    }

    public function create(string $name, string $email, string $password, string $phone, string $role, string $sector): int {
        $this->db->execute(
            "INSERT INTO users (name, email, password, phone, role, sector) VALUES (?,?,?,?,?,?)",
            'ssssss', [$name, $email, $password, $phone, $role, $sector]
        );
        return $this->db->lastInsertId();
    }

    public function getAll(): array {
        return $this->db->fetchAll(
            "SELECT id, name, email, role, sector, is_active, created_at FROM users ORDER BY created_at DESC"
        );
    }

    public function toggleActive(int $id): void {
        $this->db->execute(
            "UPDATE users SET is_active = NOT is_active WHERE id = ? AND role != 'admin'",
            'i', [$id]
        );
    }
}
