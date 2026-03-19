<?php

class Products extends Controller
{
    private Product $productModel;

    public function __construct()
    {
        $this->productModel = $this->model('Product');
    }

    // GET /public/products
    public function index(): void
    {
        $products = $this->productModel->getAllProducts();

        $data = [
            'title' => 'All Products',
            'css_file' => 'dashboard.css',
            'active_nav' => 'products',
            'products' => $products,
        ];

        $this->view('admin/products/index', $data);
    }

    // GET|POST /public/products/add
    public function add(): void
    {
        $categories = $this->productModel->getAllCategories();

        $data = [
            'title' => 'Add Product',
            'css_file' => 'dashboard.css',
            'active_nav' => 'products',
            'categories' => $categories,
            'name' => '',
            'description' => '',
            'price' => '',
            'category_id' => '',
            'errors' => [],
        ];

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->view('admin/products/add', $data);
            return;
        }

        $post = $_POST;
        $data['name'] = trim((string)($post['name'] ?? ''));
        $data['description'] = trim((string)($post['description'] ?? ''));
        $data['price'] = (string)($post['price'] ?? '');
        $data['category_id'] = (string)($post['category_id'] ?? '');

        if ($data['name'] === '') {
            $data['errors']['name'] = 'Name is required.';
        }
        if ($data['price'] === '' || !is_numeric($data['price'])) {
            $data['errors']['price'] = 'Valid price is required.';
        }
        if ($data['category_id'] === '') {
            $data['errors']['category'] = 'Category is required.';
        }

        $imageUrl = $this->handleImageUpload('image');
        if ($imageUrl === false) {
            $data['errors']['image'] = 'Image upload failed.';
        }

        if (!empty($data['errors'])) {
            $this->view('admin/products/add', $data);
            return;
        }

        $payload = [
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'category_id' => $data['category_id'],
            'image_url' => $imageUrl ?: '',
        ];

        $ok = $this->productModel->addProduct($payload);
        flash($ok ? 'product_success' : 'product_error', $ok ? 'Product added.' : 'Failed to add product.', $ok ? 'alert alert-success' : 'alert alert-danger');
        header('Location: ' . URL_ROOT . '/products');
        exit;
    }

    // GET|POST /public/products/edit/{id}
    public function edit($id = null): void
    {
        $id = $id !== null ? (int)$id : 0;
        if ($id <= 0) {
            die('Invalid product id.');
        }

        $product = $this->productModel->getProductById($id);
        if (empty($product)) {
            die('Product not found.');
        }

        $categories = $this->productModel->getAllCategories();

        $data = [
            'title' => 'Edit Product',
            'css_file' => 'dashboard.css',
            'active_nav' => 'products',
            'categories' => $categories,
            'errors' => [],
            'id' => $product['id'],
            'name' => $product['name'] ?? '',
            'description' => $product['description'] ?? '',
            'price' => $product['price'] ?? '',
            'category_id' => $product['category_id'] ?? '',
            'image_url' => $product['image_url'] ?? '',
        ];

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->view('admin/products/edit', $data);
            return;
        }

        $post = $_POST;
        $data['name'] = trim((string)($post['name'] ?? ''));
        $data['description'] = trim((string)($post['description'] ?? ''));
        $data['price'] = (string)($post['price'] ?? '');
        $data['category_id'] = (string)($post['category_id'] ?? '');

        if ($data['name'] === '') {
            $data['errors']['name'] = 'Name is required.';
        }
        if ($data['price'] === '' || !is_numeric($data['price'])) {
            $data['errors']['price'] = 'Valid price is required.';
        }
        if ($data['category_id'] === '') {
            $data['errors']['category'] = 'Category is required.';
        }

        $imageUrl = $this->handleImageUpload('image');
        if ($imageUrl === false) {
            $data['errors']['image'] = 'Image upload failed.';
        }

        if (!empty($data['errors'])) {
            $this->view('admin/products/edit', $data);
            return;
        }

        $payload = [
            'id' => $id,
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'category_id' => $data['category_id'],
            'image_url' => $imageUrl !== '' ? ($imageUrl ?: '') : ($data['image_url'] ?? ''),
        ];

        $ok = $this->productModel->updateProduct($payload);
        flash($ok ? 'product_success' : 'product_error', $ok ? 'Product updated.' : 'Failed to update product.', $ok ? 'alert alert-success' : 'alert alert-danger');
        header('Location: ' . URL_ROOT . '/products');
        exit;
    }

    // GET|POST /public/products/delete/{id}
    public function delete($id = null): void
    {
        $id = $id !== null ? (int)$id : 0;
        if ($id <= 0) {
            die('Invalid product id.');
        }

        $ok = $this->productModel->deleteProduct($id);
        flash($ok ? 'product_success' : 'product_error', $ok ? 'Product deleted.' : 'Failed to delete product.', $ok ? 'alert alert-success' : 'alert alert-danger');
        header('Location: ' . URL_ROOT . '/products');
        exit;
    }

    // GET|POST /public/products/toggle/{id}
    public function toggle($id = null): void
    {
        $id = $id !== null ? (int)$id : 0;
        if ($id <= 0) {
            die('Invalid product id.');
        }

        $ok = $this->productModel->toggleAvailability($id);
        flash($ok ? 'product_success' : 'product_error', $ok ? 'Availability updated.' : 'Failed to update availability.', $ok ? 'alert alert-success' : 'alert alert-danger');
        header('Location: ' . URL_ROOT . '/products');
        exit;
    }

    private function handleImageUpload(string $fieldName)
    {
        if (!isset($_FILES[$fieldName]) || empty($_FILES[$fieldName]['name'])) {
            return '';
        }

        if (!isset($_FILES[$fieldName]['error']) || $_FILES[$fieldName]['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        $tmpName = $_FILES[$fieldName]['tmp_name'] ?? '';
        if (!is_uploaded_file($tmpName)) {
            return false;
        }

        $ext = strtolower(pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION));
        if ($ext === '') {
            $ext = 'jpg';
        }

        $targetDir = __DIR__ . '/../../public/img/products';
        if (!is_dir($targetDir) && !mkdir($targetDir, 0755, true)) {
            return false;
        }

        $fileName = 'product_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
        $targetPath = $targetDir . '/' . $fileName;

        if (!move_uploaded_file($tmpName, $targetPath)) {
            return false;
        }

        // Stored as a public-relative path used by the existing views
        return 'img/products/' . $fileName;
    }
}

