<?php
$pricePerKm = 60;  // constant
$total = null;
$distance = null;

if (isset($_POST['deliveryDistance'])) {
    $distance = (float) $_POST['deliveryDistance'];
    $total = round($distance * $pricePerKm, 2);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - GiftEase</title>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <link rel="stylesheet" href="public/style.css" />
    <link rel="icon" type="image/png" href="resources/1.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        #map {
            height: 400px;
            width: 100%;
            margin-top: 10px;
            border-radius: 8px;
            cursor: crosshair;
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
                <p class="subtitle">Select delivery location</p>
            </div>

            <div class="card">
                <form method="post">

                    <div class="section">
                        <div class="field">
                            <label>Recipient's Name *</label>
                            <input type="text" name="recipientName" placeholder="Name" required>
                        </div>

                        <div class="field">
                            <label>Recipient's Phone</label>
                            <input type="tel" name="recipientPhone" placeholder="Phone number(s)">
                        </div>
                        <div class="field">
                            <label for="deliveryAddress">Delivery Address</label>
                            <textarea id="deliveryAddress" name="deliveryAddress" placeholder="Address"></textarea>
                        </div>

                        <p><strong>Click on the map to select delivery location</strong></p>
                        <p id="distanceOutput">No location selected</p>
                        <div id="map"></div>
                        <input type="hidden" id="deliveryPrice" name="deliveryPrice">
                        

                        <?php if ($total !== null): ?>
                            <p><strong>Delivery Fee:</strong> Rs. <?= htmlspecialchars($total) ?></p>
                        <?php endif; ?>

                        <div class="field">
                            <label for="locationType">Location Type</label>
                            <select id="locationType" name="locationType">
                                <option value="">-- choose --</option>
                                <option>Apartment</option>
                                <option>House</option>
                                <option>Office</option>
                                <option>Other</option>
                            </select>
                        </div>

                        <div class="field">
                            <label for="deliveryDate">Delivery Date</label>
                            <input id="deliveryDate" name="deliveryDate" type="date">
                        </div>

                        <br>
                        <button type="submit">Confirm Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Fixed outlet location (GiftEase)
        const outletLat = 6.902116859147395;
        const outletLng = 79.86122104576418;

        const map = L.map('map').setView([outletLat, outletLng], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Outlet marker
        L.marker([outletLat, outletLng]).addTo(map)
            .bindPopup("GiftEase Outlet")
            .openPopup();

        let deliveryMarker = null;

        // Haversine formula
        function haversine(lat1, lon1, lat2, lon2) {
            const R = 6371;
            const toRad = deg => deg * Math.PI / 180;

            const dLat = toRad(lat2 - lat1);
            const dLon = toRad(lon2 - lon1);

            const a = Math.sin(dLat / 2) ** 2 +
                Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
                Math.sin(dLon / 2) ** 2;

            return R * (2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a)));
        }

        // Click to select delivery location
        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;

            if (deliveryMarker) {
                deliveryMarker.setLatLng([lat, lng]);
            } else {
                deliveryMarker = L.marker([lat, lng]).addTo(map)
                    .bindPopup("Delivery Location")
                    .openPopup();
            }

            const distanceKm = (haversine(outletLat, outletLng, lat, lng)*1.5).toFixed(2);

            document.getElementById('distanceOutput').innerText =
                `Delivery Distance: ${distanceKm} km`;

            document.getElementById('deliveryPrice').value = (distanceKm*50).toFixed(2);
        });
    </script>
</body>

</html>

