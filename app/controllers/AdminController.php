<?php
// ============================================================
// AgriStack — AdminController
// ============================================================
require_once __DIR__ . '/../models/ListingModel.php';
require_once __DIR__ . '/../models/BookingModel.php';
require_once __DIR__ . '/../models/UserModel.php';

class AdminController {
    private ListingModel $listingModel;
    private BookingModel $bookingModel;
    private UserModel    $userModel;

    public function __construct() {
        requireRole('admin');
        $this->listingModel = new ListingModel();
        $this->bookingModel = new BookingModel();
        $this->userModel    = new UserModel();
    }

    public function dashboard(): void {
        $todayListings  = $this->listingModel->getTodayCount();
        $totalBooked    = $this->bookingModel->getTotalBookedValue();
        $topSectors     = $this->listingModel->getTopSectors(3);
        $pendingListings= $this->listingModel->getAll('pending');
        $recentAudit    = Database::getInstance()->fetchAll(
            "SELECT * FROM audit_log ORDER BY created_at DESC LIMIT 10"
        );
        $allUsers       = $this->userModel->getAll();
        $activeUsers    = count(array_filter($allUsers, fn($u) => $u['is_active']));

        require_once __DIR__ . '/../views/admin/dashboard.php';
    }

    public function listings(): void {
        $filter   = sanitize($_GET['status'] ?? '');
        $listings = $this->listingModel->getAll($filter);
        require_once __DIR__ . '/../views/admin/listings.php';
    }

    public function approveListing(): void {
        $id   = (int)($_GET['id'] ?? 0);
        $user = currentUser();
        $this->listingModel->updateStatus($id, 'approved');
        logAction($user['id'], $user['name'], "Approved listing #$id", 'listing', $id);
        setFlash('success', "Listing #$id approved.");
        redirect('/admin/listings');
    }

    public function rejectListing(): void {
        $id   = (int)($_GET['id'] ?? 0);
        $user = currentUser();
        $this->listingModel->updateStatus($id, 'rejected');
        logAction($user['id'], $user['name'], "Rejected listing #$id", 'listing', $id);
        setFlash('success', "Listing #$id rejected.");
        redirect('/admin/listings');
    }

    public function bookings(): void {
        $bookings = $this->bookingModel->getAll();
        require_once __DIR__ . '/../views/admin/bookings.php';
    }

    public function advanceBooking(): void {
        $id      = (int)($_GET['id'] ?? 0);
        $user    = currentUser();
        $booking = $this->bookingModel->getById($id);
        $this->bookingModel->advanceStatus($id);

        $next = match($booking['status'] ?? '') {
            'pending'  => 'Approved',
            'approved' => 'Collected',
            default    => 'Updated',
        };

        logAction($user['id'], $user['name'], "Advanced booking #$id to $next", 'booking', $id);
        setFlash('success', "Booking #$id marked as $next.");
        redirect('/admin/bookings');
    }

    public function users(): void {
        $users = $this->userModel->getAll();
        require_once __DIR__ . '/../views/admin/users.php';
    }

    public function toggleUser(): void {
        $id   = (int)($_GET['id'] ?? 0);
        $user = currentUser();
        $this->userModel->toggleActive($id);
        logAction($user['id'], $user['name'], "Toggled active status for user #$id", 'user', $id);
        setFlash('success', 'User status updated.');
        redirect('/admin/users');
    }

    public function auditLog(): void {
        $logs = Database::getInstance()->fetchAll(
            "SELECT * FROM audit_log ORDER BY created_at DESC LIMIT 200"
        );
        require_once __DIR__ . '/../views/admin/audit-log.php';
    }
}
