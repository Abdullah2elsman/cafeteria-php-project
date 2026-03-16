<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | Sip & Savor</title>
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Link to custom CSS -->
    <link rel="stylesheet" href="/PHP/cafeteria/public/css/auth.css">
</head>
<body>

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
            <div class="cart-icon">
                <i class="fa-solid fa-bag-shopping"></i>
                <span class="cart-count">3</span>
            </div>
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
                    <div class="form-input-container">
                        <i class="fa-regular fa-id-badge form-input-icon"></i>
                        <input type="text" id="name" name="name" class="form-input" placeholder="Enter your full name" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="form-input-container">
                        <i class="fa-regular fa-envelope form-input-icon"></i>
                        <input type="email" id="email" name="email" class="form-input" placeholder="Enter your email address" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="form-input-container">
                        <i class="fa-solid fa-lock form-input-icon"></i>
                        <input type="password" id="password" name="password" class="form-input" placeholder="Create a password" required>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 2rem;">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <div class="form-input-container">
                        <i class="fa-solid fa-check-double form-input-icon"></i>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-input" placeholder="Confirm your password" required>
                    </div>
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

</body>
</html>