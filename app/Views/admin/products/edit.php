<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title'] ?? 'Edit Product'; ?> | Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/css/dashboard.css">
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="<?php echo URL_ROOT; ?>" class="sidebar-brand">
                <i class="fa-solid fa-mug-hot"></i> Admin Panel
            </a>
        </div>
        <nav class="sidebar-nav">
            <a href="<?php echo URL_ROOT; ?>/admin/dashboard" class="nav-item">
                <i class="fa-solid fa-border-all"></i> Dashboard
            </a>
            <a href="<?php echo URL_ROOT; ?>/admin/prducts" class="nav-item active">
                <i class="fa-solid fa-box"></i> Products
            </a>
            <a href="<?php echo URL_ROOT; ?>/admin/users" class="nav-item">
                <i class="fa-solid fa-users"></i> Users
            </a>
            <a href="<?php echo URL_ROOT; ?>/admin/checks" class="nav-item">
                <i class="fa-solid fa-wallet"></i> Checks
            </a>
        </nav>
        <div class="sidebar-footer">
            <a href="<?php echo URL_ROOT; ?>/auth/logout" class="logout-btn">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
            </a>
        </div>
    </aside>

<main class="main-content">
    <header class="dashboard-header">
        <div class="welcome-msg">
            <h1>Edit Product Details</h1>
        </div>
        <div class="header-actions">
            <div class="user-profile">
                <img src="https://ui-avatars.com/api/?name=Admin&background=D4A373&color=fff" alt="Profile" class="avatar">
            </div>
        </div>
    </header>
    <div class="container py-5 product-form-page">
        <div class="premium-form-container">
            <h2 class="product-card-name text-center mb-5" style="font-size: 2.5rem;">Edit Product Details</h2>
            
            <form action="<?php echo URL_ROOT; ?>/products/edit/<?php echo $data['id']; ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-premium">
                            <label class="form-label-premium">Product Name</label>
                            <input type="text" name="name" 
                                   class="form-control form-control-premium <?php echo isset($data['errors']['name']) ? 'is-invalid' : ''; ?>" 
                                   value="<?php echo htmlspecialchars($data['name']); ?>" placeholder="e.g. Espresso Gold">
                            <?php if (isset($data['errors']['name'])) : ?>
                                <span class="invalid-feedback"><?php echo $data['errors']['name']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-premium">
                            <label class="form-label-premium">Price ($)</label>
                            <input type="number" step="0.01" min="0" name="price" 
                                   class="form-control form-control-premium <?php echo isset($data['errors']['price']) ? 'is-invalid' : ''; ?>" 
                                   value="<?php echo htmlspecialchars($data['price']); ?>" placeholder="0.00">
                            <?php if (isset($data['errors']['price'])) : ?>
                                <span class="invalid-feedback"><?php echo $data['errors']['price']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="form-group-premium">
                    <label class="form-label-premium">Category</label>
                    <select name="category_id" class="form-select form-control-premium <?php echo isset($data['errors']['category']) ? 'is-invalid' : ''; ?>">
                        <option value="">Select a Category</option>
                        <?php foreach($data['categories'] as $cat): ?>
                            <option value="<?php echo $cat['id']; ?>" <?php echo ($data['category_id'] == $cat['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($cat['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($data['errors']['category'])) : ?>
                        <span class="invalid-feedback"><?php echo $data['errors']['category']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group-premium">
                    <label class="form-label-premium">Description</label>
                    <textarea name="description" class="form-control form-control-premium" rows="3" placeholder="Tell us about this item..."><?php echo htmlspecialchars($data['description']); ?></textarea>
                </div>

                <div class="form-group-premium">
                    <label class="form-label-premium">Product Image</label>
                    <div class="custom-file-premium text-center p-4 border-dashed rounded-3" style="border: 2px dashed rgba(212,163,115,0.3); background: rgba(255,255,255,0.5);">
                        <i class="fa-solid fa-image fa-2x mb-3 text-muted"></i>
                        
                        <div id="currentImageWrapper" class="mb-3 <?php echo empty($data['image_url']) ? 'd-none' : ''; ?>">
                            <small class="text-muted d-block mb-2">Current Image</small>
                            <img id="imgPreview" src="<?php echo !empty($data['image_url']) ? (strpos($data['image_url'], 'http') === 0 ? $data['image_url'] : URL_ROOT . '/' . $data['image_url']) : '#'; ?>" 
                                 alt="Preview" style="max-height: 150px; border-radius: 12px; box-shadow: var(--shadow-premium);">
                        </div>

                        <input type="file" name="image" id="productImage" accept="image/*" class="form-control form-control-premium <?php echo isset($data['errors']['image']) ? 'is-invalid' : ''; ?>" onchange="previewImage(this)">
                        <p class="mt-2 text-muted small">Select a new image or leave empty to keep the current one.</p>
                        <?php if (isset($data['errors']['image'])) : ?>
                            <span class="invalid-feedback"><?php echo $data['errors']['image']; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="d-flex gap-3 mt-5">
                    <a href="<?php echo URL_ROOT; ?>/products" class="btn btn-outline-secondary w-50" style="border-radius: 20px; padding: 1.2rem; border-width: 2px;">Cancel</a>
                    <button type="submit" class="btn btn-premium-submit w-50" style="background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%) !important; color: #000 !important; box-shadow: 0 10px 25px rgba(255, 193, 7, 0.3) !important;">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
function previewImage(input) {
    const container = document.getElementById('currentImageWrapper');
    const preview = document.getElementById('imgPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            container.classList.remove('d-none');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

</body>
</html>