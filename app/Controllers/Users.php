<?php

class Users extends Controller {
    public function __construct() {
        if (!isLoggedIn()) {
            flash('session_expired', 'Please log in to access this page', 'alert alert-error');
            header('location: ' . URL_ROOT . '/auth/login');
            exit;
        }

        if ($_SESSION['user_role'] == 'admin') {
            // Admin shouldn't access user dashboards/pages right now
            header('location: ' . URL_ROOT . '/admin/dashboard');
            exit;
        }
    }

    public function dashboard() {
        $data = [
            'title' => 'My Dashboard | Sip & Savor',
            'css_file' => 'dashboard.css'
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
