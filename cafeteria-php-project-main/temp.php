<?php
require_once __DIR__ . '/app/config/config.php';
require_once __DIR__ . '/app/Core/Database.php';

$db = Database::getInstance();
$db->query("SELECT p.*, c.name as category_name 
            FROM products p 
            JOIN categories c ON p.category_id = c.id 
            ORDER BY c.id, p.name");
$products = $db->resultSet();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products - Preview</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f5f5f5; padding: 2rem; }
        h1 { text-align: center; margin-bottom: 2rem; color: #333; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1.5rem; max-width: 1200px; margin: 0 auto; }
        .card { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .card img { width: 100%; height: 180px; object-fit: cover; }
        .card .info { padding: 1rem; }
        .card .category { font-size: 0.75rem; text-transform: uppercase; color: #999; letter-spacing: 1px; }
        .card .name { font-size: 1.1rem; font-weight: 600; margin: 0.3rem 0; color: #333; }
        .card .desc { font-size: 0.85rem; color: #777; margin-bottom: 0.5rem; }
        .card .price { font-size: 1.2rem; font-weight: 700; color: #D4A373; }
        .card .status { font-size: 0.75rem; padding: 2px 8px; border-radius: 20px; display: inline-block; margin-top: 0.5rem; }
        .available { background: #d4edda; color: #155724; }
        .unavailable { background: #f8d7da; color: #721c24; }
        .count { text-align: center; margin-bottom: 1rem; color: #666; }
    </style>
</head>
<body>
    <h1>☕ All Products Preview</h1>
    <p class="count">Total: <?php echo count($products); ?> products</p>
    <div class="grid">
        <?php foreach($products as $p): ?>
        <div class="card">
            <?php if($p['image_url']): ?>
                <img src="<?php echo $p['image_url']; ?>" alt="<?php echo htmlspecialchars($p['name']); ?>">
            <?php else: ?>
                <div style="width:100%;height:180px;background:#eee;display:flex;align-items:center;justify-content:center;color:#aaa;">No Image</div>
            <?php endif; ?>
            <div class="info">
                <div class="category"><?php echo htmlspecialchars($p['category_name']); ?></div>
                <div class="name"><?php echo htmlspecialchars($p['name']); ?></div>
                <div class="desc"><?php echo htmlspecialchars($p['description']); ?></div>
                <div class="price">$<?php echo number_format($p['price'], 2); ?></div>
                <span class="status <?php echo $p['is_available'] ? 'available' : 'unavailable'; ?>">
                    <?php echo $p['is_available'] ? '✓ Available' : '✗ Unavailable'; ?>
                </span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
