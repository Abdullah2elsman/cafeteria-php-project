<?php require APPROOT . '/Views/inc/header.php'; ?>
<?php require APPROOT . '/Views/inc/nav.php'; ?>

<main class="admin-main-content">
    <div class="container py-5 product-form-page">
        <div class="premium-form-container">
            <h2 class="product-card-name text-center mb-5" style="font-size: 2.5rem;">Create New Product</h2>
            
            <form action="<?php echo URL_ROOT; ?>/product/add" method="POST" enctype="multipart/form-data">
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
                        <i class="fa-solid fa-cloud-arrow-up fa-2x mb-3 text-muted"></i>
                        <input type="file" name="image" id="productImage" accept="image/*" class="form-control form-control-premium <?php echo isset($data['errors']['image']) ? 'is-invalid' : ''; ?>" onchange="previewImage(this)">
                        <p class="mt-2 text-muted small">JPG, PNG or GIF (Max 2MB)</p>
                        <?php if (isset($data['errors']['image'])) : ?>
                            <span class="invalid-feedback"><?php echo $data['errors']['image']; ?></span>
                        <?php endif; ?>
                        <div id="imagePreviewContainer" class="mt-3 d-none">
                            <img id="imgPreview" src="#" alt="Preview" style="max-width: 150px; border-radius: 12px; box-shadow: var(--shadow-premium);">
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-3 mt-5">
                    <a href="<?php echo URL_ROOT; ?>/product" class="btn btn-outline-secondary w-50" style="border-radius: 20px; padding: 1.2rem; border-width: 2px;">Cancel</a>
                    <button type="submit" class="btn btn-premium-submit w-50">Create Product</button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
function previewImage(input) {
    const container = document.getElementById('imagePreviewContainer');
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

<?php require APPROOT . '/Views/inc/footer.php'; ?>