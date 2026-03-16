<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History | Sip & Savor</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/PHP/cafeteria/public/css/dashboard.css">
    <style>
        .history-container {
            background: var(--color-surface);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.03);
            margin-top: 1rem;
        }

        .timeline {
            position: relative;
            padding-left: 2rem;
            margin-top: 2rem;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background: rgba(0,0,0,0.05);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 2.5rem;
        }

        .timeline-dot {
            position: absolute;
            left: -2.4rem;
            top: 0;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: var(--color-primary);
            border: 3px solid white;
            box-shadow: 0 0 0 2px rgba(212, 163, 115, 0.3);
        }

        .timeline-date {
            font-size: 0.9rem;
            color: var(--color-primary-dark);
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: inline-block;
            background: rgba(212, 163, 115, 0.1);
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
        }

        .timeline-content {
            background: #f9f9f9;
            padding: 1.5rem;
            border-radius: 12px;
            border: 1px solid rgba(0,0,0,0.03);
            margin-top: 0.8rem;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
        }

        .history-table th {
            text-align: left;
            padding-bottom: 1rem;
            color: var(--color-text-muted);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            font-weight: 500;
        }

        .history-table td {
            padding: 1rem 0;
            border-bottom: 1px dashed rgba(0,0,0,0.05);
        }

        .history-table tr:last-child td {
            border-bottom: none;
            padding-bottom: 0;
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
            <a href="/PHP/cafeteria/public/users/favorites" class="nav-item">
                <i class="fa-regular fa-heart"></i> Favorites
            </a>
            <a href="/PHP/cafeteria/public/users/history" class="nav-item active">
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
                <h1>Purchase History</h1>
                <p>A complete timeline of your cravings over the past months.</p>
            </div>
            <div class="header-actions">
                <button class="btn-new-order" style="background: var(--color-text-dark);"><i class="fa-solid fa-download"></i> Export PDF</button>
            </div>
        </header>

        <div class="history-container">
            <div class="timeline">
                
                <!-- Timeline Item 1 -->
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-date">March 2026</div>
                    
                    <div class="timeline-content">
                        <table class="history-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Order ID</th>
                                    <th>Items</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Mar 16, 2026</td>
                                    <td><a href="#" style="color:var(--color-primary); font-weight:600;">#ORD-8439</a></td>
                                    <td>2x Caramel Macchiato</td>
                                    <td style="font-weight: 600;">$11.00</td>
                                </tr>
                                <tr>
                                    <td>Mar 15, 2026</td>
                                    <td><a href="#" style="color:var(--color-primary); font-weight:600;">#ORD-7214</a></td>
                                    <td>1x Ceremonial Matcha</td>
                                    <td style="font-weight: 600;">$6.00</td>
                                </tr>
                                <tr>
                                    <td>Mar 12, 2026</td>
                                    <td><a href="#" style="color:var(--color-primary); font-weight:600;">#ORD-6621</a></td>
                                    <td>1x Valencia Cold Brew</td>
                                    <td style="font-weight: 600;">$6.50</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Timeline Item 2 -->
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-date">February 2026</div>
                    
                    <div class="timeline-content">
                        <table class="history-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Order ID</th>
                                    <th>Items</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Feb 28, 2026</td>
                                    <td><a href="#" style="color:var(--color-primary); font-weight:600;">#ORD-5491</a></td>
                                    <td>1x Tropical Berry Glow</td>
                                    <td style="font-weight: 600;">$7.50</td>
                                </tr>
                                <tr>
                                    <td>Feb 14, 2026</td>
                                    <td><a href="#" style="color:var(--color-primary); font-weight:600;">#ORD-4102</a></td>
                                    <td>2x Caramel Macchiato, 1x Croissant</td>
                                    <td style="font-weight: 600;">$14.50</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </main>

</body>
</html>
