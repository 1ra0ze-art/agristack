-- ============================================================
-- AgriStack Irish Potato Marketplace — Database Schema
-- Version: 1.0
-- ============================================================

CREATE DATABASE IF NOT EXISTS agristack CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE agristack;

-- ============================================================
-- USERS TABLE
-- ============================================================
CREATE TABLE users (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(150) NOT NULL,
    email       VARCHAR(150) NOT NULL UNIQUE,
    password    VARCHAR(255) NOT NULL,
    phone       VARCHAR(20),
    role        ENUM('farmer','buyer','admin') NOT NULL DEFAULT 'farmer',
    sector      VARCHAR(100),
    is_active   TINYINT(1) NOT NULL DEFAULT 1,
    created_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- HARVEST LISTINGS TABLE
-- ============================================================
CREATE TABLE listings (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    farmer_id       INT NOT NULL,
    title           VARCHAR(200) NOT NULL DEFAULT 'Irish Potato Harvest',
    quantity_kg     DECIMAL(10,2) NOT NULL,
    price_per_kg    DECIMAL(10,2) NOT NULL,
    pickup_sector   VARCHAR(100) NOT NULL,
    harvest_date    DATE NOT NULL,
    description     TEXT,
    status          ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending',
    created_at      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      DATETIME ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (farmer_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================================
-- BOOKINGS TABLE
-- ============================================================
CREATE TABLE bookings (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    listing_id      INT NOT NULL,
    buyer_id        INT NOT NULL,
    quantity_kg     DECIMAL(10,2) NOT NULL,
    price_per_kg    DECIMAL(10,2) NOT NULL,
    total_value     DECIMAL(12,2) GENERATED ALWAYS AS (quantity_kg * price_per_kg) STORED,
    preferred_date  DATE NOT NULL,
    notes           TEXT,
    status          ENUM('pending','approved','collected') NOT NULL DEFAULT 'pending',
    created_at      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      DATETIME ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (listing_id) REFERENCES listings(id) ON DELETE CASCADE,
    FOREIGN KEY (buyer_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================================
-- AUDIT LOG TABLE
-- ============================================================
CREATE TABLE audit_log (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    user_id     INT,
    user_name   VARCHAR(150),
    action      VARCHAR(255) NOT NULL,
    target_type VARCHAR(50),
    target_id   INT,
    created_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ============================================================
-- INDEXES FOR PERFORMANCE
-- ============================================================
CREATE INDEX idx_listings_status ON listings(status);
CREATE INDEX idx_listings_sector ON listings(pickup_sector);
CREATE INDEX idx_listings_farmer ON listings(farmer_id);
CREATE INDEX idx_listings_created ON listings(created_at);
CREATE INDEX idx_bookings_buyer ON bookings(buyer_id);
CREATE INDEX idx_bookings_listing ON bookings(listing_id);
CREATE INDEX idx_bookings_status ON bookings(status);
CREATE INDEX idx_audit_created ON audit_log(created_at);

-- ============================================================
-- SEED DATA — Default Admin + Test Users
-- ============================================================

-- Admin password: Admin@1234
INSERT INTO users (name, email, password, phone, role, sector) VALUES
('AgriStack Admin', 'admin@agristack.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+250788000001', 'admin', 'Musanze');

-- Farmer password: Farmer@1234
INSERT INTO users (name, email, password, phone, role, sector) VALUES
('Jean Damascène Nsengimana', 'farmer@agristack.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+250788000002', 'farmer', 'Kinigi'),
('Marie Claire Mukamana', 'farmer2@agristack.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+250788000003', 'farmer', 'Musanze');

-- Buyer password: Buyer@1234
INSERT INTO users (name, email, password, phone, role, sector) VALUES
('Kigali Fresh Markets Ltd', 'buyer@agristack.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+250788000004', 'buyer', 'Kigali'),
('Rwanda Export Hub', 'buyer2@agristack.rw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+250788000005', 'buyer', 'Kigali');

-- Sample approved listings
INSERT INTO listings (farmer_id, title, quantity_kg, price_per_kg, pickup_sector, harvest_date, description, status) VALUES
(2, 'Irish Potato Harvest - Kinigi Coop', 800.00, 250.00, 'Kinigi', '2024-12-01', 'Grade A Irish potatoes, freshly harvested, cleaned and sorted.', 'approved'),
(2, 'Bulk Irish Potato - November', 500.00, 230.00, 'Kinigi', '2024-11-28', 'Ready for bulk pickup, cooperative certified.', 'approved'),
(3, 'Irish Potato - Musanze Sector', 1200.00, 210.00, 'Musanze', '2024-12-05', 'Large batch available for immediate booking.', 'approved'),
(2, 'Small Lot - Irish Potato', 200.00, 270.00, 'Kinigi', '2024-12-10', 'Premium small lot, ideal for supermarkets.', 'pending'),
(3, 'Winter Harvest Batch', 650.00, 220.00, 'Shingiro', '2024-12-15', 'Shingiro sector harvest, clean, no pesticides.', 'pending');

-- Sample bookings
INSERT INTO bookings (listing_id, buyer_id, quantity_kg, price_per_kg, preferred_date, notes, status) VALUES
(1, 4, 300.00, 250.00, '2024-12-02', 'Please arrange loading by 8AM', 'approved'),
(2, 4, 200.00, 230.00, '2024-11-29', 'Need invoice for accounts', 'pending'),
(3, 5, 500.00, 210.00, '2024-12-06', 'Export order, requires phytosanitary certificate', 'collected');

-- Sample audit logs
INSERT INTO audit_log (user_id, user_name, action, target_type, target_id) VALUES
(1, 'AgriStack Admin', 'Approved listing #1 (Irish Potato - Kinigi Coop)', 'listing', 1),
(1, 'AgriStack Admin', 'Approved listing #2 (Bulk Irish Potato)', 'listing', 2),
(1, 'AgriStack Admin', 'Approved listing #3 (Musanze Sector)', 'listing', 3),
(1, 'AgriStack Admin', 'Advanced booking #1 to Approved', 'booking', 1),
(1, 'AgriStack Admin', 'Advanced booking #3 to Collected', 'booking', 3);
