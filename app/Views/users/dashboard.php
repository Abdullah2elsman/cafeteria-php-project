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
                <h1>Welcome back, Abdullah!</h1>
                <p>Here's what's happening with your drinks today.</p>
            </div>

            <div class="header-actions">
                <a href="/PHP/cafeteria/public#menu" class="btn-new-order">
                    <i class="fa-solid fa-plus"></i> New Order
                </a>
                <div class="user-profile">
                    <img src="https://ui-avatars.com/api/?name=Abdullah+User&background=D4A373&color=fff" alt="User Profile" class="avatar">
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
                    <h3>12</h3>
                    <p>Total Orders</p>
                </div>
            </div>

            <div class="card">
                <div class="card-icon icon-green">
                    <i class="fa-solid fa-wallet"></i>
                </div>
                <div class="card-info">
                    <h3>$45.50</h3>
                    <p>Total Spent</p>
                </div>
            </div>

            <div class="card">
                <div class="card-icon icon-purple">
                    <i class="fa-solid fa-star"></i>
                </div>
                <div class="card-info">
                    <h3>3</h3>
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
                        <!-- Order Row 1 -->
                        <tr>
                            <td>
                                <div class="order-items">
                                    <img src="https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=100&h=100&auto=format&fit=crop" class="order-img" alt="Drink">
                                    <div>
                                        <div class="order-name">Caramel Macchiato x2</div>
                                        <div style="color: var(--color-text-muted); font-size: 0.85rem;">Order #ORD-8439</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="order-date">Today, 09:30 AM</div>
                            </td>
                            <td style="font-weight: 600;">$11.00</td>
                            <td><span class="status-badge status-processing">Processing</span></td>
                            <td><a href="#" class="action-btn"><i class="fa-solid fa-chevron-right"></i></a></td>
                        </tr>

                        <!-- Order Row 2 -->
                        <tr>
                            <td>
                                <div class="order-items">
                                    <img src="https://images.unsplash.com/photo-1515823662972-da6a2e4d3002?w=100&h=100&auto=format&fit=crop" class="order-img" alt="Drink">
                                    <div>
                                        <div class="order-name">Ceremonial Matcha</div>
                                        <div style="color: var(--color-text-muted); font-size: 0.85rem;">Order #ORD-7214</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="order-date">Yesterday, 14:15 PM</div>
                            </td>
                            <td style="font-weight: 600;">$6.00</td>
                            <td><span class="status-badge status-completed">Completed</span></td>
                            <td><a href="#" class="action-btn"><i class="fa-solid fa-chevron-right"></i></a></td>
                        </tr>

                        <!-- Order Row 3 -->
                        <tr>
                            <td>
                                <div class="order-items">
                                    <img src="https://images.unsplash.com/photo-1497935586351-b67a49e012bf?w=100&h=100&auto=format&fit=crop" class="order-img" alt="Drink">
                                    <div>
                                        <div class="order-name">Valencia Cold Brew</div>
                                        <div style="color: var(--color-text-muted); font-size: 0.85rem;">Order #ORD-6621</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="order-date">Mar 12, 10:00 AM</div>
                            </td>
                            <td style="font-weight: 600;">$6.50</td>
                            <td><span class="status-badge status-cancelled">Cancelled</span></td>
                            <td><a href="#" class="action-btn"><i class="fa-solid fa-chevron-right"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

    </main>

</body>

</html>