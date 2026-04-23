<?php

class Order {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Get total number of orders for a user
    public function getUserOrderCount($userId) {
        $this->db->query("SELECT COUNT(*) as total FROM orders WHERE user_id = :user_id");
        $this->db->bind(':user_id', $userId);
        $row = $this->db->single();
        return $row['total'];
    }

    // Get total amount spent by a user
    public function getUserTotalSpent($userId) {
        $this->db->query("SELECT COALESCE(SUM(total_amount), 0) as total_spent FROM orders WHERE user_id = :user_id");
        $this->db->bind(':user_id', $userId);
        $row = $this->db->single();
        return $row['total_spent'];
    }

    // Get favorites count for a user
    public function getUserFavoritesCount($userId) {
        $this->db->query("SELECT COUNT(*) as total FROM favorites WHERE user_id = :user_id");
        $this->db->bind(':user_id', $userId);
        $row = $this->db->single();
        return $row['total'];
    }

    // Get recent orders with their first product details (for dashboard table)
    public function getRecentOrdersWithItems($userId, $limit = 5) {
        $this->db->query("SELECT o.id, o.total_amount, o.status, o.created_at,
                                 oi.quantity, oi.price_at_time,
                                 p.name as product_name, p.image_url
                          FROM orders o
                          JOIN order_items oi ON o.id = oi.order_id
                          JOIN products p ON oi.product_id = p.id
                          WHERE o.user_id = :user_id
                          ORDER BY o.created_at DESC
                          LIMIT :limit");
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':limit', (int)$limit);
        return $this->db->resultSet();
    }

    public function getAvailableProducts() {
        $this->db->query("SELECT p.id, p.name, p.price, p.image_url, c.name as category_name
                          FROM products p
                          LEFT JOIN categories c ON p.category_id = c.id
                          WHERE p.is_available = 1
                          ORDER BY p.name ASC");
        return $this->db->resultSet();
    }

    public function createOrderWithItems($userId, $room, $notes, $items) {
        if (empty($items)) {
            return false;
        }

        $totalAmount = 0.0;
        $pricedItems = [];

        foreach ($items as $item) {
            if (empty($item['product_id']) || empty($item['quantity']) || $item['quantity'] < 1) {
                continue;
            }

            $this->db->query("SELECT id, price FROM products WHERE id = :id AND is_available = 1");
            $this->db->bind(':id', (int)$item['product_id']);
            $product = $this->db->single();

            if (!$product) {
                continue;
            }

            $lineTotal = ((float)$product['price']) * ((int)$item['quantity']);
            $totalAmount += $lineTotal;

            $pricedItems[] = [
                'product_id' => (int)$product['id'],
                'quantity' => (int)$item['quantity'],
                'price' => (float)$product['price']
            ];
        }

        if (empty($pricedItems)) {
            return false;
        }

        try {
            $this->db->beginTransaction();

            $this->db->query("INSERT INTO orders (user_id, total_amount, status, shipping_address)
                              VALUES (:user_id, :total_amount, 'pending', :shipping_address)");
            $this->db->bind(':user_id', (int)$userId);
            $this->db->bind(':total_amount', $totalAmount);
            $this->db->bind(':shipping_address', $this->buildDeliveryInfo($room, $notes));
            $this->db->execute();

            $orderId = (int)$this->db->lastInsertId();

            foreach ($pricedItems as $item) {
                $this->db->query("INSERT INTO order_items (order_id, product_id, quantity, price_at_time)
                                  VALUES (:order_id, :product_id, :quantity, :price_at_time)");
                $this->db->bind(':order_id', $orderId);
                $this->db->bind(':product_id', $item['product_id']);
                $this->db->bind(':quantity', $item['quantity']);
                $this->db->bind(':price_at_time', $item['price']);
                $this->db->execute();
            }

            $this->db->commit();
            return $orderId;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function getOrdersWithItemsByUser($userId, $dateFrom = '', $dateTo = '') {
        $sql = "SELECT id, user_id, total_amount, status, shipping_address, created_at
                FROM orders
                WHERE user_id = :user_id";

        if ($dateFrom !== '') {
            $sql .= " AND DATE(created_at) >= :date_from";
        }
        if ($dateTo !== '') {
            $sql .= " AND DATE(created_at) <= :date_to";
        }

        $sql .= " ORDER BY created_at DESC";

        $this->db->query($sql);
        $this->db->bind(':user_id', (int)$userId);
        if ($dateFrom !== '') {
            $this->db->bind(':date_from', $dateFrom);
        }
        if ($dateTo !== '') {
            $this->db->bind(':date_to', $dateTo);
        }

        $orders = $this->db->resultSet();
        if (empty($orders)) {
            return [];
        }

        $orderIds = array_map(function ($order) {
            return (int)$order['id'];
        }, $orders);

        $items = $this->getItemsForOrders($orderIds);
        $itemsByOrder = [];
        foreach ($items as $item) {
            $orderId = (int)$item['order_id'];
            if (!isset($itemsByOrder[$orderId])) {
                $itemsByOrder[$orderId] = [];
            }
            $itemsByOrder[$orderId][] = $item;
        }

        foreach ($orders as &$order) {
            $delivery = $this->parseDeliveryInfo($order['shipping_address']);
            $order['room'] = $delivery['room'];
            $order['notes'] = $delivery['notes'];
            $order['items'] = isset($itemsByOrder[(int)$order['id']]) ? $itemsByOrder[(int)$order['id']] : [];
        }
        unset($order);

        return $orders;
    }

    public function cancelPendingOrder($orderId, $userId) {
        $this->db->query("UPDATE orders
                          SET status = 'cancelled'
                          WHERE id = :order_id
                            AND user_id = :user_id
                            AND status = 'pending'");
        $this->db->bind(':order_id', (int)$orderId);
        $this->db->bind(':user_id', (int)$userId);

        if (!$this->db->execute()) {
            return false;
        }

        return $this->db->rowCount() > 0;
    }

    private function buildDeliveryInfo($room, $notes) {
        $cleanRoom = trim((string)$room);
        $cleanNotes = trim((string)$notes);

        if ($cleanNotes === '') {
            $cleanNotes = 'None';
        }

        return "Room: {$cleanRoom}\nNotes: {$cleanNotes}";
    }

    private function getItemsForOrders($orderIds) {
        if (empty($orderIds)) {
            return [];
        }

        $placeholders = [];
        foreach ($orderIds as $idx => $orderId) {
            $placeholders[] = ':order_id_' . $idx;
        }

        $this->db->query("SELECT oi.order_id, oi.product_id, oi.quantity, oi.price_at_time,
                                 p.name as product_name, p.image_url
                          FROM order_items oi
                          JOIN products p ON p.id = oi.product_id
                          WHERE oi.order_id IN (" . implode(', ', $placeholders) . ")
                          ORDER BY oi.id ASC");

        foreach ($orderIds as $idx => $orderId) {
            $this->db->bind(':order_id_' . $idx, (int)$orderId);
        }

        return $this->db->resultSet();
    }

    private function parseDeliveryInfo($shippingAddress) {
        $room = trim((string)$shippingAddress);
        $notes = 'None';

        if (preg_match('/Room:\s*(.*)/i', (string)$shippingAddress, $roomMatch)) {
            $room = trim($roomMatch[1]);
        }
        if (preg_match('/Notes:\s*(.*)/i', (string)$shippingAddress, $notesMatch)) {
            $notes = trim($notesMatch[1]);
        }

        return [
            'room' => $room === '' ? 'N/A' : $room,
            'notes' => $notes === '' ? 'None' : $notes
        ];
    }

    public function getGroupedUserChecks($dateFrom = '', $dateTo = '', $userId = 0) {
        $sql = "SELECT u.id as user_id, u.name as user_name, COUNT(o.id) as total_orders, COALESCE(SUM(o.total_amount), 0) as total_amount
                FROM users u
                JOIN orders o ON u.id = o.user_id
                WHERE 1=1";
        
        if ($dateFrom !== '') {
            $sql .= " AND DATE(o.created_at) >= :date_from";
        }
        if ($dateTo !== '') {
            $sql .= " AND DATE(o.created_at) <= :date_to";
        }
        if ($userId > 0) {
            $sql .= " AND u.id = :user_id";
        }

        $sql .= " GROUP BY u.id, u.name ORDER BY total_amount DESC";

        $this->db->query($sql);
        if ($dateFrom !== '') $this->db->bind(':date_from', $dateFrom);
        if ($dateTo !== '') $this->db->bind(':date_to', $dateTo);
        if ($userId > 0) $this->db->bind(':user_id', $userId);

        return $this->db->resultSet();
    }

    public function getFilteredRevenue($dateFrom = '', $dateTo = '', $userId = 0) {
        $sql = "SELECT COALESCE(SUM(total_amount), 0) as revenue FROM orders WHERE 1=1";
        
        if ($dateFrom !== '') {
            $sql .= " AND DATE(created_at) >= :date_from";
        }
        if ($dateTo !== '') {
            $sql .= " AND DATE(created_at) <= :date_to";
        }
        if ($userId > 0) {
            $sql .= " AND user_id = :user_id";
        }

        $this->db->query($sql);
        if ($dateFrom !== '') $this->db->bind(':date_from', $dateFrom);
        if ($dateTo !== '') $this->db->bind(':date_to', $dateTo);
        if ($userId > 0) $this->db->bind(':user_id', $userId);

        $row = $this->db->single();
        return (float) $row['revenue'];
    }

    public function updateOrderStatus($orderId, $newStatus) {
        $allowedStatuses = ['pending', 'processing', 'out_for_delivery', 'done', 'cancelled', 'completed'];
        if (!in_array(strtolower($newStatus), $allowedStatuses)) {
            return false;
        }

        $this->db->query("UPDATE orders SET status = :status WHERE id = :id");
        $this->db->bind(':status', $newStatus);
        $this->db->bind(':id', (int)$orderId);
        return $this->db->execute();
    }
}
