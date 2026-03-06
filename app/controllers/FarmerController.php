<?php
// ============================================================
// AgriStack — FarmerController
// ============================================================
require_once __DIR__ . '/../models/ListingModel.php';
require_once __DIR__ . '/../models/BookingModel.php';

class FarmerController {
    private ListingModel $listingModel;
    private BookingModel $bookingModel;

    public function __construct() {
        requireRole('farmer');
        $this->listingModel = new ListingModel();
        $this->bookingModel = new BookingModel();
    }

    public function dashboard(): void {
        $user     = currentUser();
        $listings = $this->listingModel->getByFarmer($user['id']);
        $bookings = $this->bookingModel->getByFarmerListings($user['id']);

        $stats = [
            'total_listings'   => count($listings),
            'pending_listings' => count(array_filter($listings, fn($l) => $l['status'] === 'pending')),
            'approved_listings'=> count(array_filter($listings, fn($l) => $l['status'] === 'approved')),
            'total_bookings'   => count($bookings),
        ];

        require_once __DIR__ . '/../views/farmer/dashboard.php';
    }

    public function listings(): void {
        $user     = currentUser();
        $listings = $this->listingModel->getByFarmer($user['id']);
        require_once __DIR__ . '/../views/farmer/listings.php';
    }

    public function createForm(): void {
        require_once __DIR__ . '/../views/farmer/create-listing.php';
    }

    public function create(): void {
        $user    = currentUser();
        $title   = sanitize($_POST['title'] ?? 'Irish Potato Harvest');
        $qty     = (float)($_POST['quantity_kg'] ?? 0);
        $price   = (float)($_POST['price_per_kg'] ?? 0);
        $sector  = sanitize($_POST['pickup_sector'] ?? '');
        $date    = sanitize($_POST['harvest_date'] ?? '');
        $desc    = sanitize($_POST['description'] ?? '');

        if ($qty <= 0 || $price <= 0 || !$sector || !$date) {
            setFlash('error', 'Please fill in all required fields with valid values.');
            redirect('/farmer/listings/create');
        }

        $id = $this->listingModel->create($user['id'], $title, $qty, $price, $sector, $date, $desc);
        logAction($user['id'], $user['name'], "Created listing #$id ($title)", 'listing', $id);
        setFlash('success', 'Listing submitted for admin approval.');
        redirect('/farmer/listings');
    }

    public function editForm(): void {
        $id      = (int)($_GET['id'] ?? 0);
        $user    = currentUser();
        $listing = $this->listingModel->getById($id);

        if (!$listing || $listing['farmer_id'] != $user['id'] || $listing['status'] !== 'pending') {
            setFlash('error', 'Cannot edit this listing.');
            redirect('/farmer/listings');
        }

        require_once __DIR__ . '/../views/farmer/edit-listing.php';
    }

    public function edit(): void {
        $id      = (int)($_POST['id'] ?? 0);
        $user    = currentUser();
        $listing = $this->listingModel->getById($id);

        if (!$listing || $listing['farmer_id'] != $user['id'] || $listing['status'] !== 'pending') {
            setFlash('error', 'Cannot edit this listing.');
            redirect('/farmer/listings');
        }

        $title  = sanitize($_POST['title'] ?? '');
        $qty    = (float)($_POST['quantity_kg'] ?? 0);
        $price  = (float)($_POST['price_per_kg'] ?? 0);
        $sector = sanitize($_POST['pickup_sector'] ?? '');
        $date   = sanitize($_POST['harvest_date'] ?? '');
        $desc   = sanitize($_POST['description'] ?? '');

        $this->listingModel->update($id, $title, $qty, $price, $sector, $date, $desc);
        logAction($user['id'], $user['name'], "Updated listing #$id", 'listing', $id);
        setFlash('success', 'Listing updated successfully.');
        redirect('/farmer/listings');
    }

    public function delete(): void {
        $id   = (int)($_GET['id'] ?? 0);
        $user = currentUser();
        $this->listingModel->delete($id, $user['id']);
        logAction($user['id'], $user['name'], "Deleted listing #$id", 'listing', $id);
        setFlash('success', 'Listing deleted.');
        redirect('/farmer/listings');
    }

    public function bookings(): void {
        $user     = currentUser();
        $bookings = $this->bookingModel->getByFarmerListings($user['id']);
        require_once __DIR__ . '/../views/farmer/bookings.php';
    }
}
