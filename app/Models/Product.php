<?php

class Product {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Get all available products with category name
    public function getProducts() {
        $this->db->query("SELECT p.id as productId, p.name, p.description, p.price, p.image_url, p.is_available,
                                 c.name as categoryName
                          FROM products p
                          JOIN categories c ON p.category_id = c.id
                          WHERE p.is_available = 1
                          ORDER BY c.id, p.name");
        return $this->db->resultSet();
    }

    // Get a single product by ID
    public function getProductById($id) {
        $this->db->query("SELECT * FROM products WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
}
