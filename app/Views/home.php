<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafeteria | Premium Drinks eCommerce</title>
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Link to custom CSS -->
    <link rel="stylesheet" href="/PHP/cafeteria/public/css/home.css">
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar">
        <a href="/PHP/cafeteria/public" class="nav-brand">Sip & Savor</a>
        
        <ul class="nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#menu">Menu</a></li>
            <li><a href="#features">About</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>

        <div class="nav-icons">
            <a href="/PHP/cafeteria/public/auth/login" title="User Login"><i class="fa-regular fa-user"></i></a>
            <div class="cart-icon">
                <i class="fa-solid fa-bag-shopping"></i>
                <span class="cart-count">3</span>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero" id="home">
        <div class="hero-content">
            <div class="hero-subtitle">Artisanal Beverages</div>
            <h1>Elevate Your Daily Ritual.</h1>
            <p>Discover our meticulously crafted selection of premium coffees, organic teas, and refreshing smoothies delivered straight to your door.</p>
            <div class="hero-buttons">
                <a href="#menu" class="btn btn-primary">Explore Menu</a>
                <a href="#features" class="btn btn-outline">Our Story</a>
            </div>
        </div>
    </header>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="feature-item">
            <i class="fa-solid fa-seedling feature-icon"></i>
            <h3 class="feature-title">Organic Excellence</h3>
            <p class="feature-desc">Source from sustainable farms worldwide, ensuring the highest quality organic ingredients.</p>
        </div>
        <div class="feature-item">
            <i class="fa-solid fa-mug-hot feature-icon"></i>
            <h3 class="feature-title">Expertly Crafted</h3>
            <p class="feature-desc">Roasted and prepared by award-winning baristas passionate about the perfect cup.</p>
        </div>
        <div class="feature-item">
            <i class="fa-solid fa-truck-fast feature-icon"></i>
            <h3 class="feature-title">Fast Delivery</h3>
            <p class="feature-desc">Delivered fresh within 30 minutes in our thermal sealed packaging to preserve temperature.</p>
        </div>
    </section>

    <!-- Popular Products Section -->
    <section class="section" id="menu">
        <div class="section-header">
            <div class="section-subtitle">Our Bestsellers</div>
            <h2 class="section-title">Curated Favorites</h2>
        </div>

        <div class="products-grid">
            <!-- Product 1 -->
            <div class="product-card">
                <div class="product-badge">Best Seller</div>
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=500&auto=format&fit=crop" alt="Caramel Macchiato">
                </div>
                <div class="product-details">
                    <div class="product-category">Coffee</div>
                    <h3 class="product-title">Caramel Macchiato</h3>
                    <p class="feature-desc" style="color:var(--color-text-muted); font-size: 0.95rem; line-height:1.4;">Rich espresso with vanilla syrup, organic milk, and buttery caramel drizzle.</p>
                    <div class="product-footer">
                        <div class="product-price">$5.50</div>
                        <button class="add-to-cart-btn" aria-label="Add to cart">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1515823662972-da6a2e4d3002?w=500&auto=format&fit=crop" alt="Matcha Latte">
                </div>
                <div class="product-details">
                    <div class="product-category">Tea</div>
                    <h3 class="product-title">Ceremonial Matcha</h3>
                    <p class="feature-desc" style="color:var(--color-text-muted); font-size: 0.95rem; line-height:1.4;">Premium grade Japanese matcha whisked with your choice of plant-based milk.</p>
                    <div class="product-footer">
                        <div class="product-price">$6.00</div>
                        <button class="add-to-cart-btn" aria-label="Add to cart">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="product-card">
                <div class="product-badge" style="background:var(--color-primary);">New</div>
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1623065422902-30a2d299bbe4?w=500&auto=format&fit=crop" alt="Berry Smoothie">
                </div>
                <div class="product-details">
                    <div class="product-category">Smoothie</div>
                    <h3 class="product-title">Tropical Berry Glow</h3>
                    <p class="feature-desc" style="color:var(--color-text-muted); font-size: 0.95rem; line-height:1.4;">Acai, mixed summer berries, banana, almond milk, and a touch of raw honey.</p>
                    <div class="product-footer">
                        <div class="product-price">$7.50</div>
                        <button class="add-to-cart-btn" aria-label="Add to cart">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1497935586351-b67a49e012bf?w=500&auto=format&fit=crop" alt="Iced Latte">
                </div>
                <div class="product-details">
                    <div class="product-category">Cold Coffee</div>
                    <h3 class="product-title">Valencia Cold Brew</h3>
                    <p class="feature-desc" style="color:var(--color-text-muted); font-size: 0.95rem; line-height:1.4;">18-hour cold steeped coffee, infused with dark chocolate notes and sweet cream.</p>
                    <div class="product-footer">
                        <div class="product-price">$6.50</div>
                        <button class="add-to-cart-btn" aria-label="Add to cart">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact">
        <div class="footer-brand">Sip & Savor</div>
        <ul class="footer-links">
            <li><a href="#">FAQ</a></li>
            <li><a href="#">Shipping</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms & Conditions</a></li>
        </ul>
        <div style="margin-bottom: 1.5rem; font-size: 1.5rem; gap: 1rem; display: flex; justify-content: center;">
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
        </div>
        <p>&copy; 2026 Sip & Savor Cafeteria. All rights reserved.</p>
    </footer>

</body>
</html>
