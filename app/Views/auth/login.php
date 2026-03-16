<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sip & Savor</title>
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

    <!-- Login Container -->
    <div class="auth-container">
        <div class="auth-card">
            <h1 class="auth-title">Welcome Back</h1>
            <p class="auth-subtitle">Sign in to your account and explore our menu.</p>

            <form action="/PHP/cafeteria/public/auth/authenticate" method="POST">
                
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="form-input-container">
                        <i class="fa-regular fa-envelope form-input-icon"></i>
                        <input type="email" id="email" name="email" class="form-input" placeholder="Enter your email" required autofocus>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="password" class="form-label">Password</label>
                    <div class="form-input-container">
                        <i class="fa-solid fa-lock form-input-icon"></i>
                        <input type="password" id="password" name="password" class="form-input" placeholder="Enter your password" required>
                    </div>
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

</body>
</html>