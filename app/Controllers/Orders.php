<?php

class Orders extends Controller {
    private $orderModel;

    public function __construct() {
        if (!isLoggedIn()) {
            flash('session_expired', 'Please log in to access this page', 'alert alert-error');
            header('location: ' . URL_ROOT . '/auth/login');
            exit;
        }

        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
            header('location: ' . URL_ROOT . '/admin/dashboard');
            exit;
        }

        $this->orderModel = $this->model('Order');
    }

    public function index($params = []) {
        $dateFrom = isset($_GET['date_from']) ? trim($_GET['date_from']) : '';
        $dateTo = isset($_GET['date_to']) ? trim($_GET['date_to']) : '';
        $orders = $this->orderModel->getOrdersWithItemsByUser((int)$_SESSION['user_id'], $dateFrom, $dateTo);

        foreach ($orders as &$order) {
            $order['status_meta'] = $this->statusMeta($order['status']);
        }
        unset($order);

        $data = [
            'title' => 'My Orders | Sip & Savor',
            'css_file' => 'dashboard.css',
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
            'orders' => $orders
        ];

        $this->view('orders/index', $data);
    }

    public function create($params = []) {
        $data = [
            'title' => 'Create Order | Sip & Savor',
            'css_file' => 'dashboard.css',
            'products' => $this->orderModel->getAvailableProducts(),
            'rooms' => ['Room 1', 'Room 2', 'Room 3', 'Room 4', 'Room 5', 'Room 6', 'Room 7', 'Room 8', 'Room 9', 'Room 10']
        ];

        $this->view('orders/create', $data);
    }

    public function store($params = []) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('location: ' . URL_ROOT . '/orders/create');
            exit;
        }

        $room = isset($_POST['room']) ? trim($_POST['room']) : '';
        $notes = isset($_POST['notes']) ? trim($_POST['notes']) : '';
        $quantities = isset($_POST['quantities']) && is_array($_POST['quantities']) ? $_POST['quantities'] : [];

        if ($room === '') {
            flash('order_message', 'Please select a delivery room.', 'alert alert-error');
            header('location: ' . URL_ROOT . '/orders/create');
            exit;
        }

        $items = [];
        foreach ($quantities as $productId => $quantity) {
            $productId = (int)$productId;
            $quantity = (int)$quantity;

            if ($productId > 0 && $quantity > 0) {
                $items[] = [
                    'product_id' => $productId,
                    'quantity' => $quantity
                ];
            }
        }

        if (empty($items)) {
            flash('order_message', 'Please add at least one product to your order.', 'alert alert-error');
            header('location: ' . URL_ROOT . '/orders/create');
            exit;
        }

        $orderId = $this->orderModel->createOrderWithItems((int)$_SESSION['user_id'], $room, $notes, $items);

        if ($orderId) {
            unset($_SESSION['order_cart']);
            flash('order_message', 'Order #' . $orderId . ' has been confirmed successfully.');
            header('location: ' . URL_ROOT . '/orders');
            exit;
        }

        flash('order_message', 'Something went wrong while confirming your order.', 'alert alert-error');
        header('location: ' . URL_ROOT . '/orders/create');
        exit;
    }

    public function cancel($params = []) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('location: ' . URL_ROOT . '/orders');
            exit;
        }

        $orderId = isset($params[0]) ? (int)$params[0] : 0;
        if ($orderId < 1) {
            flash('order_message', 'Invalid order.', 'alert alert-error');
            header('location: ' . URL_ROOT . '/orders');
            exit;
        }

        $cancelled = $this->orderModel->cancelPendingOrder($orderId, (int)$_SESSION['user_id']);

        if ($cancelled) {
            flash('order_message', 'Order has been cancelled successfully.');
        } else {
            flash('order_message', 'Only pending orders can be cancelled.', 'alert alert-error');
        }

        header('location: ' . URL_ROOT . '/orders');
        exit;
    }

    private function statusMeta($status) {
        $normalized = strtolower((string)$status);

        switch ($normalized) {
            case 'processing':
                return ['label' => 'Processing', 'class' => 'status-processing'];
            case 'out_for_delivery':
                return ['label' => 'Out for delivery', 'class' => 'status-out-for-delivery'];
            case 'done':
                return ['label' => 'Done', 'class' => 'status-done'];
            case 'completed':
                return ['label' => 'Done', 'class' => 'status-done'];
            case 'cancelled':
                return ['label' => 'Cancelled', 'class' => 'status-cancelled'];
            case 'pending':
            default:
                return ['label' => 'Pending', 'class' => 'status-pending'];
        }
    }
}
