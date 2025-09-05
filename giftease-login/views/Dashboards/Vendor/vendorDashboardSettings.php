<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delivery Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php
        $activePage = 'settings';
        include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/leftSidebar.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Settings</h1>
                <p class="subtitle">Manage your account preferences and delivery settings.</p>
            </div>

            <div class="settings-section">
                <h3>Profile Information</h3>
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-input" value="Alex Rodriguez" placeholder="Enter your full name" />
                </div>
                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="tel" class="form-input" value="+1 (555) 123-4567"
                        placeholder="Enter your phone number" />
                </div>
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-input" value="alex.rodriguez@gifteasy.com"
                        placeholder="Enter your email" />
                </div>

                <div class="settings-section">
                    <h3>Vendor Information</h3>

                </div>

                <div class="settings-section">
                    <h3>Notification Preferences</h3>
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                        <span>New order notifications</span>
                        <div class="toggle-switch active" onclick="toggleNotification(this)">
                            <div class="toggle-slider"></div>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                        <span>Text update alerts</span>
                        <div class="toggle-switch active" onclick="toggleNotification(this)">
                            <div class="toggle-slider"></div>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                        <span>Customer rating notifications</span>
                        <div class="toggle-switch" onclick="toggleNotification(this)">
                            <div class="toggle-slider"></div>
                        </div>
                    </div>
                </div>

                <div class="settings-section">
                    <h3>Payment Information</h3>
                    <div class="form-group">
                        <label class="form-label">Bank Account Number</label>
                        <input type="text" class="form-input" value="****-****-****-1234"
                            placeholder="Enter account number" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Routing Number</label>
                        <input type="text" class="form-input" value="021000021" placeholder="Enter routing number" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Payment Schedule</label>
                        <select class="form-select">
                            <option>Weekly</option>
                            <option>Bi-weekly</option>
                            <option>Monthly</option>
                        </select>
                    </div>
                </div>

                <div style="display: flex; gap: 15px;">
                    <button class="btn1" onclick="saveSettings()">Save Changes</button>
                    <button class="btn1" onclick="resetSettings()">Reset</button>
                </div>
            </div>

            <!-- </div> -->



        </div>
    </div>


    <script src="main.js"></script>
</body>

</html>