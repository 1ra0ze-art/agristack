<?php

class ListingModel {
    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll(string $status = ''): array {
        if ($status) {
            return $this->db->fetchAll(
                "SELECT l.*, u.name as farmer_name, u.sector as farmer_sector
                 FROM listings l JOIN users u ON l.farmer_id = u.id
                 WHERE l.status = ? ORDER BY l.created_at DESC",
                's', [$status]
            );
        }
        return $this->db->fetchAll(
            "SELECT l.*, u.name as farmer_name, u.sector as farmer_sector
             FROM listings l JOIN users u ON l.farmer_id = u.id
             ORDER BY l.created_at DESC"
        );
    }

    public function getByFarmer(int $farmerId): array {
        return $this->db->fetchAll(
            "SELECT * FROM listings WHERE farmer_id = ? ORDER BY created_at DESC",
            'i', [$farmerId]
        );
    }

    public function getById(int $id): ?array {
        return $this->db->fetchOne(
            "SELECT l.*, u.name as farmer_name, u.phone as farmer_phone, u.sector as farmer_sector
             FROM listings l JOIN users u ON l.farmer_id = u.id
             WHERE l.id = ?",
            'i', [$id]
        );
    }

    public function create(int $farmerId, string $title, float $qty, float $price, string $sector, string $date, string $desc): int {
        $this->db->execute(
            "INSERT INTO listings (farmer_id, title, quantity_kg, price_per_kg, pickup_sector, harvest_date, description)
             VALUES (?,?,?,?,?,?,?)",
            'isddsss', [$farmerId, $title, $qty, $price, $sector, $date, $desc]
        );
        return $this->db->lastInsertId();
    }

    public function update(int $id, string $title, float $qty, float $price, string $sector, string $date, string $desc): void {
        $this->db->execute(
            "UPDATE listings SET title=?, quantity_kg=?, price_per_kg=?, pickup_sector=?, harvest_date=?, description=?
             WHERE id=? AND status='pending'",
            'sddsssi', [$title, $qty, $price, $sector, $date, $desc, $id]
        );
    }

    public function delete(int $id, int $farmerId): void {
        $this->db->execute(
            "DELETE FROM listings WHERE id=? AND farmer_id=? AND status='pending'",
            'ii', [$id, $farmerId]
        );
    }

    public function updateStatus(int $id, string $status): void {
        $this->db->execute(
            "UPDATE listings SET status=? WHERE id=?",
            'si', [$status, $id]
        );
    }

    public function getTodayCount(): int {
        $row = $this->db->fetchOne(
            "SELECT COUNT(*) as cnt FROM listings WHERE DATE(created_at) = CURDATE()"
        );
        return (int)($row['cnt'] ?? 0);
    }

    public function getTopSectors(int $limit = 3): array {
        return $this->db->fetchAll(
            "SELECT pickup_sector, SUM(quantity_kg) as total_qty, COUNT(*) as listing_count
             FROM listings WHERE status='approved'
             GROUP BY pickup_sector ORDER BY total_qty DESC LIMIT ?",
            'i', [$limit]
        );
    }

    public function getApprovedWithFilters(string $sector = '', float $minQty = 0, float $maxPrice = 0): array {
        $sql    = "SELECT l.*, u.name as farmer_name FROM listings l JOIN users u ON l.farmer_id = u.id WHERE l.status='approved'";
        $types  = '';
        $params = [];

        if ($sector)   { $sql .= " AND l.pickup_sector = ?"; $types .= 's'; $params[] = $sector; }
        if ($minQty)   { $sql .= " AND l.quantity_kg >= ?";  $types .= 'd'; $params[] = $minQty; }
        if ($maxPrice) { $sql .= " AND l.price_per_kg <= ?"; $types .= 'd'; $params[] = $maxPrice; }

        $sql .= " ORDER BY l.created_at DESC";
        return $this->db->fetchAll($sql, $types, $params);
    }

    public function getSectors(): array {
        return $this->db->fetchAll(
            "SELECT DISTINCT pickup_sector FROM listings WHERE status='approved' ORDER BY pickup_sector"
        );
    }
}
