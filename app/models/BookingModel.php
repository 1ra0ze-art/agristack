<?php

class BookingModel {
    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function create(int $listingId, int $buyerId, float $qty, float $price, string $date, string $notes): int {
        $this->db->execute(
            "INSERT INTO bookings (listing_id, buyer_id, quantity_kg, price_per_kg, preferred_date, notes)
             VALUES (?,?,?,?,?,?)",
            'iiddss', [$listingId, $buyerId, $qty, $price, $date, $notes]
        );
        return $this->db->lastInsertId();
    }

    public function getAll(): array {
        return $this->db->fetchAll(
            "SELECT b.*, l.title as listing_title, l.pickup_sector,
                    u.name as buyer_name, f.name as farmer_name
             FROM bookings b
             JOIN listings l ON b.listing_id = l.id
             JOIN users u ON b.buyer_id = u.id
             JOIN users f ON l.farmer_id = f.id
             ORDER BY b.created_at DESC"
        );
    }

    public function getByBuyer(int $buyerId): array {
        return $this->db->fetchAll(
            "SELECT b.*, l.title as listing_title, l.pickup_sector, u.name as farmer_name
             FROM bookings b
             JOIN listings l ON b.listing_id = l.id
             JOIN users u ON l.farmer_id = u.id
             WHERE b.buyer_id = ?
             ORDER BY b.created_at DESC",
            'i', [$buyerId]
        );
    }

    public function getByListing(int $listingId): array {
        return $this->db->fetchAll(
            "SELECT b.*, u.name as buyer_name
             FROM bookings b JOIN users u ON b.buyer_id = u.id
             WHERE b.listing_id = ? ORDER BY b.created_at DESC",
            'i', [$listingId]
        );
    }

    public function getById(int $id): ?array {
        return $this->db->fetchOne(
            "SELECT b.*, l.title as listing_title FROM bookings b JOIN listings l ON b.listing_id = l.id WHERE b.id = ?",
            'i', [$id]
        );
    }

    public function advanceStatus(int $id): void {
        $booking = $this->getById($id);
        if (!$booking) return;

        $next = match($booking['status']) {
            'pending'  => 'approved',
            'approved' => 'collected',
            default    => null,
        };

        if ($next) {
            $this->db->execute(
                "UPDATE bookings SET status=? WHERE id=?",
                'si', [$next, $id]
            );
        }
    }

    public function getTotalBookedValue(): float {
        $row = $this->db->fetchOne(
            "SELECT COALESCE(SUM(total_value), 0) as total FROM bookings WHERE status != 'pending'"
        );
        return (float)($row['total'] ?? 0);
    }

    public function getStatsByBuyer(int $buyerId): array {
        return $this->db->fetchOne(
            "SELECT COUNT(*) as total,
                    COALESCE(SUM(total_value), 0) as total_value,
                    SUM(status='pending') as pending_count,
                    SUM(status='approved') as approved_count,
                    SUM(status='collected') as collected_count
             FROM bookings WHERE buyer_id = ?",
            'i', [$buyerId]
        ) ?? [];
    }

    public function getByFarmerListings(int $farmerId): array {
        return $this->db->fetchAll(
            "SELECT b.*, l.title as listing_title, l.pickup_sector, u.name as buyer_name, u.phone as buyer_phone
             FROM bookings b
             JOIN listings l ON b.listing_id = l.id
             JOIN users u ON b.buyer_id = u.id
             WHERE l.farmer_id = ?
             ORDER BY b.created_at DESC",
            'i', [$farmerId]
        );
    }
}
