<?php
// ============================================================
// AgriStack — BuyerController
// ============================================================
require_once __DIR__ . '/../models/ListingModel.php';
require_once __DIR__ . '/../models/BookingModel.php';

class BuyerController {
    private ListingModel $listingModel;
    private BookingModel $bookingModel;

    public function __construct() {
        requireRole('buyer');
        $this->listingModel = new ListingModel();
        $this->bookingModel = new BookingModel();
    }

    public function dashboard(): void {
        $user  = currentUser();
        $stats = $this->bookingModel->getStatsByBuyer($user['id']);
        require_once __DIR__ . '/../views/buyer/dashboard.php';
    }

    public function listings(): void {
        $sector   = sanitize($_GET['sector']    ?? '');
        $minQty   = (float)($_GET['min_qty']    ?? 0);
        $maxPrice = (float)($_GET['max_price']  ?? 0);

        $listings = $this->listingModel->getApprovedWithFilters($sector, $minQty, $maxPrice);
        $sectors  = $this->listingModel->getSectors();

        require_once __DIR__ . '/../views/buyer/listings.php';
    }

    public function bookForm(): void {
        $listingId = (int)($_GET['id'] ?? 0);
        $listing   = $this->listingModel->getById($listingId);

        if (!$listing || $listing['status'] !== 'approved') {
            setFlash('error', 'Listing not available for booking.');
            redirect('/buyer/listings');
        }

        require_once __DIR__ . '/../views/buyer/book.php';
    }

    public function book(): void {
        $user      = currentUser();
        $listingId = (int)($_POST['listing_id'] ?? 0);
        $qty       = (float)($_POST['quantity_kg'] ?? 0);
        $date      = sanitize($_POST['preferred_date'] ?? '');
        $notes     = sanitize($_POST['notes'] ?? '');

        $listing = $this->listingModel->getById($listingId);

        if (!$listing || $listing['status'] !== 'approved') {
            setFlash('error', 'Invalid listing.');
            redirect('/buyer/listings');
        }

        if ($qty <= 0 || $qty > $listing['quantity_kg']) {
            setFlash('error', "Quantity must be between 1 and {$listing['quantity_kg']} kg.");
            redirect('/buyer/book?id=' . $listingId);
        }

        if (!$date) {
            setFlash('error', 'Please select a preferred pickup date.');
            redirect('/buyer/book?id=' . $listingId);
        }

        $id = $this->bookingModel->create($listingId, $user['id'], $qty, $listing['price_per_kg'], $date, $notes);
        logAction($user['id'], $user['name'], "Placed booking #$id for listing #$listingId ({$listing['title']})", 'booking', $id);
        setFlash('success', 'Booking request submitted! Admin will review and confirm.');
        redirect('/buyer/bookings');
    }

    public function bookings(): void {
        $user     = currentUser();
        $bookings = $this->bookingModel->getByBuyer($user['id']);
        require_once __DIR__ . '/../views/buyer/bookings.php';
    }
}
