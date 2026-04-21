<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Delivery Proof Details - GiftEase</title>
  <link rel="stylesheet" href="public/delivery.css" />
  <link rel="stylesheet" href="public/sideTopBar.css" />
  <link rel="icon" type="image/png" href="resources/1.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
  <div class="container">
    <?php
    $activePage = 'proof';
    include 'views/commonElements/leftSidebarSaneth.php';
    $deliveryDate = $_GET['deliveryDate'] ?? ($_GET['dateFrom'] ?? '');
    $sortDate = strtolower((string)($_GET['sortDate'] ?? 'desc'));
    $maleCount = (int)($proofSummary['male'] ?? 0);
    $femaleCount = (int)($proofSummary['female'] ?? 0);
    ?>
    <div class="main-content">
      <div class="page-header">
        <h1 class="title">Delivery Proof Details</h1>
        <p class="subtitle">Submit completion details with client information. Admin can view these records.</p>
      </div>

      <div class="card proof-card">
        <h3 class="proof-section-title">Submit New Proof Details</h3>


        <?php if (!empty($uploadError)) : ?>
          <div class="proof-alert error"><?= htmlspecialchars($uploadError) ?></div>
        <?php endif; ?>
        <?php if (!empty($uploadSuccess)) : ?>
          <div class="proof-alert success"><?= htmlspecialchars($uploadSuccess) ?></div>
        <?php endif; ?>

        <form method="POST" action="?controller=delivery&action=dashboard/proof">
          <div class="proof-form-grid">
            <div class="proof-field">
              <label for="order_id">Order ID</label>
              <input type="number" min="1" name="order_id" id="order_id" placeholder="Example: 1024" required>
            </div>

            <div class="proof-field">
              <label for="client_name">Client Name</label>
              <input type="text" id="client_name" name="client_name" maxlength="150" placeholder="Enter client full name" required>
            </div>

            <div class="proof-field">
              <label for="client_phone">Client Phone</label>
              <input type="text" id="client_phone" name="client_phone" maxlength="30" placeholder="Enter client phone number" required>
            </div>

            <div class="proof-field">
              <select name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>

            <div class="proof-field proof-field-full">
              <label for="proof_details">Proof Details</label>
              <textarea id="proof_details" name="proof_details" rows="3" maxlength="1000" placeholder="Example: Package handed over to client at main gate. Client verified OTP." required></textarea>
            </div>

            <div class="proof-field proof-field-full">
              <label for="note">Note (optional)</label>
              <textarea id="note" name="note" rows="3" maxlength="255" placeholder="Example: Handed over package at front desk to client"></textarea>
            </div>
          </div>

          <div class="proof-submit-row">
            <button type="submit" class="btn2"><i class="fas fa-check"></i> Submit Details</button>
          </div>
        </form>
      </div>

      <form method="GET" action="index.php">
        <input type="hidden" name="controller" value="delivery">
        <input type="hidden" name="action" value="uploadProof">
        <div class="filter-tabs history-filters">
          <div class="filter-group">
            <label>Delivery Date</label>
            <input type="date" name="deliveryDate" value="<?= htmlspecialchars($deliveryDate) ?>">
          </div>
        </div>
        <div class="filter-actions history-filter-actions">
          <button type="submit" class="btn1"><i class="fas fa-search"></i> Filter</button>
          <button type="submit" name="sortDate" value="<?= $sortDate === 'asc' ? 'desc' : 'asc' ?>" class="btn1">
            <i class="fas fa-sort"></i>
            <?= $sortDate === 'asc' ? 'Sort Newest First' : 'Sort Oldest First' ?>
          </button>
          <a href="index.php?controller=delivery&action=uploadProof" class="btn1"><i class="fas fa-undo"></i> Reset</a>
        
    </div>
    </form>

    <div class="card">
      <h3 style="margin-top: 0;">My Uploaded Proofs</h3>
      <p class="subtitle">These records are visible to admin with order and client details.</p>
      <div class="history-record-count" style="margin-bottom: 14px; display: flex; gap: 16px; flex-wrap: wrap;">
        <span>Male clients: <?= (int)$maleCount ?></span>
        <span>Female clients: <?= (int)$femaleCount ?></span>
        <span>Total proofs: <?= count($myProofs) ?></span>
      </div>

      <table class="table proof-table">
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Client</th>
            <th>Client Phone</th>
            <th>Gender</th>
            <th>Delivery Date</th>
            <th>Proof Details</th>
            <th>Note</th>
            <th>Uploaded At</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($myProofs)) : ?>
            <tr>
              <td colspan="8" class="proof-empty">No proofs uploaded yet.</td>
            </tr>
          <?php else : ?>
            <?php foreach ($myProofs as $proof) : ?>
              <?php
              $clientName = trim((string)($proof['client_name'] ?? ''));
              if ($clientName === '') {
                $clientName = trim(($proof['first_name'] ?? '') . ' ' . ($proof['last_name'] ?? ''));
              }
              $uploadedLabel = !empty($proof['uploaded_at']) ? date('M d, Y h:i A', strtotime($proof['uploaded_at'])) : 'N/A';
              $deliveryDateLabel = !empty($proof['deliveryDate']) ? date('M d, Y', strtotime($proof['deliveryDate'])) : 'N/A';
              ?>
              <tr>
                <td>#<?= htmlspecialchars($proof['order_id']) ?></td>
                <td><?= htmlspecialchars($clientName !== '' ? $clientName : 'N/A') ?></td>
                <td><?= htmlspecialchars($proof['client_phone'] ?? ($proof['phone'] ?? 'N/A')) ?></td>
                <td><?= htmlspecialchars($proof['gender'] ?? ($proof['gender'] ?? 'N/A')) ?></td>
                <td><?= htmlspecialchars($deliveryDateLabel) ?></td>
                <td><?= htmlspecialchars($proof['proof_details'] ?? '-') ?></td>
                <td><?= htmlspecialchars($proof['note'] ?? '-') ?></td>
                <td><?= htmlspecialchars($uploadedLabel) ?></td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

  </div>
  </div>
</body>

</html>