<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/png" href="resources/1.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delivery Proofs - GiftEase</title>
  <link rel="stylesheet" href="public/backup/style.css">
  <link rel="stylesheet" href="public/sideTopBar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

  <?php
  $activePage = 'avenue';
  include 'views/commonElements/leftSidebarChathu.php';

  $delivery = $delivery ?? [];
  $proofs = $proofs ?? [];
  $deliveryName = trim(($delivery['first_name'] ?? '') . ' ' . ($delivery['last_name'] ?? ''));
  ?>

  <div class="main-content">
    <div class="page-header">
      <h1 class="title">Delivery Proof Records</h1>
      <p class="subtitle"><?= htmlspecialchars($deliveryName !== '' ? $deliveryName : 'Delivery') ?> - Uploaded proof history with client details</p>
    </div>

    <div class="card" style="overflow-x:auto;">
      <table class="table">
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Client Name</th>
            <th>Client Phone</th>
            <th>Delivery Date</th>
            <th>Proof Details</th>
            <th>Uploaded At</th>
            <th>Note</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($proofs)) : ?>
            <tr>
              <td colspan="7" style="text-align:center; padding:30px; color:#999;">No proof uploads found for this delivery partner.</td>
            </tr>
          <?php else : ?>
            <?php foreach ($proofs as $proof) : ?>
              <?php
              $clientName = trim((string)($proof['client_name'] ?? ''));
              if ($clientName === '') {
                $clientName = trim(($proof['first_name'] ?? '') . ' ' . ($proof['last_name'] ?? ''));
              }
              $deliveryDate = !empty($proof['deliveryDate']) ? date('M d, Y', strtotime($proof['deliveryDate'])) : 'N/A';
              $uploadedAt = !empty($proof['uploaded_at']) ? date('M d, Y h:i A', strtotime($proof['uploaded_at'])) : 'N/A';
              ?>
              <tr>
                <td>
                  <a href="?controller=admin&action=dashboard/order/<?= htmlspecialchars($proof['order_id']) ?>">
                    #<?= htmlspecialchars($proof['order_id']) ?>
                  </a>
                </td>
                <td><?= htmlspecialchars($clientName !== '' ? $clientName : 'N/A') ?></td>
                <td><?= htmlspecialchars($proof['client_phone'] ?? ($proof['phone'] ?? 'N/A')) ?></td>
                <td><?= htmlspecialchars($deliveryDate) ?></td>
                <td><?= htmlspecialchars($proof['proof_details'] ?? '-') ?></td>
                <td><?= htmlspecialchars($uploadedAt) ?></td>
                <td><?= htmlspecialchars($proof['note'] ?? '-') ?></td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="button-section">
      <a href="?controller=admin&action=dashboard/avenue/delivery/<?= htmlspecialchars($delivery['id'] ?? '') ?>" class="btn1"><i class="fas fa-arrow-left"></i>Back to Delivery</a>
    </div>
  </div>

</body>

</html>
