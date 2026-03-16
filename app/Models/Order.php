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
}
