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
    include 'views\commonElements/leftSidebarSaneth.php';
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
          <input type="tel" class="form-input" value="+1 (555) 123-4567" placeholder="Enter your phone number" />
        </div>
        <div class="form-group">
          <label class="form-label">Email Address</label>
          <input type="email" class="form-input" value="alex.rodriguez@gifteasy.com" placeholder="Enter your email" />
        </div>

        <div class="settings-section">
          <h3>Vehicle Information</h3>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
              <label class="form-label">Vehicle Type</label>
              <select class="form-select">
                <option selected>Motorcycle</option>
                <option>Car</option>
                <option>Van</option>
                <option>Bicycle</option>
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">License Plate</label>
              <input type="text" class="form-input" value="MM-7270" />
            </div>
            <div class="form-group">
              <label class="form-label">Insurance Number</label>
              <input type="text" class="form-input" value="INS-789456" />
            </div>
            <div class="form-group">
              <label class="form-label">License Expiry</label>
              <input type="date" class="form-input" value="2025-12-31" />
            </div>
          </div>
        </div>

        <div class="settings-section">
          <h3>Availability Settings</h3>
          <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
            <span>Available for deliveries</span>
            <div class="toggle-switch active" onclick="toggleAvailability(this)">
              <div class="toggle-slider"></div>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Working Hours</label>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
              <input type="time" class="form-input" value="09:00" />
              <input type="time" class="form-input" value="18:00" />
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Maximum Deliveries Per Day</label>
            <input type="number" class="form-input" value="15" min="1" max="50" />
          </div>
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
            <span>Route update alerts</span>
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
            <input type="text" class="form-input" value="****-****-****-1234" placeholder="Enter account number" />
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

      <div id="orderDetailsModal" class="modal">
        <div class="modal-content">
          <div class="modal-header">
            <h2>Order Details</h2>
            <span class="close" onclick="closeModal('orderDetailsModal')">&times;</span>
          </div>
          <div class="modal-body">
            <div class="order-detail-grid">
              <div class="detail-section">
                <h3>Order Information</h3>
                <div class="detail-row">
                  <span class="label">Order ID:</span>
                  <span class="value" id="modalOrderId">DEL-001</span>
                </div>
                <div class="detail-row">
                  <span class="label">Order Date:</span>
                  <span class="value">January 15, 2024</span>
                </div>
                <div class="detail-row">
                  <span class="label">Priority:</span>
                  <span class="value" style="color: #e74c3c; font-weight: bold;">High Priority</span>
                </div>
                <div class="detail-row">
                  <span class="label">Status:</span>
                  <span class="value"><span class="order-status status-pending">Pending</span></span>
                </div>
              </div>

              <div class="detail-section">
                <h3>Product Details</h3>
                <div class="product-item">
                  <img src="/placeholder.svg?height=80&width=80" alt="Product" />
                  <div class="product-info">
                    <h4>Premium Rose Bouquet</h4>
                    <p>Beautiful red roses with premium wrapping</p>
                    <div class="product-specs">
                      <span>Quantity: 1</span>
                      <span>Weight: 2.5 kg</span>
                      <span>Fragile: Yes</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="detail-section">
                <h3>Customer Information</h3>
                <div class="customer-info">
                  <div class="customer-avatar">
                    <i class="fas fa-user"></i>
                  </div>
                  <div class="customer-details">
                    <h4>Sarah Johnson</h4>
                    <p><i class="fas fa-phone"></i> +1 (555) 123-4567</p>
                    <p><i class="fas fa-envelope"></i> sarah.johnson@email.com</p>
                    <p><i class="fas fa-star"></i> Customer Rating: 4.8/5</p>
                  </div>
                </div>
              </div>

              <div class="detail-section">
                <h3>Delivery Address</h3>
                <div class="address-info">
                  <p><strong>123 Main Street</strong></p>
                  <p>Apartment 4B</p>
                  <p>Downtown, NY 10001</p>
                  <p><strong>Delivery Instructions:</strong></p>
                  <div class="delivery-notes">Please ring the doorbell twice. Leave at door if no answer. Call before
                    delivery.</div>
                </div>
                <button class="btn btn-outline" onclick="openMaps()" style="margin-top: 15px;">
                  <i class="fas fa-map-marker-alt"></i> Open in Maps
                </button>
              </div>

              <div class="detail-section">
                <h3>Payment & Earnings</h3>
                <div class="payment-info">
                  <div class="payment-row">
                    <span>Product Total:</span>
                    <span>$89.99</span>
                  </div>
                  <div class="payment-row">
                    <span>Delivery Fee:</span>
                    <span>$15.00</span>
                  </div>
                  <div class="payment-row">
                    <span>Your Earnings:</span>
                    <span>$15.00</span>
                  </div>
                  <div class="payment-row total">
                    <span>Customer Total:</span>
                    <span>$104.99</span>
                  </div>
                </div>
              </div>

              <div class="detail-section">
                <h3>Delivery Timeline</h3>
                <div class="timeline">
                  <div class="timeline-item completed">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                      <h5>Order Placed</h5>
                      <p>Jan 15, 2024 - 10:30 AM</p>
                    </div>
                  </div>
                  <div class="timeline-item completed">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                      <h5>Order Confirmed</h5>
                      <p>Jan 15, 2024 - 10:45 AM</p>
                    </div>
                  </div>
                  <div class="timeline-item active">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                      <h5>Assigned to Delivery</h5>
                      <p>Jan 15, 2024 - 2:15 PM</p>
                    </div>
                  </div>
                  <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                      <h5>Out for Delivery</h5>
                      <p>Pending</p>
                    </div>
                  </div>
                  <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                      <h5>Delivered</h5>
                      <p>Pending</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" onclick="startDeliveryFromModal()">
              <i class="fas fa-truck"></i> Start Delivery
            </button>
            <button class="btn btn-outline" onclick="contactCustomerFromModal()">
              <i class="fas fa-phone"></i> Contact Customer
            </button>
            <button class="btn btn-ghost" onclick="closeModal('orderDetailsModal')">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="main.js"></script>
</body>

</html>