<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Staff Form</title>
    <link rel="stylesheet" href="public/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="settings-section">
        <h3>Staff Information</h3>
        <form method="POST" action="" id="loginForm">

            <?php
            $role = $_SESSION['user']['type'];
            switch ($role) {
                case 'client':
                    echo '
                    <label class="form-label">First Name</label>
                    <input type="text" name="First_Name" placeholder="First Name" class="form-input" required>
                    <label class="form-label">Last Name</label>
                    <input type="text" name="Last_Name" placeholder="Last Name" class="form-input" required>
                    <label class="form-label">Address</label>
                    <input type="textarea" name="address" placeholder="Address" class="form-input" required>
                    ';
                    break;
                case 'vendor':
                    echo '
                    <label class="form-label">Shop Name</label>
                    <input type="text" name="shopName" placeholder="Shop Name" class="form-input" required>
                    ';
                    echo '
                    <label class="form-label">Address</label>
                    <input type="textarea" name="address" placeholder="Address" class="form-input" required>
                    ';
                    break;
                case 'giftWrapper':
                    break;
                case 'delivery':
                    echo '
                    <label class="form-label">Vehicle Number Plate</label>
                    <input type="text" name="vehiclePlate" placeholder="no-Plate" class="form-input" required>
                    ';
                    break;
                case 'deliveryman':
                    echo '
                    <label class="form-label">Vehicle Number Plate</label>
                    <input type="text" name="vehiclePlate" placeholder="no-Plate" class="form-input" required>
                    ';
                    break;
            }
            ?>
            <label class="form-label">Phone Number</label>
            <input type="text" name="phone" placeholder="Phone No" class="form-input" required>
            <label>
                <input type="checkbox" name="terms" style="width: 20px" required>
                I’ve read and agree to the <a href="terms.html" target="_blank">Terms and Conditions</a>.
            </label>
            <button type="submit" class="btn2 form-input">Submit</button>
        </form>
    </div>
</body>

</html>