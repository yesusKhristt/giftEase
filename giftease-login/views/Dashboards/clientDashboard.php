<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Giftease Client Dashboard</title>
  <link rel="stylesheet" href="public/style2.css">
</head>
<body>
    <div class="sidebar">
        <h2>Ease</h2>
        <a href="#" class="active" onclick="setActive(this)">Dashboard</a>
        <a href="#" onclick="setActive(this)">Orders</a>
        <a href="#" onclick="setActive(this)">Inventory</a>
        <a href="#" onclick="setActive(this)">Analytics</a>
        <a href="#" onclick="setActive(this)">Messages</a>
        <a href="#" onclick="setActive(this)">Settings</a>
    </div>

    <div class="main">
        <div class="topbar">
            <h3>Welcome, Client</h3>
            <div>
                <span onclick="showNotifications()">
                    🔔
                    <div class="notification-badge"></div>
                </span>
                <span onclick="showProfile()">👤</span>
            </div>
        </div>

        <div class="cards">
            <div class="card orders-card">
                <h4>
                    <svg class="card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Recent Orders
                </h4>
                <div id="orders">
                    <div class="loading"></div>
                    <span style="margin-left: 8px;">Loading orders...</span>
                </div>
            </div>

            <div class="card">
                <h4>
                    <svg class="card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Order Summary
                </h4>
                <div class="summary-stats">
                    <div class="stat-item">
                        <div class="stat-value">12</div>
                        <div class="stat-label">Total Orders</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">$450</div>
                        <div class="stat-label">Total Spent</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">3</div>
                        <div class="stat-label">Pending</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">9</div>
                        <div class="stat-label">Completed</div>
                    </div>
                </div>
            </div>

            <div class="card">
                <h4>
                    <svg class="card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    Popular Gifts
                </h4>
                <p style="margin-bottom: 8px;">Trending gift choices this month:</p>
                <div class="popular-gifts">
                    <span class="gift-tag">🍫 Chocolate Box</span>
                    <span class="gift-tag">💐 Flower Bouquet</span>
                    <span class="gift-tag">🎁 Custom Gift Box</span>
                    <span class="gift-tag">🧸 Teddy Bear</span>
                </div>
            </div>

            <div class="card">
                <h4>
                    <svg class="card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    Messages
                </h4>
                <p style="color: #d13d2f; font-weight: 500; margin-bottom: 12px;">You have 3 new messages.</p>
                <div class="messages-preview">
                    <div class="message-item">
                        <div class="message-avatar">GE</div>
                        <div class="message-content">
                            <div class="message-sender">giftEase Support</div>
                            <div class="message-text">Your order #1234 is ready for pickup</div>
                        </div>
                    </div>
                    <div class="message-item">
                        <div class="message-avatar">CS</div>
                        <div class="message-content">
                            <div class="message-sender">Customer Service</div>
                            <div class="message-text">Thank you for your feedback!</div>
                        </div>
                    </div>
                    <div class="message-item">
                        <div class="message-avatar">PR</div>
                        <div class="message-content">
                            <div class="message-sender">Promotions</div>
                            <div class="message-text">Special discount on Valentine's gifts</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            &copy; 2025 giftEase. All rights reserved.
        </footer>
    </div>

    <script>
        // Simulate loading orders with realistic data
        setTimeout(() => {
            const orders = [
                { id: "#1234", status: "completed", item: "Chocolate Gift Box" },
                { id: "#5678", status: "processing", item: "Flower Bouquet" },
                { id: "#91011", status: "pending", item: "Custom Gift Wrap" }
            ];

            const ordersHtml = orders.map(order => `
                <div class="order-item">
                    <div>
                        <strong>${order.id}</strong><br>
                        <small>${order.item}</small>
                    </div>
                    <span class="order-status status-${order.status}">
                        ${order.status.charAt(0).toUpperCase() + order.status.slice(1)}
                    </span>
                </div>
            `).join('');

            document.getElementById("orders").innerHTML = ordersHtml;
        }, 2000);

        // Navigation functions
        function setActive(element) {
            // Remove active class from all links
            document.querySelectorAll('.sidebar a').forEach(link => {
                link.classList.remove('active');
            });
            // Add active class to clicked link
            element.classList.add('active');
        }

        function showNotifications() {
            alert('Notifications:\n• Order #1234 is ready\n• New promotion available\n• Payment confirmation received');
        }

        function showProfile() {
            alert('Profile menu would open here');
        }

        // Add some interactive hover effects
        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.borderColor = '#d13d2f';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.borderColor = '#e5e7eb';
            });
        });

        // Simulate real-time updates
        setInterval(() => {
            const badge = document.querySelector('.notification-badge');
            const randomNum = Math.floor(Math.random() * 5) + 1;
            badge.textContent = randomNum;
            badge.style.display = randomNum > 0 ? 'flex' : 'none';
        }, 10000);

        // Add welcome animation
        window.addEventListener('load', () => {
            document.querySelectorAll('.card').forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>
