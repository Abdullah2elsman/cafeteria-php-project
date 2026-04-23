<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users | Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/css/dashboard.css">
</head>

<body>

    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="<?php echo URL_ROOT; ?>" class="sidebar-brand">
                <i class="fa-solid fa-mug-hot"></i> Admin Panel
            </a>
        </div>

        <nav class="sidebar-nav">
            <a href="<?php echo URL_ROOT; ?>/admin/dashboard" class="nav-item">
                <i class="fa-solid fa-border-all"></i> Dashboard
            </a>
            <a href="<?php echo URL_ROOT; ?>/admin/prducts" class="nav-item">
                <i class="fa-solid fa-box"></i> Products
            </a>
            <a href="<?php echo URL_ROOT; ?>/admin/users" class="nav-item active">
                <i class="fa-solid fa-users"></i> Users
            </a>
            <a href="<?php echo URL_ROOT; ?>/admin/checks" class="nav-item">
                <i class="fa-solid fa-wallet"></i> Checks
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="<?php echo URL_ROOT; ?>/auth/logout" class="logout-btn">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
            </a>
        </div>
    </aside>

    <main class="main-content">
        <header class="dashboard-header">
            <div class="welcome-msg">
                <h1>Users Management</h1>
                <p>Manage cafeteria members, admin roles, and account settings.</p>
            </div>

            <div class="header-actions">
                <a href="<?php echo URL_ROOT; ?>/users/add" class="btn-new-order" style="background-color: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none; font-weight: 500;">
                    <i class="fa-solid fa-plus"></i> Add User
                </a>
                <div class="user-profile">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=D4A373&color=fff" alt="Profile" class="avatar">
                </div>
            </div>
        </header>

        <section class="recent-orders" style="margin-top: 1rem;">
            <div class="section-header">
                <h2>All Users</h2>
            </div>
            
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Registration Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data['users'])): ?>
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 2rem; color: var(--color-text-muted);">
                                    No users found.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($data['users'] as $user): ?>
                            <tr>
                                <td><?php echo $user['id']; ?></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user['name']); ?>&background=random&color=fff" alt="Avatar" style="width: 35px; height: 35px; border-radius: 50%;">
                                        <strong><?php echo htmlspecialchars($user['name']); ?></strong>
                                    </div>
                                </td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td>
                                    <?php if($user['role'] == 'admin'): ?>
                                        <span class="status-badge" style="background-color: #fef3c7; color: #d97706;">Admin</span>
                                    <?php else: ?>
                                        <span class="status-badge status-completed">User</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo date('M j, Y', strtotime($user['created_at'])); ?></td>
                                <td>
                                    <div style="display: flex; gap: 10px;">
                                        <a href="<?php echo URL_ROOT; ?>/users/edit/<?php echo $user['id']; ?>" class="action-btn" title="Edit" style="background-color: #e0e7ff; color: #4338ca;"><i class="fa-solid fa-pen"></i></a>
                                        <form action="<?php echo URL_ROOT; ?>/users/delete/<?php echo $user['id']; ?>" method="POST" style="margin: 0; padding: 0;">
                                            <button type="submit" class="action-btn" title="Delete" style="background-color: #fee2e2; color: #b91c1c; border: none; cursor: pointer; border-radius: 8px;" onclick="return confirm('Are you sure you want to delete this user?');">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

</body>
</html>
