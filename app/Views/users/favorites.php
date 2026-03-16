<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Favorites | Sip & Savor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/PHP/cafeteria/public/css/dashboard.css">
    <style>
        .favorites-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .favorite-card {
            background: var(--color-surface);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
            border: 1px solid rgba(0,0,0,0.02);
            position: relative;
            transition: var(--transition);
        }

        .favorite-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        }

        .heart-icon {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255,255,255,0.9);
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #d62828;
            cursor: pointer;
            z-index: 10;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: var(--transition);
        }

        .heart-icon:hover {
            transform: scale(1.1);
        }

        .favorite-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .favorite-info {
            padding: 1.5rem;
        }

        .favorite-title {
            font-family: var(--font-heading);
            font-size: 1.3rem;
            flex: 1;
        }

        .favorite-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }

        .favorite-price {
            font-weight: 700;
            color: var(--color-primary-dark);
            font-size: 1.2rem;
        }

        .btn-add {
            background: var(--color-primary);
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 50px;
            font-weight: 600;
            font-family: var(--font-body);
            cursor: pointer;
            transition: var(--transition);
        }
        
        .btn-add:hover {
            background: var(--color-primary-dark);
        }
    </style>
</head>
<body>

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
            <a href="/PHP/cafeteria/public/users/favorites" class="nav-item active">
                <i class="fa-solid fa-heart"></i> Favorites
            </a>
            <a href="/PHP/cafeteria/public/users/history" class="nav-item">
                <i class="fa-solid fa-clock-rotate-left"></i> History
            </a>
            <a href="/PHP/cafeteria/public/users/settings" class="nav-item">
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
                <h1>My Favorites</h1>
                <p>Your curated collection of go-to beverages.</p>
            </div>
        </header>

        <div class="favorites-grid">
            <!-- Favorite 1 -->
            <div class="favorite-card">
                <div class="heart-icon"><i class="fa-solid fa-heart"></i></div>
                <img src="https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=500&auto=format&fit=crop" alt="Caramel Macchiato" class="favorite-img">
                <div class="favorite-info">
                    <div class="favorite-title">Caramel Macchiato</div>
                    <div style="color:var(--color-text-muted); font-size: 0.9rem; margin-top: 0.3rem;">Coffee</div>
                    <div class="favorite-footer">
                        <div class="favorite-price">$5.50</div>
                        <button class="btn-add">Add to Cart</button>
                    </div>
                </div>
            </div>

            <!-- Favorite 2 -->
            <div class="favorite-card">
                <div class="heart-icon"><i class="fa-solid fa-heart"></i></div>
                <img src="https://images.unsplash.com/photo-1515823662972-da6a2e4d3002?w=500&auto=format&fit=crop" alt="Ceremonial Matcha" class="favorite-img">
                <div class="favorite-info">
                    <div class="favorite-title">Ceremonial Matcha</div>
                    <div style="color:var(--color-text-muted); font-size: 0.9rem; margin-top: 0.3rem;">Tea</div>
                    <div class="favorite-footer">
                        <div class="favorite-price">$6.00</div>
                        <button class="btn-add">Add to Cart</button>
                    </div>
                </div>
            </div>

            <!-- Favorite 3 -->
            <div class="favorite-card">
                <div class="heart-icon"><i class="fa-solid fa-heart"></i></div>
                <img src="https://images.unsplash.com/photo-1623065422902-30a2d299bbe4?w=500&auto=format&fit=crop" alt="Tropical Berry Glow" class="favorite-img">
                <div class="favorite-info">
                    <div class="favorite-title">Tropical Berry Glow</div>
                    <div style="color:var(--color-text-muted); font-size: 0.9rem; margin-top: 0.3rem;">Smoothie</div>
                    <div class="favorite-footer">
                        <div class="favorite-price">$7.50</div>
                        <button class="btn-add">Add to Cart</button>
                    </div>
                </div>
            </div>
            
        </div>

    </main>

</body>
</html>
