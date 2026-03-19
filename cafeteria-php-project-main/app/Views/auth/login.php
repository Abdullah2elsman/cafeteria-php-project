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

    <!-- Login Container -->
    <div class="auth-container">
        <div class="auth-card">
            <h1 class="auth-title">Welcome Back</h1>
            <p class="auth-subtitle">Sign in to your account and explore our menu.</p>

            <?php echo flash('register_success'); ?>

            <form action="/PHP/cafeteria/public/auth/authenticate" method="POST">
                
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="form-input-container <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>">
                        <i class="fa-regular fa-envelope form-input-icon"></i>
                        <input type="email" id="email" name="email" class="form-input" placeholder="Enter your email" value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>" required autofocus>
                    </div>
                    <span class="error-feedback" style="color:#e63946; font-size:0.85rem; margin-top:0.3rem; display:block;"><?php echo isset($data['email_err']) ? $data['email_err'] : ''; ?></span>
                </div>

                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="password" class="form-label">Password</label>
                    <div class="form-input-container <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>">
                        <i class="fa-solid fa-lock form-input-icon"></i>
                        <input type="password" id="password" name="password" class="form-input" placeholder="Enter your password" required>
                    </div>
                    <span class="error-feedback" style="color:#e63946; font-size:0.85rem; margin-top:0.3rem; display:block;"><?php echo isset($data['password_err']) ? $data['password_err'] : ''; ?></span>
                </div>

                <div class="forgot-password">
                    <a href="#">Forgot your password?</a>
                </div>

                <button type="submit" class="btn-auth">
                    Sign In <i class="fa-solid fa-arrow-right-to-bracket"></i>
                </button>
                
            </form>

            <div class="auth-divider">
                <span>or</span>
            </div>

            <div class="auth-footer">
                Don't have an account? <a href="/PHP/cafeteria/public/auth/register">Sign Up here</a>
            </div>
        </div>
    </div>

<?php require_once __DIR__ . '/../inc/footer.php'; ?>