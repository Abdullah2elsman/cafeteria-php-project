<?php

class Users extends Controller {
    private $orderModel;
    private $userModel;

    public function __construct() {
        if (!isLoggedIn()) {
            flash('session_expired', 'Please log in to access this page', 'alert alert-error');
            header('location: ' . URL_ROOT . '/auth/login');
            exit;
        }

        if ($_SESSION['user_role'] == 'admin') {
            header('location: ' . URL_ROOT . '/admin/dashboard');
            exit;
        }

        $this->orderModel = $this->model('Order');
        $this->userModel = $this->model('User');
    }

    public function dashboard() {
        $userId = $_SESSION['user_id'];
        $user = $this->userModel->getUserById($userId);

        $data = [
            'title' => 'My Dashboard | Sip & Savor',
            'css_file' => 'dashboard.css',
            'user' => $user,
            'total_orders' => $this->orderModel->getUserOrderCount($userId),
            'total_spent' => $this->orderModel->getUserTotalSpent($userId),
            'favorites_count' => $this->orderModel->getUserFavoritesCount($userId),
            'recent_orders' => $this->orderModel->getRecentOrdersWithItems($userId, 5)
        ];
        $this->view('users/dashboard', $data);
    }

    public function orders() {
        $data = [
            'title' => 'My Orders | Sip & Savor',
            'css_file' => 'dashboard.css'
        ];
        $this->view('users/orders', $data);
    }

    public function favorites() {
        $data = [
            'title' => 'Favorites | Sip & Savor',
            'css_file' => 'dashboard.css'
        ];
        $this->view('users/favorites', $data);
    }

    public function history() {
        $data = [
            'title' => 'History | Sip & Savor',
            'css_file' => 'dashboard.css'
        ];
        $this->view('users/history', $data);
    }

    public function settings() {
        $data = [
            'title' => 'Settings | Sip & Savor',
            'css_file' => 'dashboard.css'
        ];
        $this->view('users/settings', $data);
    }
}
