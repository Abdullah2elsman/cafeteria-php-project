<?php require APPROOT . '/Views/inc/header.php'; ?>
<?php require APPROOT . '/Views/inc/nav.php'; ?>

<main class="admin-main-content">
    <div class="container py-5 product-form-page">
        <div class="premium-form-container">
            <h2 class="product-card-name text-center mb-5" style="font-size: 2.5rem;">Create New User</h2>
            
            <form action="<?php echo URL_ROOT; ?>/users/add" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-premium">
                            <label class="form-label-premium">Full Name</label>
                            <input type="text" name="name" 
                                   class="form-control form-control-premium <?php echo isset($data['errors']['name']) ? 'is-invalid' : ''; ?>" 
                                   value="<?php echo htmlspecialchars($data['name']); ?>" placeholder="e.g. John Doe">
                            <?php if (isset($data['errors']['name'])) : ?>
                                <span class="invalid-feedback"><?php echo $data['errors']['name']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-premium">
                            <label class="form-label-premium">Email Address</label>
                            <input type="email" name="email" 
                                   class="form-control form-control-premium <?php echo isset($data['errors']['email']) ? 'is-invalid' : ''; ?>" 
                                   value="<?php echo htmlspecialchars($data['email']); ?>" placeholder="john@example.com">
                            <?php if (isset($data['errors']['email'])) : ?>
                                <span class="invalid-feedback"><?php echo $data['errors']['email']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-premium">
                            <label class="form-label-premium">Room Number</label>
                            <input type="text" name="room_no" 
                                   class="form-control form-control-premium <?php echo isset($data['errors']['room_no']) ? 'is-invalid' : ''; ?>" 
                                   value="<?php echo htmlspecialchars($data['room_no']); ?>" placeholder="e.g. 101">
                            <?php if (isset($data['errors']['room_no'])) : ?>
                                <span class="invalid-feedback"><?php echo $data['errors']['room_no']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-premium">
                            <label class="form-label-premium">Extension (Ext)</label>
                            <input type="text" name="ext" 
                                   class="form-control form-control-premium <?php echo isset($data['errors']['ext']) ? 'is-invalid' : ''; ?>" 
                                   value="<?php echo htmlspecialchars($data['ext']); ?>" placeholder="e.g. 4050">
                            <?php if (isset($data['errors']['ext'])) : ?>
                                <span class="invalid-feedback"><?php echo $data['errors']['ext']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="form-group-premium">
                    <label class="form-label-premium">Password</label>
                    <input type="password" name="password" 
                           class="form-control form-control-premium <?php echo isset($data['errors']['password']) ? 'is-invalid' : ''; ?>" 
                           placeholder="Minimum 6 characters">
                    <?php if (isset($data['errors']['password'])) : ?>
                        <span class="invalid-feedback"><?php echo $data['errors']['password']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group-premium">
                    <label class="form-label-premium">Profile Picture</label>
                    <div class="custom-file-premium text-center p-4 border-dashed rounded-3" style="border: 2px dashed rgba(212,163,115,0.3); background: rgba(255,255,255,0.5);">
                        <i class="fa-solid fa-cloud-arrow-up fa-2x mb-3 text-muted"></i>
                        <input type="file" name="profile_image" id="profileImage" accept="image/*" class="form-control form-control-premium <?php echo isset($data['errors']['image']) ? 'is-invalid' : ''; ?>" onchange="previewImage(this)">
                        <p class="mt-2 text-muted small">JPG, PNG or JPEG (Max 2MB)</p>
                        <?php if (isset($data['errors']['image'])) : ?>
                            <span class="invalid-feedback"><?php echo $data['errors']['image']; ?></span>
                        <?php endif; ?>
                        <div id="imagePreviewContainer" class="mt-3 d-none">
                            <img id="imgPreview" src="#" alt="Preview" style="max-width: 150px; border-radius: 50%; box-shadow: var(--shadow-premium); aspect-ratio: 1/1; object-fit: cover;">
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-3 mt-5">
                    <a href="<?php echo URL_ROOT; ?>/users/index" class="btn btn-outline-secondary w-50" style="border-radius: 20px; padding: 1.2rem; border-width: 2px;">Cancel</a>
                    <button type="submit" class="btn btn-premium-submit w-50">Create User</button>
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
