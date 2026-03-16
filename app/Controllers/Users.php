<?php

class Users extends Controller {
    private $orderModel;
    private $userModel;

    public function __construct() {
        if (!isLoggedIn()) {
            flash('session_expired', 'Please log in to access this page', 'alert alert-error');
            header('location: ' . URL_ROOT . '/auth/login');
            exit;
        }

        if ($_SESSION['user_role'] == 'admin') {
            header('location: ' . URL_ROOT . '/admin/dashboard');
            exit;
        }

        $this->orderModel = $this->model('Order');
        $this->userModel = $this->model('User');
    }

    public function dashboard() {
        $userId = $_SESSION['user_id'];
        $user = $this->userModel->getUserById($userId);

        $data = [
            'title' => 'My Dashboard | Sip & Savor',
            'css_file' => 'dashboard.css',
            'user' => $user,
            'total_orders' => $this->orderModel->getUserOrderCount($userId),
            'total_spent' => $this->orderModel->getUserTotalSpent($userId),
            'favorites_count' => $this->orderModel->getUserFavoritesCount($userId),
            'recent_orders' => $this->orderModel->getRecentOrdersWithItems($userId, 5)
        ];
        $this->view('users/dashboard', $data);
    }

    public function orders() {
        $data = [
            'title' => 'My Orders | Sip & Savor',
            'css_file' => 'dashboard.css'
        ];
        $this->view('users/orders', $data);
    }

    public function favorites() {
        $data = [
            'title' => 'Favorites | Sip & Savor',
            'css_file' => 'dashboard.css'
        ];
        $this->view('users/favorites', $data);
    }

    public function history() {
        $data = [
            'title' => 'History | Sip & Savor',
            'css_file' => 'dashboard.css'
        ];
        $this->view('users/history', $data);
    }

    public function settings() {
        $userId = $_SESSION['user_id'];
        $user = $this->userModel->getUserById($userId);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize inputs
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);
            $address = trim($_POST['address']);

            // Validation errors
            $errors = [];

            if (empty($name)) {
                $errors['name_err'] = 'Please enter your name';
            }
            if (empty($email)) {
                $errors['email_err'] = 'Please enter your email';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email_err'] = 'Please enter a valid email';
            } elseif ($this->userModel->findUserByEmailExcept($email, $userId)) {
                $errors['email_err'] = 'Email is already taken by another user';
            }

            // Handle profile image upload
            $newImagePath = null;
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['profile_image'];
                $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                $maxSize = 2 * 1024 * 1024; // 2MB

                if (!in_array($file['type'], $allowedTypes)) {
                    $errors['image_err'] = 'Only JPG and PNG files are allowed';
                } elseif ($file['size'] > $maxSize) {
                    $errors['image_err'] = 'Image must be less than 2MB';
                } else {
                    // Generate unique filename
                    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                    $filename = 'user_' . $userId . '_' . time() . '.' . $ext;
                    $uploadDir = dirname(dirname(__DIR__)) . '/public/img/profiles/';
                    $uploadPath = $uploadDir . $filename;

                    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                        $newImagePath = '/img/profiles/' . $filename;

                        // Delete old image if exists
                        if (!empty($user['profile_image'])) {
                            $oldFile = dirname(dirname(__DIR__)) . '/public' . $user['profile_image'];
                            if (file_exists($oldFile)) {
                                unlink($oldFile);
                            }
                        }
                    } else {
                        $errors['image_err'] = 'Failed to upload image';
                    }
                }
            }

            if (empty($errors)) {
                // Update user profile
                $updateData = [
                    'id' => $userId,
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address
                ];

                if ($this->userModel->updateUser($updateData)) {
                    // Update profile image if uploaded
                    if ($newImagePath) {
                        $this->userModel->updateProfileImage($userId, $newImagePath);
                    }

                    $_SESSION['user_name'] = $name;
                    flash('settings_message', 'Profile updated successfully!');
                    header('location: ' . URL_ROOT . '/users/settings');
                    exit;
                } else {
                    flash('settings_message', 'Something went wrong, please try again.', 'alert alert-error');
                }
            }

            // If errors, re-render with entered values
            $data = [
                'title' => 'Settings | Sip & Savor',
                'css_file' => 'dashboard.css',
                'user' => [
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address,
                    'profile_image' => $user['profile_image']
                ],
                'errors' => $errors
            ];
            $this->view('users/settings', $data);

        } else {
            // GET - load current user data
            $data = [
                'title' => 'Settings | Sip & Savor',
                'css_file' => 'dashboard.css',
                'user' => $user,
                'errors' => []
            ];
            $this->view('users/settings', $data);
        }
    }
}
