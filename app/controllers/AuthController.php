<?php
// ============================================================
// AgriStack — AuthController
// ============================================================
require_once __DIR__ . '/../models/UserModel.php';

class AuthController {
    private UserModel $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function index(): void {
        if (isLoggedIn()) {
            $this->redirectByRole($_SESSION['user_role']);
        }
        redirect('/login');
    }

    public function loginForm(): void {
        if (isLoggedIn()) {
            $this->redirectByRole($_SESSION['user_role']);
        }
        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function login(): void {
        $email    = sanitize($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (!$email || !$password) {
            setFlash('error', 'Please enter email and password.');
            redirect('/login');
        }

        $user = $this->userModel->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            setFlash('error', 'Invalid email or password.');
            redirect('/login');
        }

        if (!$user['is_active']) {
            setFlash('error', 'Your account has been deactivated. Contact admin.');
            redirect('/login');
        }

        $_SESSION['user_id']   = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];

        $this->redirectByRole($user['role']);
    }

    public function registerForm(): void {
        if (isLoggedIn()) $this->redirectByRole($_SESSION['user_role']);
        require_once __DIR__ . '/../views/auth/register.php';
    }

    public function register(): void {
        $name     = sanitize($_POST['name'] ?? '');
        $email    = sanitize($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm  = $_POST['confirm_password'] ?? '';
        $phone    = sanitize($_POST['phone'] ?? '');
        $role     = sanitize($_POST['role'] ?? 'farmer');
        $sector   = sanitize($_POST['sector'] ?? '');

        $errors = [];
        if (strlen($name) < 2)            $errors[] = 'Name must be at least 2 characters.';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email address.';
        if (strlen($password) < 6)        $errors[] = 'Password must be at least 6 characters.';
        if ($password !== $confirm)       $errors[] = 'Passwords do not match.';
        if (!in_array($role, ['farmer','buyer'])) $errors[] = 'Invalid role selected.';

        if ($this->userModel->findByEmail($email)) {
            $errors[] = 'Email already registered.';
        }

        if ($errors) {
            setFlash('error', implode(' ', $errors));
            redirect('/register');
        }

        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $this->userModel->create($name, $email, $hashed, $phone, $role, $sector);

        setFlash('success', 'Account created! Please log in.');
        redirect('/login');
    }

    public function logout(): void {
        session_destroy();
        redirect('/login');
    }

    private function redirectByRole(string $role): never {
        match($role) {
            'admin'  => redirect('/admin/dashboard'),
            'farmer' => redirect('/farmer/dashboard'),
            'buyer'  => redirect('/buyer/dashboard'),
            default  => redirect('/login'),
        };
    }
}
