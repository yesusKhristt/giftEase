    <?php
    $pricePerKm = 50;
    $total      = null;

    if (isset($_POST['deliveryPrice'])) {
        $total = (float) $_POST['deliveryPrice'];
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Checkout - GiftEase</title>

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <link rel="stylesheet" href="public/client.css" />
        <link rel="stylesheet" href="public/sideTopBar.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

        <style>
            #map {
                height: 380px;
                width: 100%;
                border-radius: 12px;
                cursor: crosshair;
                border: 2px solid #fedbd2;
            }

            .map-hint {
                display: flex;
                align-items: center;
                gap: 8px;
                background: linear-gradient(135deg, #fedbd2, #fff);
                border: 1px solid #d03c2e;
                border-radius: 10px;
                padding: 10px 16px;
                font-size: 13px;
                color: #032e3f;
                margin-bottom: 10px;
            }

            .map-hint i {
                color: #d03c2e;
            }

            .distance-pill {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                background: #032e3f;
                color: #fff;
                border-radius: 25px;
                padding: 8px 18px;
                font-size: 13px;
                font-weight: 600;
                margin: 10px 0 0;
            }

            .distance-pill.unset {
                background: #ddd;
                color: #888;
            }

            .map-error {
                color: #d03c2e;
                font-size: 13px;
                font-weight: 600;
                margin-top: 6px;
                display: none;
            }

            .form-row {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 20px;
            }

            .section-title {
                font-size: 13px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.06em;
                color: #d03c2e;
                margin: 24px 0 12px;
                padding-bottom: 6px;
                border-bottom: 1px solid #fedbd2;
            }
        </style>
    </head>

<body>
    <div class="container">
        <?php
        $activePage = 'cart';
        include 'views/commonElements/leftSidebarDilma.php';
        ?>

        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Checkout</h1>
                <p class="subtitle">Fill in the details and confirm your order</p>
            </div>

            <form method="POST" id="orderForm">
                <!-- ── GIFT PURPOSE ── -->
                <div class="card">
                    <p class="section-title">Gift Details</p>

                    <div class="form-group">
                        <label class="form-label">Who is this gift for?</label>
                        <select name="giftPurpose" class="form-select" required>
                            <option value="" disabled selected>Select an option</option>
                            <option value="self">For me</option>
                            <option value="friend_known">For a friend (they know about it)</option>
                            <option value="friend_surprise">For a friend (surprise)</option>
                        </select>
                    </div>
                </div>

                <!-- ── RECIPIENT ── -->
                <div class="card">
                    <p class="section-title">Recipient Information</p>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Recipient's Name</label>
                            <input type="text" class="form-input" name="recipientName"
                                placeholder="Full name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Recipient's Phone</label>
                            <input type="tel" class="form-input" name="recipientPhone"
                                placeholder="07X XXX XXXX" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Delivery Address</label>
                        <textarea name="deliveryAddress" class="form-input"
                            rows="2" placeholder="Street, city" required
                            style="resize:vertical;"></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Location Type</label>
                            <select name="locationType" class="form-select">
                                <option value="">-- choose --</option>
                                <option>Apartment</option>
                                <option>House</option>
                                <option>Office</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Delivery Date</label>
                            <input id="deliveryDate" name="deliveryDate" type="date"
                                class="form-input" required>
                        </div>
                    </div>
                </div>

                <!-- ── MAP ── -->
                <div class="card">
                    <p class="section-title">Delivery Location</p>

                    <div class="map-hint">
                        <i class="fas fa-map-marker-alt"></i>
                        Click anywhere on the map to set your delivery pin
                    </div>

                    <div id="map"></div>

                    <div id="distancePill" class="distance-pill unset" style="margin-top:12px;">
                        <i class="fas fa-route"></i>
                        <span id="distanceText">No location selected</span>
                    </div>

                    <p id="mapError" class="map-error">
                        <i class="fas fa-exclamation-circle"></i>
                        Please select a delivery location on the map before continuing.
                    </p>

                    <!-- Hidden inputs posted with form -->
                    <input type="hidden" id="deliveryPrice" name="deliveryPrice" value="">
                    <input type="hidden" id="deliveryLat" name="deliveryLat" value="">
                    <input type="hidden" id="deliveryLng" name="deliveryLng" value="">

                    <?php if ($total !== null): ?>
                        <div class="cardColour" style="margin-top:16px; padding:16px 24px;">
                            <p class="subtitle">Delivery Fee</p>
                            <p class="title">Rs. <?= htmlspecialchars(number_format($total, 2)) ?></p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- ── SUBMIT ── -->
                <div style="padding: 0 12px 24px; display:flex; justify-content:flex-end;">
                    <button type="submit" class="btn1" style="width:fit-content; padding: 14px 32px;">
                        <i class="fas fa-check"></i> Confirm Order
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // ── Map setup ──
        const outletLat = 6.902116859147395;
        const outletLng = 79.86122104576418;
        const pricePerKm = <?= $pricePerKm ?>;

        const map = L.map('map').setView([outletLat, outletLng], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        L.marker([outletLat, outletLng]).addTo(map)
            .bindPopup('GiftEase Outlet').openPopup();

        let deliveryMarker = null;

        function haversine(lat1, lon1, lat2, lon2) {
            const R = 6371,
                r = d => d * Math.PI / 180;
            const dLat = r(lat2 - lat1),
                dLon = r(lon2 - lon1);
            const a = Math.sin(dLat / 2) ** 2 +
                Math.cos(r(lat1)) * Math.cos(r(lat2)) * Math.sin(dLon / 2) ** 2;
            return R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        }

        map.on('click', function(e) {
            const {
                lat,
                lng
            } = e.latlng;

            if (deliveryMarker) {
                deliveryMarker.setLatLng([lat, lng]);
            } else {
                deliveryMarker = L.marker([lat, lng]).addTo(map)
                    .bindPopup('Delivery Location').openPopup();
            }

            const distKm = (haversine(outletLat, outletLng, lat, lng) * 1.5).toFixed(2);
            const price = (distKm * pricePerKm).toFixed(2);

            // Update pill
            const pill = document.getElementById('distancePill');
            pill.classList.remove('unset');
            document.getElementById('distanceText').textContent =
                `${distKm} km  ·  Rs. ${parseFloat(price).toLocaleString()}`;

            // Fill hidden inputs
            document.getElementById('deliveryPrice').value = price;
            document.getElementById('deliveryLat').value = lat;
            document.getElementById('deliveryLng').value = lng;

            // Hide error if it was showing
            document.getElementById('mapError').style.display = 'none';
        });

        // ── Form validation ──
        document.getElementById('orderForm').addEventListener('submit', function(e) {
            const price = document.getElementById('deliveryPrice').value;
            if (!price || parseFloat(price) <= 0) {
                e.preventDefault();
                const err = document.getElementById('mapError');
                err.style.display = 'block';
                err.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        });

        // ── Min delivery date = tomorrow ──
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        document.getElementById('deliveryDate').min = tomorrow.toISOString().split('T')[0];
    </script>
</body>

</html>