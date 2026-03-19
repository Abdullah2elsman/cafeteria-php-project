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

        $this->orderModel = $this->model('Order');
        $this->userModel = $this->model('User');
    }

    private function requireAdmin() {
        if ($_SESSION['user_role'] != 'admin') {
            header('location: ' . URL_ROOT . '/users/dashboard');
            exit;
        }
    }

    // ─── Regular User Methods ───

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

    // ─── Admin User Management Methods ───

    public function index()
    {
        $this->requireAdmin();
        $users = $this->userModel->getAllUsers();

        $data = [
            'title' => 'User Management',
            'css_file' => 'dashboard.css',
            'active_nav' => 'users',
            'users' => $users
        ];

        $this->view('admin/users/index', $data);
    }

    public function add()
    {
        $this->requireAdmin();
        $data = [
            'title' => 'Add User',
            'css_file' => 'dashboard.css',
            'active_nav' => 'users',
            'name' => '',
            'email' => '',
            'password' => '',
            'room_no' => '',
            'ext' => '',
            'errors' => []
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data['name'] = trim((string)($_POST['name'] ?? ''));
            $data['email'] = trim((string)($_POST['email'] ?? ''));
            $data['password'] = trim((string)($_POST['password'] ?? ''));
            $data['room_no'] = trim((string)($_POST['room_no'] ?? ''));
            $data['ext'] = trim((string)($_POST['ext'] ?? ''));

            // Validations
            if (empty($data['name'])) {
                $data['errors']['name'] = 'Name is required.';
            }
            if (empty($data['email'])) {
                $data['errors']['email'] = 'Email is required.';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['errors']['email'] = 'Valid email is required.';
            } elseif ($this->userModel->findUserByEmail($data['email'])) {
                $data['errors']['email'] = 'Email is already taken.';
            }
            if (empty($data['password'])) {
                $data['errors']['password'] = 'Password is required.';
            } elseif (strlen($data['password']) < 6) {
                $data['errors']['password'] = 'Password must be at least 6 characters.';
            }
            if (empty($data['room_no'])) {
                $data['errors']['room_no'] = 'Room number is required.';
            }
            if (empty($data['ext'])) {
                $data['errors']['ext'] = 'Extension is required.';
            }

            // Image Upload
            $imageUrl = null;
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
                $imageUrl = $this->handleImageUpload('profile_image');
                if ($imageUrl === false) {
                    $data['errors']['image'] = 'Image upload failed. Allowed: jpg, png, jpeg. Max: 2MB.';
                }
            }

            if (empty($data['errors'])) {
                $payload = [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => $data['password'],
                    'room_no' => $data['room_no'],
                    'ext' => $data['ext'],
                    'profile_image' => $imageUrl
                ];

                if ($this->userModel->addSystemUser($payload)) {
                    flash('user_success', 'User added successfully', 'alert alert-success');
                    header('Location: ' . URL_ROOT . '/users/index');
                    exit;
                } else {
                    flash('user_error', 'Something went wrong while adding the user', 'alert alert-danger');
                }
            }
        }

        $this->view('admin/users/add', $data);
    }

    public function edit($id = null)
    {
        $this->requireAdmin();
        if (!$id) {
            header('Location: ' . URL_ROOT . '/users/index');
            exit;
        }

        $user = $this->userModel->getUserById($id);
        if (!$user) {
            header('Location: ' . URL_ROOT . '/users/index');
            exit;
        }

        $data = [
            'title' => 'Edit User',
            'css_file' => 'dashboard.css',
            'active_nav' => 'users',
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => '', // leave blank unless changing
            'room_no' => $user['room_no'],
            'ext' => $user['ext'],
            'profile_image' => $user['profile_image'],
            'errors' => []
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data['name'] = trim((string)($_POST['name'] ?? ''));
            $data['email'] = trim((string)($_POST['email'] ?? ''));
            $data['password'] = trim((string)($_POST['password'] ?? ''));
            $data['room_no'] = trim((string)($_POST['room_no'] ?? ''));
            $data['ext'] = trim((string)($_POST['ext'] ?? ''));

            // Validations
            if (empty($data['name'])) {
                $data['errors']['name'] = 'Name is required.';
            }
            if (empty($data['email'])) {
                $data['errors']['email'] = 'Email is required.';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['errors']['email'] = 'Valid email is required.';
            } elseif ($this->userModel->findUserByEmailExcept($data['email'], $id)) {
                $data['errors']['email'] = 'Email is already taken by another user.';
            }
            
            if (!empty($data['password']) && strlen($data['password']) < 6) {
                $data['errors']['password'] = 'Password must be at least 6 characters.';
            }
            
            if (empty($data['room_no'])) {
                $data['errors']['room_no'] = 'Room number is required.';
            }
            if (empty($data['ext'])) {
                $data['errors']['ext'] = 'Extension is required.';
            }

            // Image Upload
            $imageUrl = $user['profile_image']; // assume existing by default
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
                $newImageUrl = $this->handleImageUpload('profile_image');
                if ($newImageUrl === false) {
                    $data['errors']['image'] = 'Image upload failed. Allowed: jpg, png, jpeg. Max: 2MB.';
                } else {
                    $imageUrl = $newImageUrl;
                }
            }

            if (empty($data['errors'])) {
                $payload = [
                    'id' => $id,
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => $data['password'],
                    'room_no' => $data['room_no'],
                    'ext' => $data['ext'],
                    'profile_image' => $imageUrl
                ];

                if ($this->userModel->updateSystemUser($payload)) {
                    flash('user_success', 'User updated successfully', 'alert alert-success');
                    header('Location: ' . URL_ROOT . '/users/index');
                    exit;
                } else {
                    flash('user_error', 'Something went wrong while updating the user', 'alert alert-danger');
                }
            }
        }

        $this->view('admin/users/edit', $data);
    }

    public function delete($id)
    {
        $this->requireAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->userModel->deleteUser($id)) {
                flash('user_success', 'User deleted successfully', 'alert alert-success');
            } else {
                flash('user_error', 'Failed to delete user', 'alert alert-danger');
            }
        }
        header('Location: ' . URL_ROOT . '/users/index');
        exit;
    }

    private function handleImageUpload($inputName)
    {
        $file = $_FILES[$inputName];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        $maxSize = 2 * 1024 * 1024; // 2MB

        if (!in_array($file['type'], $allowedTypes)) {
            return false;
        }

        if ($file['size'] > $maxSize) {
            return false;
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid('profile_') . '.' . $ext;
        $uploadDir = dirname(dirname(__DIR__)) . '/public/img/profiles/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $uploadPath = $uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return 'img/profiles/' . $filename;
        }

        return false;
    }
}
