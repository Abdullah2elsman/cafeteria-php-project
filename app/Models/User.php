<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // Register a new user
    public function register($data)
    {
        $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
        
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        
        // Hash password before saving
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Login a user
    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($row) {
            $hashed_password = $row['password'];
            if (password_verify($password, $hashed_password)) {
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // Find user by email
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Get user by ID
    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    // Check if email exists for another user (not the current one)
    public function findUserByEmailExcept($email, $userId)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email AND id != :id');
        $this->db->bind(':email', $email);
        $this->db->bind(':id', $userId);

        $this->db->single();
        return $this->db->rowCount() > 0;
    }

    // Update user profile
    public function updateUser($data)
    {
        $this->db->query('UPDATE users SET name = :name, email = :email, phone = :phone, address = :address WHERE id = :id');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':id', $data['id']);

        return $this->db->execute();
    }

    // Update user password
    public function updatePassword($id, $password)
    {
        $this->db->query('UPDATE users SET password = :password WHERE id = :id');
        $this->db->bind(':password', password_hash($password, PASSWORD_DEFAULT));
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }

    // Update user profile image
    public function updateProfileImage($id, $imagePath)
    {
        $this->db->query('UPDATE users SET profile_image = :profile_image WHERE id = :id');
        $this->db->bind(':profile_image', $imagePath);
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }

    // ---------------------------------------------------------
    // Admin User Management Methods
    // ---------------------------------------------------------

    // Get all users
    public function getAllUsers()
    {
        $this->db->query('SELECT * FROM users ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    // Add a new system user
    public function addSystemUser($data)
    {
        $this->db->query('INSERT INTO users (name, email, password, room_no, ext, profile_image) VALUES (:name, :email, :password, :room_no, :ext, :profile_image)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind(':room_no', $data['room_no']);
        $this->db->bind(':ext', $data['ext']);
        $this->db->bind(':profile_image', $data['profile_image']);

        return $this->db->execute();
    }

    // Update system user details
    public function updateSystemUser($data)
    {
        // If password is provided, update it too
        if (!empty($data['password'])) {
            $this->db->query('UPDATE users SET name = :name, email = :email, room_no = :room_no, ext = :ext, profile_image = :profile_image, password = :password WHERE id = :id');
            $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        } else {
            $this->db->query('UPDATE users SET name = :name, email = :email, room_no = :room_no, ext = :ext, profile_image = :profile_image WHERE id = :id');
        }

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':room_no', $data['room_no']);
        $this->db->bind(':ext', $data['ext']);
        $this->db->bind(':profile_image', $data['profile_image']);
        $this->db->bind(':id', $data['id']);

        return $this->db->execute();
    }

    // Delete a user
    public function deleteUser($id)
    {
        $this->db->query('DELETE FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
