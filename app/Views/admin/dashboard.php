<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Sip & Savor</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/css/dashboard.css">
</head>

<body>

    <!-- Sidebar Navigation -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="<?php echo URL_ROOT; ?>" class="sidebar-brand">
                <i class="fa-solid fa-mug-hot"></i> Admin Panel
            </a>
        </div>

        <nav class="sidebar-nav">
            <a href="<?php echo URL_ROOT; ?>/admin/dashboard" class="nav-item active">
                <i class="fa-solid fa-border-all"></i> Dashboard
            </a>
            <a href="<?php echo URL_ROOT; ?>/admin/prducts" class="nav-item">
                <i class="fa-solid fa-box"></i> Products
            </a>
            <a href="<?php echo URL_ROOT; ?>/admin/users" class="nav-item">
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

    <!-- Main Content Area -->
    <main class="main-content">

        <!-- Header -->
        <header class="dashboard-header">
            <div class="welcome-msg">
                <h1>Admin Dashboard</h1>
                <p>Welcome to the Sip & Savor administrative panel.</p>
            </div>

            <div class="header-actions">
                <div class="user-profile">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=D4A373&color=fff" alt="Admin Profile" class="avatar">
                </div>
            </div>
        </header>

        <!-- Summary Cards -->
        <div class="summary-cards">
            <div class="card">
                <div class="card-icon icon-orange">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="card-info">
                    <h3><?php echo isset($data['total_users']) ? $data['total_users'] : '0'; ?></h3>
                    <p>Total Users</p>
                </div>
            </div>

            <div class="card">
                <div class="card-icon icon-green">
                    <i class="fa-solid fa-box"></i>
                </div>
                <div class="card-info">
                    <h3><?php echo isset($data['total_products']) ? $data['total_products'] : '0'; ?></h3>
                    <p>Total Products</p>
                </div>
            </div>

            <div class="card">
                <div class="card-icon icon-purple">
                    <i class="fa-solid fa-receipt"></i>
                </div>
                <div class="card-info">
                    <h3><?php echo isset($data['total_orders']) ? $data['total_orders'] : '0'; ?></h3>
                    <p>Total Orders</p>
                </div>
            </div>
            
            <div class="card">
                <div class="card-icon icon-green" style="background-color: #d1fae5; color: #059669;">
                    <i class="fa-solid fa-money-bill-wave"></i>
                </div>
                <div class="card-info">
                    <h3>$<?php echo isset($data['total_revenue']) ? number_format($data['total_revenue'], 2) : '0.00'; ?></h3>
                    <p>Total Revenue</p>
                </div>
            </div>
        </div>

        <!-- Recent Activity table -->
        <section class="recent-orders" style="margin-top: 2rem;">
            <div class="section-header">
                <h2>Recent Orders</h2>
            </div>
            
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data['recent_orders'])): ?>
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 2rem; color: var(--color-text-muted);">
                                    No recent orders found.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($data['recent_orders'] as $order): ?>
                            <tr>
                                <td>#ORD-<?php echo str_pad($order['id'], 4, '0', STR_PAD_LEFT); ?></td>
                                <td style="font-weight: bold;"><?php echo htmlspecialchars($order['user_name'] ?? 'User'); ?></td>
                                <td><?php echo date('M j, Y h:i A', strtotime($order['created_at'])); ?></td>
                                <td style="font-weight: 600;">$<?php echo number_format($order['total_amount'], 2); ?></td>
                                <td>
                                    <span class="status-badge status-<?php echo $order['status']; ?>">
                                        <?php echo ucfirst($order['status']); ?>
                                    </span>
                                </td>
                                <td><a href="#" class="action-btn"><i class="fa-solid fa-eye"></i></a></td>
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
