<?php

class Checks extends Controller {

    public function index() {

        $orderModel = $this->model('Order');
        $userModel = $this->model('User');

        // Get filters
        $from = $_GET['from'] ?? null;
        $to = $_GET['to'] ?? null;
        $userId = $_GET['user_id'] ?? null;

        // Get checks (total per user)
        $checks = $orderModel->getChecks($from, $to, $userId);

        //  Get all users (for dropdown)
        $users = $userModel->getAllUsers();

        // Add orders to each user
        foreach ($checks as &$check) {
            $check['orders'] = $orderModel->getOrdersByUser($check['id']);
        }

        // Send data to view
        $this->view('admin/checks', [
            'checks' => $checks,
            'users' => $users,
            'from' => $from,
            'to' => $to,
            'user_id' => $userId
        ]);
    }
}