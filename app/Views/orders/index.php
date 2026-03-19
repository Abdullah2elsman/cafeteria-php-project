<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($data['title']); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/css/dashboard.css">
    <style>
        .orders-tools {
            display: flex;
            gap: 0.7rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
            align-items: flex-end;
        }

        .orders-tools .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .orders-tools input {
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            padding: 0.45rem 0.6rem;
        }

        .btn-filter,
        .btn-reset {
            border: none;
            border-radius: 8px;
            padding: 0.5rem 0.9rem;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-filter {
            background: var(--color-primary-dark);
            color: #fff;
        }

        .btn-reset {
            background: #ececec;
            color: #333;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .orders-list {
            display: flex;
            flex-direction: column;
            gap: 0.9rem;
        }

        .order-card {
            background: var(--color-surface);
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 14px;
            padding: 1rem;
        }

        .order-head {
            display: flex;
            justify-content: space-between;
            gap: 0.6rem;
            flex-wrap: wrap;
            margin-bottom: 0.7rem;
        }

        .order-id {
            font-weight: 700;
            font-size: 1.05rem;
        }

        .order-date {
            color: var(--color-text-muted);
            font-size: 0.9rem;
            margin-top: 0.2rem;
        }

        .order-meta {
            display: flex;
            gap: 1.4rem;
            flex-wrap: wrap;
            margin: 0.7rem 0;
            color: var(--color-text-muted);
            font-size: 0.92rem;
        }

        .order-items-list {
            margin-top: 0.6rem;
            display: flex;
            flex-direction: column;
            gap: 0.65rem;
        }

        .order-item-row {
            display: flex;
            justify-content: space-between;
            gap: 0.8rem;
            align-items: center;
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            padding: 0.5rem;
        }

        .order-item-left {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .order-item-left img {
            width: 42px;
            height: 42px;
            object-fit: cover;
            border-radius: 8px;
            background: #eee;
        }

        .order-total {
            margin-top: 0.7rem;
            text-align: right;
            font-weight: 700;
            color: var(--color-primary-dark);
        }

        .cancel-form {
            margin-top: 0.8rem;
        }

        .cancel-btn {
            border: 1px solid #e63946;
            color: #e63946;
            background: transparent;
            border-radius: 8px;
            padding: 0.45rem 0.8rem;
            cursor: pointer;
        }

        .cancel-btn:hover {
            background: rgba(230, 57, 70, 0.08);
        }
    </style>
</head>

<body>
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="<?php echo URL_ROOT; ?>" class="sidebar-brand">
                <i class="fa-solid fa-mug-hot"></i> Sip & Savor
            </a>
        </div>

        <nav class="sidebar-nav">
            <a href="<?php echo URL_ROOT; ?>/users/dashboard" class="nav-item">
                <i class="fa-solid fa-border-all"></i> Dashboard
            </a>
            <a href="<?php echo URL_ROOT; ?>/orders/create" class="nav-item">
                <i class="fa-solid fa-cart-shopping"></i> Create Order
            </a>
            <a href="<?php echo URL_ROOT; ?>/orders" class="nav-item active">
                <i class="fa-solid fa-receipt"></i> My Orders
            </a>
            <a href="<?php echo URL_ROOT; ?>/users/settings" class="nav-item">
                <i class="fa-solid fa-gear"></i> Settings
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="<?php echo URL_ROOT; ?>/auth/logout" class="logout-btn">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
            </a>
        </div>
    </aside>

    <main class="main-content">
        <header class="dashboard-header" style="margin-bottom: 1rem;">
            <div class="welcome-msg">
                <h1>My Orders</h1>
                <p>Track your orders, filter by date, and review product details.</p>
            </div>
            <div class="header-actions">
                <a href="<?php echo URL_ROOT; ?>/orders/create" class="btn-new-order">
                    <i class="fa-solid fa-plus"></i> New Order
                </a>
            </div>
        </header>

        <?php flash('order_message'); ?>

        <form method="GET" action="<?php echo URL_ROOT; ?>/orders" class="orders-tools">
            <div class="form-group">
                <label for="date_from">Date from</label>
                <input type="date" id="date_from" name="date_from" value="<?php echo htmlspecialchars($data['date_from']); ?>">
            </div>
            <div class="form-group">
                <label for="date_to">Date to</label>
                <input type="date" id="date_to" name="date_to" value="<?php echo htmlspecialchars($data['date_to']); ?>">
            </div>
            <button type="submit" class="btn-filter">Apply Filters</button>
            <a href="<?php echo URL_ROOT; ?>/orders" class="btn-reset">Reset</a>
        </form>

        <section class="orders-list">
            <?php if (empty($data['orders'])): ?>
                <div class="order-card">
                    <p>No orders found for the selected filters.</p>
                </div>
            <?php else: ?>
                <?php foreach ($data['orders'] as $order): ?>
                    <article class="order-card">
                        <div class="order-head">
                            <div>
                                <div class="order-id">Order #ORD-<?php echo str_pad((string)$order['id'], 4, '0', STR_PAD_LEFT); ?></div>
                                <div class="order-date"><?php echo date('M j, Y h:i A', strtotime($order['created_at'])); ?></div>
                            </div>
                            <div>
                                <span class="status-badge <?php echo htmlspecialchars($order['status_meta']['class']); ?>">
                                    <?php echo htmlspecialchars($order['status_meta']['label']); ?>
                                </span>
                            </div>
                        </div>

                        <div class="order-meta">
                            <span><strong>Room:</strong> <?php echo htmlspecialchars($order['room']); ?></span>
                            <span><strong>Notes:</strong> <?php echo htmlspecialchars($order['notes']); ?></span>
                        </div>

                        <details>
                            <summary>View products (<?php echo count($order['items']); ?>)</summary>
                            <div class="order-items-list">
                                <?php foreach ($order['items'] as $item): ?>
                                    <div class="order-item-row">
                                        <div class="order-item-left">
                                            <img src="<?php echo htmlspecialchars($item['image_url'] ?: 'https://via.placeholder.com/42'); ?>" alt="<?php echo htmlspecialchars($item['product_name']); ?>">
                                            <div>
                                                <div><?php echo htmlspecialchars($item['product_name']); ?></div>
                                                <small>Qty: <?php echo (int)$item['quantity']; ?> x $<?php echo number_format((float)$item['price_at_time'], 2); ?></small>
                                            </div>
                                        </div>
                                        <strong>$<?php echo number_format(((float)$item['price_at_time']) * ((int)$item['quantity']), 2); ?></strong>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </details>

                        <div class="order-total">Total: $<?php echo number_format((float)$order['total_amount'], 2); ?></div>

                        <?php if (strtolower((string)$order['status']) === 'pending'): ?>
                            <form method="POST" action="<?php echo URL_ROOT; ?>/orders/cancel/<?php echo (int)$order['id']; ?>" class="cancel-form">
                                <button type="submit" class="cancel-btn">Cancel Order</button>
                            </form>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
    </main>
</body>

</html>
