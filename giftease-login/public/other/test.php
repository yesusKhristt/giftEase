<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vendor Messeges</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="resources/icon.png">
</head>

<body>
    <div class="container">
        <div class="left_sidebar">
            <div class="profile-section">
                <div class="profile-picture">
                    <i class="fas fa-user"></i>
                </div>
                <div class="username">Thenuka Ranasinghe</div>
                <div class="rating">
                    <div class="svg-cute-star">
                        <?php
                        function render_stars(float $rating): string
                        {
                            $output = '';
                            $totalStars = 5;

                            for ($i = 1; $i <= $totalStars; $i++) {
                                if ($rating >= $i) {
                                    $output .= '<span class="star filled">★</span>';
                                } else {
                                    $fraction = $rating - ($i - 1);
                                    if ($fraction > 0) {
                                        $percent = (1 - $fraction) * 100;
                                        // Output partial star with inline style for clip-path percentage
                                        $output .= '<span class="star partial" style="--empty-percent: ' . $percent . '%;">★</span>';
                                    } else {
                                        $output .= '<span class="star">★</span>';
                                    }
                                }
                            }
                            return $output;
                        }

                        $rating = 3.3;
                        echo render_stars($rating);
                        echo "<div class='rating-text'>$rating Rating</div>"
                            ?>

                    </div>
                </div>
            </div>

            <nav class="nav-section">
                <a href="#orders" class="nav-item active">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Orders
                </a>
                <a href="#inventory" class="nav-item">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Inventory
                </a>
                <a href="#analysis" class="nav-item">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                    </svg>
                    Analysis
                </a>
                <a href="#messages" class="nav-item">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                    Messages
                </a>
            </nav>

            <div class="button-section">
                <a href="#logout" class="btn">
                    <i class="fas fa-sign-out-alt"></i>
                    Log Out
                </a>
            </div>
        </div>

        <div class="main-content">
            <div class="welcome-card">
                <h1>STUFF!</h1>
            </div>
        </div>

        <div class="right_sidebar">
            <div class="profile-section">
                <div class="profile-picture">
                    <i class="fas fa-user"></i>
                </div>
                <div class="username">Saneth</div>
                <div class="rating">
                    <div class="svg-cute-star">
                        <?php
                        $rating = 3.5;
                        echo render_stars($rating);
                        echo "<div class='rating-text'>$rating Rating</div>"
                            ?>

                    </div>
                </div>

            </div>
            <div class="button-section">
                <div class="btn">View Order</div>
                <div class="btn">Cancel Order</div>
            </div>
        </div>
    </div>

    <script>
        // Add some interactive functionality
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function (e) {
                e.preventDefault();

                // Remove active class from all items
                document.querySelectorAll('.nav-item').forEach(nav => {
                    nav.classList.remove('active');
                });

                // Add active class to clicked item
                this.classList.add('active');
            });
        });

        // Add hover effect to stars
        document.querySelectorAll('.star').forEach(star => {
            star.addEventListener('mouseenter', function () {
                this.style.transform = 'scale(1.2) rotate(15deg)';
            });

            star.addEventListener('mouseleave', function () {
                this.style.transform = 'scale(1) rotate(0deg)';
            });
        });

        // Profile picture click effect
        document.querySelector('.profile-picture').addEventListener('click', function () {
            this.style.transform = 'scale(1.1) rotate(360deg)';
            setTimeout(() => {
                this.style.transform = 'scale(1) rotate(0deg)';
            }, 500);
        });
    </script>
</body>