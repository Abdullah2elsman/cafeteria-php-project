<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products | Admin Panel</title>
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
            <a href="<?php echo URL_ROOT; ?>/admin/prducts" class="nav-item active">
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

    <main class="main-content">
        <header class="dashboard-header">
            <div class="welcome-msg">
                <h1>Products Management</h1>
                <p>Add new beverages, update pricing, and manage inventory.</p>
            </div>

            <div class="header-actions">
                <a href="<?php echo URL_ROOT; ?>/admin/products/add" class="btn-new-order" style="background-color: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none; font-weight: 500;">
                    <i class="fa-solid fa-plus"></i> Add Product
                </a>
                <div class="user-profile">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=D4A373&color=fff" alt="Profile" class="avatar">
                </div>
            </div>
        </header>

        <section class="recent-orders" style="margin-top: 1rem;">
            <div class="section-header">
                <h2>All Products</h2>
            </div>
            
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data['products'])): ?>
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 2rem; color: var(--color-text-muted);">
                                    No products found. Add your first cafe item!
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($data['products'] as $product): ?>
                            <tr>
                                <td>
                                    <div class="order-items">
                                        <?php $imgSrc = !empty($product['image_url']) ? $product['image_url'] : URL_ROOT . '/img/default-product.png'; ?>
                                        <img src="<?php echo $imgSrc; ?>" class="order-img" style="border-radius: 8px;" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                        <div>
                                            <strong class="order-name" style="font-size: 1rem;"><?php echo htmlspecialchars($product['name']); ?></strong>
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo htmlspecialchars($product['categoryName'] ?? 'General'); ?></td>
                                <td style="font-weight: 600;">$<?php echo number_format($product['price'], 2); ?></td>
                                <td>
                                    <?php if(isset($product['is_available']) && $product['is_available'] == 0): ?>
                                        <span class="status-badge" style="background-color: #fee2e2; color: #b91c1c;">Unavailable</span>
                                    <?php else: ?>
                                        <span class="status-badge status-completed">Available</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 10px;">
                                        <a href="<?php echo URL_ROOT; ?>/admin/products/edit/<?php echo $product['productId']; ?>" class="action-btn" title="Edit" style="background-color: #e0e7ff; color: #4338ca;"><i class="fa-solid fa-pen"></i></a>
                                        <a href="<?php echo URL_ROOT; ?>/admin/products/delete/<?php echo $product['productId']; ?>" class="action-btn" title="Delete" style="background-color: #fee2e2; color: #b91c1c;" onclick="return confirm('Are you sure you want to delete this product?');"><i class="fa-solid fa-trash"></i></a>
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
