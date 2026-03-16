<?php require_once __DIR__ . '/../inc/header.php'; ?>

    <!-- Navigation (Matched with home) -->
    <nav class="navbar">
        <a href="/PHP/cafeteria/public" class="nav-brand">Sip & Savor</a>

        <ul class="nav-links">
            <li><a href="/PHP/cafeteria/public#home">Home</a></li>
            <li><a href="/PHP/cafeteria/public#menu">Menu</a></li>
            <li><a href="/PHP/cafeteria/public#features">About</a></li>
            <li><a href="/PHP/cafeteria/public#contact">Contact</a></li>
        </ul>

        <div class="nav-icons">
            <a href="/PHP/cafeteria/public/auth/login" title="User Login"><i class="fa-solid fa-user" style="color: var(--color-primary);"></i></a>
        </div>
    </nav>

    <!-- Register Container -->
    <div class="auth-container">
        <div class="auth-card" style="margin-top: 2rem; max-width: 500px;">
            <h1 class="auth-title">Create Account</h1>
            <p class="auth-subtitle">Join us to start exploring premium beverages.</p>

            <form action="/PHP/cafeteria/public/auth/store" method="POST">

                <div class="form-group">
                    <label for="name" class="form-label">Full Name</label>
                    <div class="form-input-container <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>">
                        <i class="fa-regular fa-id-badge form-input-icon"></i>
                        <input type="text" id="name" name="name" class="form-input" placeholder="Enter your full name" value="<?php echo isset($data['name']) ? $data['name'] : ''; ?>" autofocus>
                    </div>
                    <span class="error-feedback" style="color:#e63946; font-size:0.85rem; margin-top:0.3rem; display:block;"><?php echo isset($data['name_err']) ? $data['name_err'] : ''; ?></span>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="form-input-container <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>">
                        <i class="fa-regular fa-envelope form-input-icon"></i>
                        <input type="email" id="email" name="email" class="form-input" placeholder="Enter your email address" value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>">
                    </div>
                    <span class="error-feedback" style="color:#e63946; font-size:0.85rem; margin-top:0.3rem; display:block;"><?php echo isset($data['email_err']) ? $data['email_err'] : ''; ?></span>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="form-input-container <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>">
                        <i class="fa-solid fa-lock form-input-icon"></i>
                        <input type="password" id="password" name="password" class="form-input" placeholder="Create a password" value="<?php echo isset($data['password']) ? $data['password'] : ''; ?>">
                    </div>
                    <span class="error-feedback" style="color:#e63946; font-size:0.85rem; margin-top:0.3rem; display:block;"><?php echo isset($data['password_err']) ? $data['password_err'] : ''; ?></span>
                </div>

                <div class="form-group" style="margin-bottom: 2rem;">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <div class="form-input-container <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>">
                        <i class="fa-solid fa-check-double form-input-icon"></i>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-input" placeholder="Confirm your password" value="<?php echo isset($data['confirm_password']) ? $data['confirm_password'] : ''; ?>">
                    </div>
                    <span class="error-feedback" style="color:#e63946; font-size:0.85rem; margin-top:0.3rem; display:block;"><?php echo isset($data['confirm_password_err']) ? $data['confirm_password_err'] : ''; ?></span>
                </div>

                <button type="submit" class="btn-auth">
                    Sign Up <i class="fa-solid fa-user-plus"></i>
                </button>

            </form>

            <div class="auth-divider">
                <span>or</span>
            </div>

            <div class="auth-footer">
                Already have an account? <a href="/PHP/cafeteria/public/auth/login">Sign In here</a>
            </div>
        </div>
    </div>

<?php require_once __DIR__ . '/../inc/footer.php'; ?>