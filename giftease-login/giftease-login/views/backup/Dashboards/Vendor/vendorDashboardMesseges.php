<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vendor Messeges</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" href="resources/icon.png">
</head>

<body>
    <?php include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/leftSidebar.php'; ?>
    <div class="main-content">
        <?php include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/topbar.php'; ?>
        <div class="chat-dashboard">
            <div class="client-list">
                <div class="bold">Clients</div>
                <p class="active" onclick="selectClient('Thenuka')">Manjusri</p>
                <p onclick="selectClient('Umaya')">Umaya</p>
                <p onclick="selectClient('Kasun')">Kasun</p>
                <p onclick="selectClient('Nimal')">Nimal</p>
                <p onclick="selectClient('Saman')">Saman</p>
                <p onclick="selectClient('Ruwan')">Ruwan</p>
                <p onclick="selectClient('Chamara')">Chamara</p>
                <p onclick="selectClient('Dilshan')">Dilshan</p>
            </div>

            <div class="message-box">
                <div class="bold">Messages</div>
                <div class="message-history" id="messageHistory">
                    <div class="message client">Hi, can I change the wrap color?</div>
                    <div class="message vendor">No.</div>
                </div>
                <div class="message-input">
                    <input type="text" id="messageInput" placeholder="Type your message..."
                        onkeypress="handleKeyPress(event)">
                    <button onclick="sendMessage()">Send</button>
                </div>
            </div>

            <div class="right_sidebar">
                <div class="profile-section">
                    <div class="profile-picture">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="username">Manjusri</div>
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
                <div class="button-section">
                    <div class="btn1">View Order</div>
                    <div class="btn1">Cancel Order</div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        // Client data
        const clientData = {
            'Thenuka': {
                fullName: 'Thenuka Ranasinghe',
                deadline: '2025-08-10',
                status: 'In Progress',
                value: '$125.00',
                messages: [
                    { type: 'client', text: 'Hi, can I change the wrap color?' },
                    { type: 'vendor', text: 'Sure, please confirm the new color.' },
                    { type: 'client', text: 'I\'d like it in royal blue instead of red.' },
                    { type: 'vendor', text: 'Perfect! I\'ll update your order. The royal blue wrap will look great.' },
                    { type: 'client', text: 'Thank you! When will it be ready?' },
                    { type: 'vendor', text: 'It should be ready by tomorrow evening. I\'ll send you a photo once it\'s done.' }
                ]
            },
            'Umaya': {
                fullName: 'Umaya Perera',
                deadline: '2025-08-15',
                status: 'Pending',
                value: '$89.50',
                messages: [
                    { type: 'client', text: 'Hello! I need a custom gift box for my anniversary.' },
                    { type: 'vendor', text: 'Congratulations! I\'d be happy to help. What size and theme are you looking for?' },
                    { type: 'client', text: 'Something elegant, maybe gold and white theme?' },
                    { type: 'vendor', text: 'That sounds beautiful! Let me prepare some options for you.' }
                ]
            },
            'Kasun': {
                fullName: 'Kasun Silva',
                deadline: '2025-08-12',
                status: 'Completed',
                value: '$67.25',
                messages: [
                    { type: 'client', text: 'Is my order ready for pickup?' },
                    { type: 'vendor', text: 'Yes! Your order is ready. You can pick it up anytime today.' },
                    { type: 'client', text: 'Great! I\'ll be there around 3 PM.' },
                    { type: 'vendor', text: 'Perfect, see you then!' }
                ]
            }
        };

        let currentClient = 'Thenuka';

        function selectClient(clientName) {
            // Remove active class from all clients
            document.querySelectorAll('.client-list p').forEach(p => p.classList.remove('active'));

            // Add active class to selected client
            event.target.classList.add('active');

            currentClient = clientName;
            updateClientDetails(clientName);
            updateMessages(clientName);
        }

        function updateClientDetails(clientName) {
            const client = clientData[clientName];
            if (client) {
                document.getElementById('clientName').textContent = client.fullName;
                document.getElementById('orderDeadline').textContent = `Order Deadline: ${client.deadline}`;
                document.getElementById('orderStatus').textContent = `Status: ${client.status}`;
                document.getElementById('orderValue').textContent = `Order Value: ${client.value}`;
            }
        }

        function updateMessages(clientName) {
            const client = clientData[clientName];
            const messageHistory = document.getElementById('messageHistory');

            if (client && client.messages) {
                messageHistory.innerHTML = '';
                client.messages.forEach(message => {
                    const messageDiv = document.createElement('div');
                    messageDiv.className = `message ${message.type}`;
                    messageDiv.textContent = message.text;
                    messageHistory.appendChild(messageDiv);
                });

                // Scroll to bottom
                messageHistory.scrollTop = messageHistory.scrollHeight;
            }
        }

        function sendMessage() {
            const input = document.getElementById('messageInput');
            const messageText = input.value.trim();

            if (messageText) {
                const messageHistory = document.getElementById('messageHistory');
                const messageDiv = document.createElement('div');
                messageDiv.className = 'message vendor';
                messageDiv.textContent = messageText;
                messageHistory.appendChild(messageDiv);

                // Add to client data
                if (!clientData[currentClient]) {
                    clientData[currentClient] = { messages: [] };
                }
                if (!clientData[currentClient].messages) {
                    clientData[currentClient].messages = [];
                }
                clientData[currentClient].messages.push({ type: 'vendor', text: messageText });

                // Clear input and scroll to bottom
                input.value = '';
                messageHistory.scrollTop = messageHistory.scrollHeight;
            }
        }

        function handleKeyPress(event) {
            if (event.key === 'Enter') {
                sendMessage();
            }
        }

        function viewOrder() {
            alert(`Viewing order for ${clientData[currentClient]?.fullName || currentClient}`);
            // Implement order viewing logic
        }

        function cancelOrder() {
            if (confirm(`Are you sure you want to cancel the order for ${clientData[currentClient]?.fullName || currentClient}?`)) {
                alert('Order cancelled successfully');
                // Implement order cancellation logic
            }
        }

        // Initialize with default client
        updateClientDetails(currentClient);
        updateMessages(currentClient);
    </script>
</body>

</html>