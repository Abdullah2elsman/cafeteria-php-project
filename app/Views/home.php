<?php require_once __DIR__ . '/inc/header.php'; ?>

<?php require_once __DIR__ . '/inc/nav.php'; ?>

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
            <?php foreach($data['products'] as $product): ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="<?php echo $product['image_url']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                </div>
                <div class="product-details">
                    <div class="product-category"><?php echo htmlspecialchars($product['categoryName']); ?></div>
                    <h3 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p class="feature-desc" style="color:var(--color-text-muted); font-size: 0.95rem; line-height:1.4;"><?php echo htmlspecialchars($product['description']); ?></p>
                    <div class="product-footer">
                        <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
                        <button class="add-to-cart-btn" aria-label="Add to cart">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
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

<?php require_once __DIR__ . '/inc/footer.php'; ?>