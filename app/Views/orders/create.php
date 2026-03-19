<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($data['title']); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/css/dashboard.css">
    <style>
        .order-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.25rem;
        }

        .order-panel {
            background: var(--color-surface);
            border-radius: 16px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.2rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.04);
        }

        .order-list {
            display: flex;
            flex-direction: column;
            gap: 0.9rem;
            margin-top: 0.8rem;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 0.8rem;
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            padding: 0.75rem;
        }

        .item-main {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            min-width: 0;
        }

        .item-main img {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 10px;
            background: #eee;
        }

        .item-name {
            font-weight: 600;
            color: var(--color-text-dark);
        }

        .item-sub {
            color: var(--color-text-muted);
            font-size: 0.85rem;
        }

        .qty-wrap {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .qty-btn {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: none;
            background: #ececec;
            cursor: pointer;
            font-weight: 700;
        }

        .qty-input {
            width: 60px;
            text-align: center;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            padding: 0.4rem;
        }

        .form-control {
            width: 100%;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 10px;
            padding: 0.6rem 0.75rem;
            font-family: inherit;
            margin-top: 0.3rem;
        }

        .summary-line {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.6rem;
        }

        .summary-line.total {
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            margin-top: 0.8rem;
            padding-top: 0.8rem;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .confirm-btn {
            width: 100%;
            margin-top: 1rem;
            border: none;
            border-radius: 10px;
            padding: 0.75rem;
            background: var(--color-primary-dark);
            color: #fff;
            font-weight: 600;
            cursor: pointer;
        }

        .confirm-btn:hover {
            opacity: 0.92;
        }

        @media (max-width: 992px) {
            .order-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="<?php echo URL_ROOT; ?>" class="sidebar-brand">
                <i class="fa-solid fa-mug-hot"></i> Sip & Savor
            </a>
        </div>

        <nav class="sidebar-nav">
            <a href="<?php echo URL_ROOT; ?>/users/dashboard" class="nav-item">
                <i class="fa-solid fa-border-all"></i> Dashboard
            </a>
            <a href="<?php echo URL_ROOT; ?>/orders/create" class="nav-item active">
                <i class="fa-solid fa-cart-shopping"></i> Create Order
            </a>
            <a href="<?php echo URL_ROOT; ?>/users/orders" class="nav-item">
                <i class="fa-solid fa-receipt"></i> My Orders
            </a>
            <a href="<?php echo URL_ROOT; ?>/users/settings" class="nav-item">
                <i class="fa-solid fa-gear"></i> Settings
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="<?php echo URL_ROOT; ?>/auth/logout" class="logout-btn">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
            </a>
        </div>
    </aside>

    <main class="main-content">
        <header class="dashboard-header" style="margin-bottom: 1rem;">
            <div class="welcome-msg">
                <h1>Create Order</h1>
                <p>Select products, choose your room, add notes, and confirm.</p>
            </div>
        </header>

        <?php flash('order_message'); ?>

        <form method="POST" action="<?php echo URL_ROOT; ?>/orders/store">
            <div class="order-grid">
                <section class="order-panel">
                    <h3>Products</h3>
                    <div class="order-list">
                        <?php if (empty($data['products'])): ?>
                            <p>No products are available right now.</p>
                        <?php else: ?>
                            <?php foreach ($data['products'] as $product): ?>
                                <div class="order-item">
                                    <div class="item-main">
                                        <img src="<?php echo htmlspecialchars($product['image_url'] ?: 'https://via.placeholder.com/48'); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                        <div>
                                            <div class="item-name"><?php echo htmlspecialchars($product['name']); ?></div>
                                            <div class="item-sub">
                                                <?php echo htmlspecialchars($product['category_name'] ?: 'Uncategorized'); ?>
                                                | $<?php echo number_format((float)$product['price'], 2); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="qty-wrap">
                                        <button class="qty-btn js-decrease" type="button">-</button>
                                        <input
                                            class="qty-input js-qty"
                                            type="number"
                                            min="0"
                                            value="0"
                                            name="quantities[<?php echo (int)$product['id']; ?>]"
                                            data-price="<?php echo (float)$product['price']; ?>"
                                        >
                                        <button class="qty-btn js-increase" type="button">+</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </section>

                <section class="order-panel">
                    <h3>Order Details</h3>

                    <label for="room">Delivery Room</label>
                    <select id="room" name="room" class="form-control" required>
                        <option value="">Select room</option>
                        <?php foreach ($data['rooms'] as $room): ?>
                            <option value="<?php echo htmlspecialchars($room); ?>"><?php echo htmlspecialchars($room); ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label for="notes" style="margin-top:0.75rem; display:block;">Notes</label>
                    <textarea id="notes" name="notes" class="form-control" rows="4" placeholder="No sugar, extra hot, etc."></textarea>

                    <div style="margin-top: 1rem;">
                        <h4 style="margin-bottom: 0.6rem;">Summary</h4>
                        <div class="summary-line">
                            <span>Selected Items</span>
                            <span id="selectedItems">0</span>
                        </div>
                        <div class="summary-line total">
                            <span>Total</span>
                            <span id="totalPrice">$0.00</span>
                        </div>
                    </div>

                    <button type="submit" class="confirm-btn">Confirm Order</button>
                </section>
            </div>
        </form>
    </main>

    <script>
        (function () {
            const qtyInputs = Array.from(document.querySelectorAll('.js-qty'));
            const totalPriceEl = document.getElementById('totalPrice');
            const selectedItemsEl = document.getElementById('selectedItems');

            function clampValue(input) {
                let val = parseInt(input.value, 10);
                if (isNaN(val) || val < 0) {
                    val = 0;
                }
                input.value = val;
                return val;
            }

            function updateSummary() {
                let selectedItems = 0;
                let total = 0;

                qtyInputs.forEach(function (input) {
                    const qty = clampValue(input);
                    const price = parseFloat(input.dataset.price || '0');
                    selectedItems += qty;
                    total += qty * price;
                });

                selectedItemsEl.textContent = String(selectedItems);
                totalPriceEl.textContent = '$' + total.toFixed(2);
            }

            document.querySelectorAll('.js-increase').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    const input = btn.parentElement.querySelector('.js-qty');
                    input.value = String(clampValue(input) + 1);
                    updateSummary();
                });
            });

            document.querySelectorAll('.js-decrease').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    const input = btn.parentElement.querySelector('.js-qty');
                    const current = clampValue(input);
                    input.value = String(Math.max(0, current - 1));
                    updateSummary();
                });
            });

            qtyInputs.forEach(function (input) {
                input.addEventListener('input', updateSummary);
            });

            updateSummary();
        })();
    </script>
</body>

</html>
