<?php require_once __DIR__ . '/../inc/header.php'; ?>
    <style>
        .filter-tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding-bottom: 1rem;
        }

        .filter-btn {
            background: none;
            border: none;
            font-family: var(--font-body);
            font-size: 1rem;
            font-weight: 500;
            color: var(--color-text-muted);
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: var(--transition);
        }

        .filter-btn:hover {
            color: var(--color-primary-dark);
            background: rgba(212, 163, 115, 0.05);
        }

        .filter-btn.active {
            color: var(--color-primary-dark);
            background: rgba(212, 163, 115, 0.1);
        }

        .order-card {
            background: var(--color-surface);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.02);
            border: 1px solid rgba(0,0,0,0.03);
            transition: var(--transition);
        }

        .order-card:hover {
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transform: translateY(-2px);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }

        .order-id {
            font-family: var(--font-heading);
            font-size: 1.4rem;
            font-weight: 600;
        }

        .order-meta {
            color: var(--color-text-muted);
            font-size: 0.95rem;
            margin-top: 0.2rem;
        }

        .order-item-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .order-item-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .item-details {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .item-img {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            object-fit: cover;
        }

        .item-name {
            font-weight: 600;
        }

        .item-qty {
            color: var(--color-text-muted);
            font-size: 0.9rem;
        }

        .item-price {
            font-weight: 600;
        }

        .order-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(0,0,0,0.05);
        }

        .order-total-label {
            color: var(--color-text-muted);
            font-weight: 500;
        }

        .order-total-amount {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-primary-dark);
        }
        
        .btn-reorder {
            background: transparent;
            color: var(--color-primary-dark);
            border: 2px solid var(--color-primary);
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-family: var(--font-body);
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-reorder:hover {
            background: var(--color-primary);
            color: white;
        }
    </style>

    <!-- Sidebar Navigation -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="/PHP/cafeteria/public" class="sidebar-brand">
                <i class="fa-solid fa-mug-hot"></i> Sip & Savor
            </a>
        </div>

        <nav class="sidebar-nav">
            <a href="/PHP/cafeteria/public/users/dashboard" class="nav-item">
                <i class="fa-solid fa-border-all"></i> Dashboard
            </a>
            <a href="/PHP/cafeteria/public/users/orders" class="nav-item active">
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
        
        <header class="dashboard-header" style="margin-bottom: 1.5rem;">
            <div class="welcome-msg">
                <h1>Order History</h1>
                <p>View and manage all your past and current orders here.</p>
            </div>
        </header>

        <!-- Filter Tabs -->
        <div class="filter-tabs">
            <button class="filter-btn active">All Orders</button>
            <button class="filter-btn">Processing</button>
            <button class="filter-btn">Completed</button>
            <button class="filter-btn">Cancelled</button>
        </div>

        <!-- Orders List -->
        <div class="orders-list">
            
            <!-- Order 1 -->
            <div class="order-card">
                <div class="order-header">
                    <div>
                        <div class="order-id">Order #ORD-8439</div>
                        <div class="order-meta">Placed on March 16, 2026 at 09:30 AM</div>
                    </div>
                    <div>
                        <span class="status-badge status-processing">Processing</span>
                    </div>
                </div>

                <div class="order-item-list">
                    <div class="order-item-row">
                        <div class="item-details">
                            <img src="https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=100&h=100&auto=format&fit=crop" class="item-img" alt="Caramel Macchiato">
                            <div>
                                <div class="item-name">Caramel Macchiato</div>
                                <div class="item-qty">Qty: 2 x $5.50</div>
                            </div>
                        </div>
                        <div class="item-price">$11.00</div>
                    </div>
                </div>

                <div class="order-footer">
                    <button class="btn-reorder"><i class="fa-solid fa-rotate-right"></i> Order Again</button>
                    <div style="text-align: right;">
                        <span class="order-total-label">Total Amount</span>
                        <div class="order-total-amount">$11.00</div>
                    </div>
                </div>
            </div>

            <!-- Order 2 -->
            <div class="order-card">
                <div class="order-header">
                    <div>
                        <div class="order-id">Order #ORD-7214</div>
                        <div class="order-meta">Placed on March 15, 2026 at 14:15 PM</div>
                    </div>
                    <div>
                        <span class="status-badge status-completed">Completed</span>
                    </div>
                </div>

                <div class="order-item-list">
                    <div class="order-item-row">
                        <div class="item-details">
                            <img src="https://images.unsplash.com/photo-1515823662972-da6a2e4d3002?w=100&h=100&auto=format&fit=crop" class="item-img" alt="Ceremonial Matcha">
                            <div>
                                <div class="item-name">Ceremonial Matcha</div>
                                <div class="item-qty">Qty: 1 x $6.00</div>
                            </div>
                        </div>
                        <div class="item-price">$6.00</div>
                    </div>
                </div>

                <div class="order-footer">
                    <button class="btn-reorder"><i class="fa-solid fa-rotate-right"></i> Order Again</button>
                    <div style="text-align: right;">
                        <span class="order-total-label">Total Amount</span>
                        <div class="order-total-amount">$6.00</div>
                    </div>
                </div>
            </div>

            <!-- Order 3 -->
            <div class="order-card">
                <div class="order-header">
                    <div>
                        <div class="order-id">Order #ORD-6621</div>
                        <div class="order-meta">Placed on March 12, 2026 at 10:00 AM</div>
                    </div>
                    <div>
                        <span class="status-badge status-cancelled">Cancelled</span>
                    </div>
                </div>

                <div class="order-item-list">
                    <div class="order-item-row">
                        <div class="item-details">
                            <img src="https://images.unsplash.com/photo-1497935586351-b67a49e012bf?w=100&h=100&auto=format&fit=crop" class="item-img" alt="Valencia Cold Brew">
                            <div>
                                <div class="item-name">Valencia Cold Brew</div>
                                <div class="item-qty">Qty: 1 x $6.50</div>
                            </div>
                        </div>
                        <div class="item-price">$6.50</div>
                    </div>
                </div>

                <div class="order-footer">
                    <button class="btn-reorder"><i class="fa-solid fa-rotate-right"></i> Order Again</button>
                    <div style="text-align: right;">
                        <span class="order-total-label">Total Amount</span>
                        <div class="order-total-amount">$6.50</div>
                    </div>
                </div>
            </div>

        </div>

    </main>

<?php require_once __DIR__ . '/../inc/footer.php'; ?>
