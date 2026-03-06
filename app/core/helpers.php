<?php
// ============================================================
// AgriStack — Auth & Session Helper
// ============================================================

function startSession(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function isLoggedIn(): bool {
    startSession();
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function requireLogin(): void {
    if (!isLoggedIn()) {
        redirect('/login');
    }
}

function requireRole(string ...$roles): void {
    requireLogin();
    if (!in_array($_SESSION['user_role'] ?? '', $roles)) {
        redirect('/login');
    }
}

function currentUser(): array {
    return [
        'id'   => $_SESSION['user_id'] ?? null,
        'name' => $_SESSION['user_name'] ?? '',
        'role' => $_SESSION['user_role'] ?? '',
    ];
}

function setFlash(string $type, string $message): void {
    startSession();
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function getFlash(): ?array {
    startSession();
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

function redirect(string $path): never {
    header("Location: " . BASE_URL . $path);
    exit;
}

function e(mixed $val): string {
    return htmlspecialchars((string)$val, ENT_QUOTES, 'UTF-8');
}

function sanitize(string $input): string {
    return trim(strip_tags($input));
}

function formatRwf(float $amount): string {
    return number_format($amount, 0, '.', ',') . ' RWF';
}

function timeAgo(string $datetime): string {
    $now  = new DateTime();
    $then = new DateTime($datetime);
    $diff = $now->diff($then);
    if ($diff->days > 0)  return $diff->days . 'd ago';
    if ($diff->h > 0)     return $diff->h . 'h ago';
    if ($diff->i > 0)     return $diff->i . 'm ago';
    return 'just now';
}

function statusBadge(string $status): string {
    $map = [
        'pending'  => ['#FEF3C7', '#92400E'],
        'approved' => ['#D1FAE5', '#065F46'],
        'collected'=> ['#DBEAFE', '#1E40AF'],
        'rejected' => ['#FEE2E2', '#991B1B'],
    ];
    [$bg, $fg] = $map[$status] ?? ['#F3F4F6', '#374151'];
    $label = ucfirst($status);
    return "<span class='badge' style='background:$bg;color:$fg'>$label</span>";
}

function logAction(int $userId, string $userName, string $action, string $targetType = '', int $targetId = 0): void {
    $db = Database::getInstance();
    $db->execute(
        "INSERT INTO audit_log (user_id, user_name, action, target_type, target_id) VALUES (?,?,?,?,?)",
        'isssi',
        [$userId, $userName, $action, $targetType, $targetId]
    );
}
