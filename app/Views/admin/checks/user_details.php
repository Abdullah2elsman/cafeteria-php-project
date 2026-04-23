<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Detail Checks | Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/css/dashboard.css">
    <style>
        .filter-form {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            align-items: flex-end;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .filter-group label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--color-text-muted);
        }
        .filter-group input {
            padding: 10px 15px;
            border: 1px solid var(--color-border);
            border-radius: 8px;
            font-family: inherit;
        }
        .order-card {
            background: var(--color-surface);
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 14px;
            padding: 1rem;
            margin-bottom: 1rem;
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
        .order-total {
            margin-top: 0.7rem;
            text-align: right;
            font-weight: 700;
            color: var(--color-primary-dark);
        }
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
            color: var(--color-primary-dark);
            margin-bottom: 1rem;
            font-weight: 600;
        }
    </style>
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
            <a href="<?php echo URL_ROOT; ?>/admin/users" class="nav-item">
                <i class="fa-solid fa-users"></i> Users
            </a>
            <a href="<?php echo URL_ROOT; ?>/checks" class="nav-item active">
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
        <a href="<?php echo URL_ROOT; ?>/checks" class="back-link"><i class="fa-solid fa-arrow-left"></i> Back to Checks</a>
        <header class="dashboard-header">
            <div class="welcome-msg">
                <h1>Details for <?php echo htmlspecialchars($data['target_user']['name']); ?></h1>
                <p>Specific order breakdown.</p>
            </div>
            
            <div style="font-size: 1.4rem; font-weight: bold; padding: 10px 20px; background: white; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); color: #059669;">
               Filtered Total: $<?php echo number_format($data['total_filtered_revenue'], 2); ?>
            </div>
        </header>

        <section style="margin-top: 1.5rem;">
            <!-- Filters -->
            <form method="GET" action="<?php echo URL_ROOT; ?>/checks/user/<?php echo $data['target_user']['id']; ?>" class="filter-form">
                <div class="filter-group">
                    <label for="date_from">Date From</label>
                    <input type="date" id="date_from" name="date_from" value="<?php echo htmlspecialchars($data['date_from']); ?>">
                </div>
                <div class="filter-group">
                    <label for="date_to">Date To</label>
                    <input type="date" id="date_to" name="date_to" value="<?php echo htmlspecialchars($data['date_to']); ?>">
                </div>
                <div class="filter-group">
                    <button type="submit" class="btn-auth" style="padding: 10px 20px; font-size: 0.95rem;">
                        <i class="fa-solid fa-filter"></i> Apply Dates
                    </button>
                </div>
            </form>

            <section class="orders-list">
                <?php if (empty($data['orders'])): ?>
                    <div class="order-card">
                        <p>No orders found for this user within the selected dates.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($data['orders'] as $order): ?>
                        <article class="order-card">
                            <div class="order-head">
                                <div>
                                    <div class="order-id">Order #ORD-<?php echo str_pad($order['id'], 4, '0', STR_PAD_LEFT); ?></div>
                                    <div class="order-date"><?php echo date('M j, Y h:i A', strtotime($order['created_at'])); ?></div>
                                </div>
                                <div>
                                    <div style="display: flex; gap: 10px; align-items: center;">
                                        <span class="status-badge <?php echo htmlspecialchars($order['status_meta']['class']); ?>">
                                            <?php echo htmlspecialchars($order['status_meta']['label']); ?>
                                        </span>
                                        <?php 
                                            $currentStatus = strtolower($order['status']);
                                            $nextStatus = '';
                                            $nextLabel = '';
                                            if ($currentStatus === 'pending') { $nextStatus = 'processing'; $nextLabel = 'Mark Processing'; }
                                            elseif ($currentStatus === 'processing') { $nextStatus = 'out_for_delivery'; $nextLabel = 'Mark Out For Delivery'; }
                                            elseif ($currentStatus === 'out_for_delivery') { $nextStatus = 'done'; $nextLabel = 'Mark Done'; }
                                            
                                            if ($nextStatus !== ''):
                                        ?>
                                        <form method="POST" action="<?php echo URL_ROOT; ?>/checks/updateStatus/<?php echo $order['id']; ?>" style="margin:0;">
                                            <input type="hidden" name="user_id" value="<?php echo $data['target_user']['id']; ?>">
                                            <input type="hidden" name="status" value="<?php echo $nextStatus; ?>">
                                            <button type="submit" style="background:#4338ca; color:white; border:none; padding:4px 10px; border-radius:6px; font-size:0.8rem; cursor:pointer;" title="Advance Order Status">
                                                <i class="fa-solid fa-arrow-right"></i> <?php echo $nextLabel; ?>
                                            </button>
                                        </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <details>
                                <summary>View items (<?php echo count($order['items']); ?>)</summary>
                                <div class="order-items-list">
                                    <?php foreach ($order['items'] as $item): ?>
                                        <div class="order-item-row">
                                            <div style="display: flex; gap: 10px; align-items: center;">
                                                 <img src="<?php echo strpos($item['image_url'], 'http') === 0 ? $item['image_url'] : URL_ROOT . '/' . $item['image_url']; ?>" alt="<?php echo htmlspecialchars($item['product_name']); ?>" style="width:40px; height:40px; border-radius: 8px; object-fit: cover;">
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

                            <div class="order-total">Total: $<?php echo number_format($order['total_amount'], 2); ?></div>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </section>
        </section>
    </main>

</body>
</html>
