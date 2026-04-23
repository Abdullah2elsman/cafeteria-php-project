<?php
class Admin extends Controller {
    private $userModel;
    private $productModel;
    private $orderModel;

    public function __construct() {
        // Enforce Admin Access
        if (!isLoggedIn() || $_SESSION['user_role'] != 'admin') {
            header('location: ' . URL_ROOT . '/auth/login');
            exit;
        }

        // Load models
        $this->userModel = $this->model('User');
        $this->productModel = $this->model('Product');
        $this->orderModel = $this->model('Order');
    }

    public function index() {
        $this->dashboard();
    }

    public function dashboard() {
        $users = [];
        if (method_exists($this->userModel, 'getAllUsers')) {
            $users = $this->userModel->getAllUsers();
        }

        $products = [];
        if (method_exists($this->productModel, 'getProducts')) {
            $products = $this->productModel->getProducts();
        }

        // Fetch metrics
        $data = [
            'total_users' => count($users),
            'total_products' => count($products),
            'total_orders' => 0, // Needs all-orders model method if created later
            'total_revenue' => 0, // Needs revenue tracking model method
            'recent_orders' => [] // Needs a getSystemRecentOrders if created
        ];

        $this->view('admin/dashboard', $data);
    }

    public function users() {
        $users = [];
        if (method_exists($this->userModel, 'getAllUsers')) {
            $users = $this->userModel->getAllUsers();
        }

        $data = [
            'users' => $users
        ];

        $this->view('admin/users/index', $data);
    }

    public function prducts() {
        header('Location: ' . URL_ROOT . '/products');
        exit;
    }

    public function checks() {
        header('Location: ' . URL_ROOT . '/checks');
        exit;
    }
}
