<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checks & Revenue | Admin Panel</title>
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
        .filter-group input, .filter-group select {
            padding: 10px 15px;
            border: 1px solid var(--color-border);
            border-radius: 8px;
            font-family: inherit;
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
            <a href="<?php echo URL_ROOT; ?>/admin/checks" class="nav-item active">
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
                <h1>Checks and Reports</h1>
                <p>Filter user orders and check revenue between dates.</p>
            </div>

            <div class="header-actions">
                <div class="user-profile">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=D4A373&color=fff" alt="Profile" class="avatar">
                </div>
            </div>
        </header>

        <section style="margin-top: 1.5rem;">
            <!-- Filters -->
            <form method="GET" action="<?php echo URL_ROOT; ?>/admin/checks" class="filter-form">
                <div class="filter-group">
                    <label for="date_from">Date From</label>
                    <input type="date" id="date_from" name="date_from" value="<?php echo isset($_GET['date_from']) ? htmlspecialchars($_GET['date_from']) : ''; ?>">
                </div>
                <div class="filter-group">
                    <label for="date_to">Date To</label>
                    <input type="date" id="date_to" name="date_to" value="<?php echo isset($_GET['date_to']) ? htmlspecialchars($_GET['date_to']) : ''; ?>">
                </div>
                <div class="filter-group">
                    <label for="user_id">User</label>
                    <select id="user_id" name="user_id">
                        <option value="">All Users</option>
                        <?php if(!empty($data['all_users'])): ?>
                            <?php foreach($data['all_users'] as $user): ?>
                                <option value="<?php echo $user['id']; ?>" <?php echo (isset($_GET['user_id']) && $_GET['user_id'] == $user['id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($user['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="filter-group">
                    <button type="submit" class="btn-auth" style="padding: 10px 20px; font-size: 0.95rem;">
                        <i class="fa-solid fa-filter"></i> Filter Results
                    </button>
                </div>
            </form>
            
            <!-- Checks Result -->
            <div class="table-responsive" style="background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); padding: 1rem;">
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Total Orders</th>
                            <th>Total Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data['checks'])): ?>
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 2rem; color: var(--color-text-muted);">
                                    No checks found for the selected criteria.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($data['checks'] as $check): ?>
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($check['user_name']); ?>&background=random&color=fff" alt="Avatar" style="width: 35px; height: 35px; border-radius: 50%;">
                                        <strong><?php echo htmlspecialchars($check['user_name']); ?></strong>
                                    </div>
                                </td>
                                <td><?php echo $check['total_orders']; ?> Orders</td>
                                <td style="font-weight: 600; font-size: 1.1rem; color: var(--color-primary);">$<?php echo number_format($check['total_amount'], 2); ?></td>
                                <td>
                                    <a href="<?php echo URL_ROOT; ?>/admin/checks/user/<?php echo $check['user_id']; ?>" class="action-btn" title="View details" style="background-color: #e0e7ff; color: #4338ca; width: auto; padding: 0.5rem 1rem; border-radius: 8px; text-decoration: none;">View Details</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if(!empty($data['total_filtered_revenue'])): ?>
                <div style="margin-top: 1rem; text-align: right; font-size: 1.2rem; font-weight: bold; background: white; padding: 1rem 1.5rem; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                    Filtered Revenue: <span style="color: #059669;">$<?php echo number_format($data['total_filtered_revenue'], 2); ?></span>
                </div>
            <?php endif; ?>
        </section>
    </main>

</body>
</html>
