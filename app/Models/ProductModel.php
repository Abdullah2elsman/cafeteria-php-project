<?php
class Product {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Get all products with category name
    public function getAllProducts() {
        $this->db->query("SELECT p.*, c.name as category_name 
                          FROM products p 
                          JOIN categories c ON p.category_id = c.id 
                          ORDER BY c.name, p.name");
        return $this->db->resultSet();
    }

    // Get single product by ID
    public function getProductById($id) {
        $this->db->query("SELECT * FROM products WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Get all categories (for add/edit form)
    public function getAllCategories() {
        $this->db->query("SELECT * FROM categories ORDER BY name");
        return $this->db->resultSet();
    }

    // Add new product
    public function addProduct($data) {
        $this->db->query("INSERT INTO products (name, description, price, category_id, image_url, is_available) 
                          VALUES (:name, :description, :price, :category_id, :image_url, :is_available)");
        $this->db->bind(':name',        $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price',       $data['price']);
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':image_url',   $data['image_url']);
        $this->db->bind(':is_available', 1);
        return $this->db->execute();
    }

    // Update existing product
    public function updateProduct($data) {
        $this->db->query("UPDATE products 
                          SET name = :name, description = :description, price = :price, 
                              category_id = :category_id, image_url = :image_url 
                          WHERE id = :id");
        $this->db->bind(':name',        $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price',       $data['price']);
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':image_url',   $data['image_url']);
        $this->db->bind(':id',          $data['id']);
        return $this->db->execute();
    }

    // Delete product
    public function deleteProduct($id) {
        $this->db->query("DELETE FROM products WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // Toggle availability (available <-> unavailable)
    public function toggleAvailability($id) {
        $this->db->query("UPDATE products SET is_available = NOT is_available WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}