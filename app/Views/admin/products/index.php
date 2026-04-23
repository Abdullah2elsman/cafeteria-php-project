<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title'] ?? 'Products Management'; ?> | Admin Panel</title>
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
    <div class="container mt-4 products-page">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="product-card-name" style="font-size: 2.5rem; margin-bottom: 0.5rem;">Product Management</h1>
                <p class="text-muted">Manage your cafeteria's menu with elegance.</p>
            </div>
            <a href="<?php echo URL_ROOT; ?>/products/add" class="header-action-btn">
                <i class="fa-solid fa-plus"></i> Add New Product
            </a>
        </div>

        <?php flash('product_success'); ?>
        <?php flash('product_error'); ?>

        <div class="products-grid">
            <?php if (!empty($data['products'])) : ?>
                <?php foreach ($data['products'] as $p) : ?>
                    <div class="product-premium-card">
                        <div class="product-card-image">
                            <?php if (!empty($p['image_url'])) : ?>
                                <img src="<?php echo strpos($p['image_url'], 'http') === 0 ? $p['image_url'] : URL_ROOT . '/' . $p['image_url']; ?>"
                                     alt="<?php echo htmlspecialchars($p['name']); ?>" style="object-fit: cover; aspect-ratio: 16/9; width: 100%;">
                            <?php else : ?>
                                <div class="d-flex align-items-center justify-content-center h-100 bg-light text-muted">
                                    <i class="fa-solid fa-image fa-3x"></i>
                                </div>
                            <?php endif; ?>
                            
                            <div class="product-card-badge">
                                <?php echo $p['is_available'] ? '✓ Available' : '✗ Out'; ?>
                            </div>
                        </div>

                        <div class="product-card-content">
                            <span class="product-card-category"><?php echo htmlspecialchars($p['category_name']); ?></span>
                            <h3 class="product-card-name"><?php echo htmlspecialchars($p['name']); ?></h3>
                            <p class="product-card-desc"><?php echo htmlspecialchars($p['description'] ?? 'No description provided.'); ?></p>
                        </div>

                        <div class="product-card-footer">
                            <div class="product-card-price">$<?php echo number_format($p['price'], 2); ?></div>
                            <div class="product-card-actions">
                                <a href="<?php echo URL_ROOT; ?>/products/edit/<?php echo $p['id']; ?>" 
                                   class="btn-icon btn-edit-icon" title="Edit Product">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                
                                <form action="<?php echo URL_ROOT; ?>/products/delete/<?php echo $p['id']; ?>" method="POST" 
                                      onsubmit="return confirm('Securely delete this item?')">
                                    <button type="submit" class="btn-icon btn-delete-icon" title="Delete Product">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>

                                <form action="<?php echo URL_ROOT; ?>/products/toggle/<?php echo $p['id']; ?>" method="POST">
                                    <button type="submit" class="btn-icon" 
                                            style="background: <?php echo $p['is_available'] ? 'rgba(40, 167, 69, 0.1)' : 'rgba(108, 117, 125, 0.1)'; ?>; 
                                                   color: <?php echo $p['is_available'] ? '#28a745' : '#6c757d'; ?>;"
                                            title="Toggle Availability">
                                        <i class="fa-solid <?php echo $p['is_available'] ? 'fa-eye' : 'fa-eye-slash'; ?>"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="premium-form-container text-center py-5" style="grid-column: 1 / -1;">
                    <i class="fa-solid fa-box-open fa-4x mb-4 text-muted" style="opacity: 0.3;"></i>
                    <h3 class="text-muted">Your menu is currently empty.</h3>
                    <p class="mb-4">Begin by adding your first premium item.</p>
                    <a href="<?php echo URL_ROOT; ?>/products/add" class="btn btn-primary" style="background: var(--color-primary); border-radius: 50px; padding: 0.8rem 2rem;">
                        Create First Product
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
</body>
</html>