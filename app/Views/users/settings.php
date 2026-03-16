<?php require_once __DIR__ . '/../inc/header.php'; ?>
    <style>
        .settings-grid {
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 2rem;
            margin-top: 1rem;
        }

        .settings-nav {
            background: var(--color-surface);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            height: fit-content;
        }

        .settings-nav-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            color: var(--color-text-muted);
            font-weight: 500;
            border-radius: 10px;
            cursor: pointer;
            transition: var(--transition);
        }

        .settings-nav-item:hover, .settings-nav-item.active {
            background: rgba(212, 163, 115, 0.1);
            color: var(--color-primary-dark);
        }

        .settings-card {
            background: var(--color-surface);
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }

        .settings-card h2 {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-group label {
            font-weight: 500;
            color: var(--color-text-dark);
        }

        .form-control {
            padding: 0.8rem 1rem;
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: 1rem;
            background: #f9f9f9;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--color-primary);
            background: white;
            box-shadow: 0 0 0 3px rgba(212, 163, 115, 0.1);
        }

        .btn-save {
            background: var(--color-primary);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 1rem;
        }

        .btn-save:hover {
            background: var(--color-primary-dark);
            box-shadow: 0 4px 15px rgba(212,163,115,0.4);
        }

        .avatar-upload {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .avatar-upload img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--color-primary);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--color-text-muted);
            color: var(--color-text-muted);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            font-family: var(--font-body);
            font-weight: 500;
            transition: var(--transition);
        }

        .btn-outline:hover {
            border-color: var(--color-primary);
            color: var(--color-primary);
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
            <a href="/PHP/cafeteria/public/users/orders" class="nav-item">
                <i class="fa-solid fa-receipt"></i> Orders
            </a>
            <a href="/PHP/cafeteria/public/users/favorites" class="nav-item">
                <i class="fa-regular fa-heart"></i> Favorites
            </a>
            <a href="/PHP/cafeteria/public/users/history" class="nav-item">
                <i class="fa-solid fa-clock-rotate-left"></i> History
            </a>
            <a href="/PHP/cafeteria/public/users/settings" class="nav-item active">
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
                <h1>Account Settings</h1>
                <p>Manage your account preferences and personal information.</p>
            </div>
        </header>

        <div class="settings-grid">
            
            <div class="settings-nav">
                <div class="settings-nav-item active">
                    <i class="fa-regular fa-user"></i> General Info
                </div>
                <div class="settings-nav-item">
                    <i class="fa-solid fa-lock"></i> Security & Password
                </div>
                <div class="settings-nav-item">
                    <i class="fa-regular fa-credit-card"></i> Payment Methods
                </div>
                <div class="settings-nav-item">
                    <i class="fa-regular fa-bell"></i> Notifications
                </div>
            </div>

            <div class="settings-card">
                <h2>General Information</h2>
                
                <?php flash('settings_message'); ?>

                <form action="<?php echo URL_ROOT; ?>/users/settings" method="POST" enctype="multipart/form-data">
                    
                    <div class="avatar-upload">
                        <?php if(!empty($data['user']['profile_image'])): ?>
                            <img src="<?php echo URL_ROOT . $data['user']['profile_image']; ?>" alt="User Avatar">
                        <?php else: ?>
                            <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($data['user']['name']); ?>&background=D4A373&color=fff" alt="User Avatar">
                        <?php endif; ?>
                        <div>
                            <label for="profile_image" class="btn-outline" style="margin-bottom: 0.5rem; border-color:var(--color-primary); color:var(--color-primary); display:inline-block; cursor:pointer;">Upload new image</label>
                            <input type="file" name="profile_image" id="profile_image" accept="image/jpeg,image/png" style="display:none;">
                            <div style="color:var(--color-text-muted); font-size: 0.85rem;">Max file size: 2MB. JPG or PNG.</div>
                            <?php if(!empty($data['errors']['image_err'])): ?>
                                <small style="color: #dc3545; margin-top: 0.3rem;"><?php echo $data['errors']['image_err']; ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <label>Full Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($data['user']['name']); ?>">
                        <?php if(!empty($data['errors']['name_err'])): ?>
                            <small style="color: #dc3545; margin-top: 0.3rem;"><?php echo $data['errors']['name_err']; ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($data['user']['email']); ?>">
                        <?php if(!empty($data['errors']['email_err'])): ?>
                            <small style="color: #dc3545; margin-top: 0.3rem;"><?php echo $data['errors']['email_err']; ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <label>Phone Number</label>
                        <input type="tel" name="phone" class="form-control" value="<?php echo htmlspecialchars($data['user']['phone'] ?? ''); ?>">
                    </div>

                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <label>Default Shipping Address</label>
                        <textarea class="form-control" name="address" rows="3"><?php echo htmlspecialchars($data['user']['address'] ?? ''); ?></textarea>
                    </div>

                    <button type="submit" class="btn-save">Save Changes</button>
                </form>
            </div>

        </div>

    </main>

<?php require_once __DIR__ . '/../inc/footer.php'; ?>
