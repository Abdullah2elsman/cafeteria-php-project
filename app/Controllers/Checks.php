<?php

class Checks extends Controller {
    private $orderModel;
    private $userModel;

    public function __construct() {
        if (!isLoggedIn() || $_SESSION['user_role'] != 'admin') {
            header('location: ' . URL_ROOT . '/auth/login');
            exit;
        }

        $this->orderModel = $this->model('Order');
        $this->userModel = $this->model('User');
    }

    public function index() {
        $dateFrom = isset($_GET['date_from']) ? trim($_GET['date_from']) : '';
        $dateTo = isset($_GET['date_to']) ? trim($_GET['date_to']) : '';
        $userId = isset($_GET['user_id']) ? (int) $_GET['user_id'] : 0;

        $users = [];
        if (method_exists($this->userModel, 'getAllUsers')) {
            $users = $this->userModel->getAllUsers();
        }

        $groupedChecks = $this->orderModel->getGroupedUserChecks($dateFrom, $dateTo, $userId);
        $totalRevenue = $this->orderModel->getFilteredRevenue($dateFrom, $dateTo, $userId);

        $data = [
            'all_users' => $users,
            'checks' => $groupedChecks,
            'total_filtered_revenue' => $totalRevenue,
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
            'user_id' => $userId
        ];

        $this->view('admin/checks/index', $data);
    }

    public function user($targetUserId) {
        $targetUserId = (int) $targetUserId;
        if ($targetUserId <= 0) {
            header('location: ' . URL_ROOT . '/checks');
            exit;
        }

        $dateFrom = isset($_GET['date_from']) ? trim($_GET['date_from']) : '';
        $dateTo = isset($_GET['date_to']) ? trim($_GET['date_to']) : '';

        $orders = $this->orderModel->getOrdersWithItemsByUser($targetUserId, $dateFrom, $dateTo);

        $targetUser = null;
        if (method_exists($this->userModel, 'findUserById')) {
             $targetUser = $this->userModel->findUserById($targetUserId);
        } else {
            $users = $this->userModel->getAllUsers();
            foreach ($users as $u) {
                if ($u['id'] == $targetUserId) {
                    $targetUser = $u;
                    break;
                }
            }
        }

        $totalRevenue = $this->orderModel->getFilteredRevenue($dateFrom, $dateTo, $targetUserId);

        foreach ($orders as &$order) {
            $order['status_meta'] = $this->statusMeta($order['status']);
        }
        unset($order);

        $data = [
            'target_user' => $targetUser,
            'orders' => $orders,
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
            'total_filtered_revenue' => $totalRevenue
        ];

        $this->view('admin/checks/user_details', $data);
    }

    public function updateStatus($orderId) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('location: ' . URL_ROOT . '/checks');
            exit;
        }

        $newStatus = isset($_POST['status']) ? trim($_POST['status']) : '';
        $redirectUserId = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0;
        
        if ($newStatus) {
            $this->orderModel->updateOrderStatus((int)$orderId, $newStatus);
        }
        
        if ($redirectUserId > 0) {
            header('location: ' . URL_ROOT . '/checks/user/' . $redirectUserId);
        } else {
            header('location: ' . URL_ROOT . '/checks');
        }
        exit;
    }

    private function statusMeta($status) {
        $normalized = strtolower((string)$status);
        switch ($normalized) {
            case 'processing': return ['label' => 'Processing', 'class' => 'status-processing'];
            case 'out_for_delivery': return ['label' => 'Out for delivery', 'class' => 'status-out-for-delivery'];
            case 'done': return ['label' => 'Done', 'class' => 'status-done'];
            case 'completed': return ['label' => 'Done', 'class' => 'status-done'];
            case 'cancelled': return ['label' => 'Cancelled', 'class' => 'status-cancelled'];
            case 'pending':
            default: return ['label' => 'Pending', 'class' => 'status-pending'];
        }
    }
}
