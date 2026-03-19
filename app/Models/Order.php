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

    private function buildDeliveryInfo($room, $notes) {
        $cleanRoom = trim((string)$room);
        $cleanNotes = trim((string)$notes);

        if ($cleanNotes === '') {
            $cleanNotes = 'None';
        }

        return "Room: {$cleanRoom}\nNotes: {$cleanNotes}";
    }
}
