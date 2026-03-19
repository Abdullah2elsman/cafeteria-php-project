<?php require APPROOT . '/Views/inc/header.php'; ?>
<?php require APPROOT . '/Views/inc/nav.php'; ?>

<main class="admin-main-content">
    <div class="container mt-4 products-page">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="product-card-name" style="font-size: 2.5rem; margin-bottom: 0.5rem;">User Management</h1>
                <p class="text-muted">Manage system users, administrators, and their details.</p>
            </div>
            <a href="<?php echo URL_ROOT; ?>/users/add" class="header-action-btn">
                <i class="fa-solid fa-user-plus"></i> Add New User
            </a>
        </div>

        <?php flash('user_success'); ?>
        <?php flash('user_error'); ?>

        <div class="products-grid">
            <?php if (!empty($data['users'])) : ?>
                <?php foreach ($data['users'] as $u) : ?>
                    <div class="product-premium-card">
                        <div class="product-card-image" style="height: 180px;">
                            <?php if (!empty($u['profile_image'])) : ?>
                                <img src="<?php echo URL_ROOT . '/' . $u['profile_image']; ?>"
                                     alt="<?php echo htmlspecialchars($u['name']); ?>" style="object-position: center; object-fit: cover;">
                            <?php else : ?>
                                <div class="d-flex align-items-center justify-content-center h-100 bg-light text-muted">
                                    <i class="fa-solid fa-user fa-3x"></i>
                                </div>
                            <?php endif; ?>
                            
                            <div class="product-card-badge" style="background: <?php echo $u['role'] === 'admin' ? 'rgba(255,193,7,0.85)' : 'rgba(255,255,255,0.85)'; ?>;">
                                <?php echo ucfirst(htmlspecialchars($u['role'])); ?>
                            </div>
                        </div>

                        <div class="product-card-content">
                            <span class="product-card-category"><?php echo htmlspecialchars($u['email']); ?></span>
                            <h3 class="product-card-name"><?php echo htmlspecialchars($u['name']); ?></h3>
                            <p class="product-card-desc mb-1" style="display: block; -webkit-line-clamp: unset;">
                                <i class="fa-solid fa-door-open me-2 text-muted"></i> Room: <?php echo htmlspecialchars($u['room_no'] ?? 'N/A'); ?>
                            </p>
                            <p class="product-card-desc mb-0" style="display: block; -webkit-line-clamp: unset;">
                                <i class="fa-solid fa-phone me-2 text-muted"></i> Ext: <?php echo htmlspecialchars($u['ext'] ?? 'N/A'); ?>
                            </p>
                        </div>

                        <div class="product-card-footer">
                            <div class="product-card-price" style="font-size: 1rem; color: var(--color-text-muted);">
                                Joined: <?php echo date('M Y', strtotime($u['created_at'])); ?>
                            </div>
                            <div class="product-card-actions">
                                <a href="<?php echo URL_ROOT; ?>/users/edit/<?php echo $u['id']; ?>" 
                                   class="btn-icon btn-edit-icon" title="Edit User">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                
                                <form action="<?php echo URL_ROOT; ?>/users/delete/<?php echo $u['id']; ?>" method="POST" 
                                      onsubmit="return confirm('Securely delete this user?')">
                                    <button type="submit" class="btn-icon btn-delete-icon" title="Delete User">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="premium-form-container text-center py-5" style="grid-column: 1 / -1;">
                    <i class="fa-solid fa-users-slash fa-4x mb-4 text-muted" style="opacity: 0.3;"></i>
                    <h3 class="text-muted">No users found.</h3>
                    <p class="mb-4">Begin by adding your first user.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php require APPROOT . '/Views/inc/footer.php'; ?>
