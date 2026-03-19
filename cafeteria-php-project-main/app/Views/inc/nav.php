<!-- Navigation -->
<nav class="navbar">
    <a href="<?php echo URL_ROOT; ?>" class="nav-brand">Sip & Savor</a>
    
    <ul class="nav-links">
        <li><a href="<?php echo URL_ROOT; ?>#home">Home</a></li>
        <li><a href="<?php echo URL_ROOT; ?>#menu">Menu</a></li>
        <li><a href="<?php echo URL_ROOT; ?>#features">About</a></li>
        <li><a href="<?php echo URL_ROOT; ?>#contact">Contact</a></li>
    </ul>

    <div class="nav-icons">
        <?php if(!isset($data['hide_nav']) || !$data['hide_nav']): ?>
            <a href="<?php echo URL_ROOT; ?>/auth/login" title="User Login"><i class="fa-regular fa-user"></i></a>
            <div class="cart-icon">
                <i class="fa-solid fa-bag-shopping"></i>
                <span class="cart-count">3</span>
            </div>
        <?php endif; ?>
    </div>
</nav>
