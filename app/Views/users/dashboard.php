<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard | Sip & Savor</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/PHP/cafeteria/public/css/dashboard.css">
</head>

<body>

    <!-- Sidebar Navigation -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="/PHP/cafeteria/public" class="sidebar-brand">
                <i class="fa-solid fa-mug-hot"></i> Sip & Savor
            </a>
        </div>

        <nav class="sidebar-nav">
            <a href="/PHP/cafeteria/public/users/dashboard" class="nav-item active">
                <i class="fa-solid fa-border-all"></i> Dashboard
            </a>
            <a href="/PHP/cafeteria/public/users/orders" class="nav-item">
                <i class="fa-solid fa-receipt"></i> Orders
            </a>
            <a href="/PHP/cafeteria/public/users/favorites" class="nav-item">
                <i class="fa-regular fa-heart"></i> Favorites
            </a>
            <a href="/PHP/cafeteria/public/users/history" class="nav-item">
                <i class="fa-solid fa-clock-rotate-left"></i> History
            </a>
            <a href="/PHP/cafeteria/public/users/settings" class="nav-item">
                <i class="fa-solid fa-gear"></i> Settings
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="/PHP/cafeteria/public/auth/logout" class="logout-btn">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
            </a>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="main-content">

        <!-- Header -->
        <header class="dashboard-header">
            <div class="welcome-msg">
                <h1>Welcome back, <?php echo htmlspecialchars($data['user']['name']); ?>!</h1>
                <p>Here's what's happening with your drinks today.</p>
            </div>

            <div class="header-actions">
                <a href="<?php echo URL_ROOT; ?>/orders/create" class="btn-new-order">
                    <i class="fa-solid fa-plus"></i> New Order
                </a>
                <div class="user-profile">
                    <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($data['user']['name']); ?>&background=D4A373&color=fff" alt="User Profile" class="avatar">
                </div>
            </div>
        </header>

        <!-- Summary Cards -->
        <div class="summary-cards">
            <div class="card">
                <div class="card-icon icon-orange">
                    <i class="fa-solid fa-mug-saucer"></i>
                </div>
                <div class="card-info">
                    <h3><?php echo $data['total_orders']; ?></h3>
                    <p>Total Orders</p>
                </div>
            </div>

            <div class="card">
                <div class="card-icon icon-green">
                    <i class="fa-solid fa-wallet"></i>
                </div>
                <div class="card-info">
                    <h3>$<?php echo number_format($data['total_spent'], 2); ?></h3>
                    <p>Total Spent</p>
                </div>
            </div>

            <div class="card">
                <div class="card-icon icon-purple">
                    <i class="fa-solid fa-star"></i>
                </div>
                <div class="card-info">
                    <h3><?php echo $data['favorites_count']; ?></h3>
                    <p>Favorites</p>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <section class="recent-orders">
            <div class="section-header">
                <h2>Recent Orders</h2>
                <a href="/PHP/cafeteria/public/users/orders" class="view-all">View All</a>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Order Details</th>
                            <th>Date</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data['recent_orders'])): ?>
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 2rem; color: var(--color-text-muted);">
                                    No orders yet. <a href="<?php echo URL_ROOT; ?>#menu">Explore the menu</a> to place your first order!
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($data['recent_orders'] as $order): ?>
                            <tr>
                                <td>
                                    <div class="order-items">
                                        <img src="<?php echo $order['image_url']; ?>" class="order-img" alt="<?php echo htmlspecialchars($order['product_name']); ?>">
                                        <div>
                                            <div class="order-name"><?php echo htmlspecialchars($order['product_name']); ?> x<?php echo $order['quantity']; ?></div>
                                            <div style="color: var(--color-text-muted); font-size: 0.85rem;">Order #ORD-<?php echo str_pad($order['id'], 4, '0', STR_PAD_LEFT); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="order-date"><?php echo date('M j, Y h:i A', strtotime($order['created_at'])); ?></div>
                                </td>
                                <td style="font-weight: 600;">$<?php echo number_format($order['total_amount'], 2); ?></td>
                                <td>
                                    <span class="status-badge status-<?php echo $order['status']; ?>">
                                        <?php echo ucfirst($order['status']); ?>
                                    </span>
                                </td>
                                <td><a href="#" class="action-btn"><i class="fa-solid fa-chevron-right"></i></a></td>
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