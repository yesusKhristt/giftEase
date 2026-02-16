<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wrapping Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link rel="icon" type="image/png" href="resources/1.png">
    <link rel="profile" href="profile.php" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

    <div class="container">
        <?php
        $activePage = 'settings';
        include 'views\commonElements/leftSidebarJeshani.php';

        $profile = $profile ?? [];
        $fullName = trim(($profile['first_name'] ?? '') . ' ' . ($profile['last_name'] ?? ''));
        $displayName = $fullName !== '' ? $fullName : 'Gift Wrapper';
        $phone = $profile['phone'] ?? '';
        $email = $profile['email'] ?? '';
        $statusLabel = $profile['status'] ?? 'inactive';
        $verifiedLabel = ((int) ($profile['verified'] ?? 0)) === 1 ? 'Verified' : 'Not Verified';
        $memberSince = !empty($profile['created_at']) ? date('M d, Y', strtotime($profile['created_at'])) : 'N/A';
        $yearsExp = $profile['years_of_experience'] ?? 'N/A';
        $address = $profile['address'] ?? 'N/A';
        $identityDoc = $profile['identity_doc'] ?? '';
        $addressProof = $profile['address_proof'] ?? '';
        $portfolio = $profile['portfolio'] ?? '';
        ?>
       
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Settings</h1>
                <p class="subtitle">Manage your account preferences and delivery settings</p>
            </div>
            <div class="card">
                <div class="settings-section">
                    <h3>Profile Information</h3>
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-input" value="<?= htmlspecialchars($displayName) ?>"
                            placeholder="Enter your full name" readonly />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="tel" class="form-input" value="<?= htmlspecialchars($phone) ?>"
                            placeholder="Enter your phone number" readonly />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-input" value="<?= htmlspecialchars($email) ?>"
                            placeholder="Enter your email" readonly />
                    </div>
                </div>
            </div>

           <div class="card">
                <div class="settings-section">
                    <h3>Submitted Documentation</h3>
                    <div class="summary-grid">
                        <div class="card">
                            <div class="subtitle">Identity Document</div>
                            <div class="title">
                                <?php if (!empty($identityDoc)) : ?>
                                    <a href="<?= htmlspecialchars($identityDoc) ?>" target="_blank">View Document</a>
                                <?php else : ?>
                                    Not uploaded
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card">
                            <div class="subtitle">Address Proof</div>
                            <div class="title">
                                <?php if (!empty($addressProof)) : ?>
                                    <a href="<?= htmlspecialchars($addressProof) ?>" target="_blank">View Document</a>
                                <?php else : ?>
                                    Not uploaded
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card">
                            <div class="subtitle">Portfolio</div>
                            <div class="title">
                                <?php if (!empty($portfolio)) : ?>
                                    <a href="<?= htmlspecialchars($portfolio) ?>" target="_blank">View Portfolio</a>
                                <?php else : ?>
                                    Not uploaded
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

</body>

</html>