<?php
// ============================================================
// AgriStack — Database Class (Singleton)
// Uses MySQLi with prepared statements
// ============================================================
class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }
        $this->conn->set_charset("utf8mb4");
    }

    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection(): mysqli {
        return $this->conn;
    }

    // Execute a prepared statement — returns result or bool
    public function query(string $sql, string $types = '', array $params = []): mysqli_result|bool {
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error . " SQL: $sql");
        }
        if ($types && $params) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result !== false ? $result : true;
    }

    // Execute and return all rows as associative arrays
    public function fetchAll(string $sql, string $types = '', array $params = []): array {
        $result = $this->query($sql, $types, $params);
        if ($result instanceof mysqli_result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    // Execute and return single row
    public function fetchOne(string $sql, string $types = '', array $params = []): ?array {
        $result = $this->query($sql, $types, $params);
        if ($result instanceof mysqli_result) {
            $row = $result->fetch_assoc();
            return $row ?: null;
        }
        return null;
    }

    // Execute INSERT/UPDATE/DELETE — returns affected rows
    public function execute(string $sql, string $types = '', array $params = []): int {
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error . " SQL: $sql");
        }
        if ($types && $params) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $affected = $stmt->affected_rows;
        $stmt->close();
        return $affected;
    }

    // Returns last inserted ID
    public function lastInsertId(): int {
        return $this->conn->insert_id;
    }
}
