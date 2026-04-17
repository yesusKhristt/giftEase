<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Withdraw Requests - GiftEase</title>
  <link rel="stylesheet" href="public/style.css">
  <link rel="icon" type="image/png" href="resources/1.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    .main-content {
      font-family: 'Poppins', sans-serif;
      background: radial-gradient(circle at top right, #ecfeff 0, #f8fafc 45%, #ffffff 100%);
      min-height: 100vh;
      padding-bottom: 20px;
    }

    .page-header {
      background: linear-gradient(120deg, #0f172a 0%, #155e75 55%, #0891b2 100%);
      border-radius: 18px;
      padding: 26px 28px;
      color: #fff;
      margin-bottom: 20px;
      box-shadow: 0 12px 24px rgba(8, 145, 178, 0.18);
    }

    .page-header .title {
      margin: 0 0 6px;
      color: #fff;
      font-weight: 800;
      letter-spacing: 0.01em;
    }

    .page-header .subtitle {
      margin: 0;
      color: rgba(255, 255, 255, 0.88);
      font-size: 0.95rem;
    }

    .summary-grid {
      display: grid;
      grid-template-columns: repeat(4, minmax(130px, 1fr));
      gap: 12px;
      margin-bottom: 18px;
    }

    .summary-card {
      background: #fff;
      border-radius: 12px;
      border: 1px solid #e2e8f0;
      padding: 14px;
      box-shadow: 0 4px 18px rgba(15, 23, 42, 0.06);
    }

    .summary-card .label {
      display: block;
      font-size: 0.78rem;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      color: #64748b;
      margin-bottom: 6px;
      font-weight: 600;
    }

    .summary-card .value {
      display: block;
      font-size: 1.4rem;
      font-weight: 700;
      color: #0f172a;
      line-height: 1.1;
    }

    .summary-card.pending .value {
      color: #b45309;
    }

    .summary-card.approved .value {
      color: #166534;
    }

    .summary-card.rejected .value {
      color: #b91c1c;
    }

    .withdraw-layout {
      display: grid;
      gap: 24px;
    }

    .withdraw-card {
      background: #ffffff;
      border-radius: 16px;
      border: 1px solid #dbe4ee;
      box-shadow: 0 8px 26px rgba(15, 23, 42, 0.08);
      padding: 18px 20px;
    }

    .withdraw-card h2 {
      margin: 0 0 7px;
      font-size: 1.24rem;
      color: #0f172a;
      font-weight: 700;
    }

    .withdraw-card p {
      margin: 0 0 16px;
      color: #64748b;
      font-size: 0.91rem;
    }

    .table-wrap {
      overflow-x: auto;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      background: #fff;
    }

    .withdraw-table {
      width: 100%;
      border-collapse: collapse;
      min-width: 900px;
    }

    .withdraw-table th,
    .withdraw-table td {
      padding: 12px 11px;
      border-bottom: 1px solid #edf2f7;
      text-align: left;
      vertical-align: top;
      font-size: 0.88rem;
    }

    .withdraw-table th {
      position: sticky;
      top: 0;
      z-index: 1;
      background: linear-gradient(0deg, #f8fafc, #f1f5f9);
      color: #334155;
      font-weight: 700;
      letter-spacing: 0.01em;
    }

    .withdraw-table tbody tr:nth-child(even) {
      background: #fcfdff;
    }

    .withdraw-table tbody tr:hover {
      background: #f0f9ff;
    }

    .pill {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 999px;
      font-size: 0.72rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.03em;
    }

    .pill.pending {
      background: #fef3c7;
      color: #92400e;
    }

    .pill.approved {
      background: #dcfce7;
      color: #166534;
    }

    .pill.rejected {
      background: #fee2e2;
      color: #991b1b;
    }

    .actions {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      align-items: stretch;
    }

    .action-form {
      display: flex;
      align-items: center;
      gap: 7px;
    }

    .action-form input[type="text"] {
      width: 128px;
      border: 1px solid #cbd5e1;
      border-radius: 8px;
      padding: 6px 8px;
      font-size: 0.75rem;
      background: #fff;
    }

    .btn-mini {
      border: 0;
      border-radius: 8px;
      padding: 5px 9px;
      font-size: 0.7rem;
      cursor: pointer;
      font-weight: 700;
      color: #fff;
      transition: transform 0.15s ease, opacity 0.2s ease;
    }

    .btn-mini i {
      font-size: 0.68rem;
      margin-right: 3px;
    }

    .btn-mini:hover {
      opacity: 0.92;
      transform: translateY(-1px);
    }

    .btn-approve {
      background: linear-gradient(135deg, #16a34a, #15803d);
    }

    .btn-reject {
      background: linear-gradient(135deg, #dc2626, #b91c1c);
    }

    .empty-row {
      text-align: center;
      color: #64748b;
      padding: 26px 10px;
      font-weight: 500;
    }

    .empty-row i {
      color: #94a3b8;
      margin-right: 8px;
    }

    .alert {
      background: #f0fdfa;
      border: 1px solid #99f6e4;
      color: #0f766e;
      padding: 11px 13px;
      border-radius: 10px;
      margin-bottom: 16px;
      font-size: 0.87rem;
      font-weight: 500;
    }

    .header-title-line {
      display: flex;
      gap: 10px;
      align-items: center;
    }

    @media (max-width: 1100px) {
      .summary-grid {
        grid-template-columns: repeat(2, minmax(140px, 1fr));
      }
    }

    @media (max-width: 760px) {
      .page-header {
        padding: 18px;
      }

      .summary-grid {
        grid-template-columns: 1fr;
      }

      .withdraw-card {
        padding: 14px;
      }

      .action-form {
        width: 100%;
      }

      .action-form input[type="text"] {
        flex: 1;
        min-width: 120px;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <?php
    $activePage = 'settings';
    include 'views/commonElements/leftSidebarChathu.php';

    $pending = $pending ?? [];
    $all = $all ?? [];

    $pendingCount = count($pending);
    $approvedCount = 0;
    $rejectedCount = 0;
    $totalRequestedAmount = 0;

    foreach ($all as $statRow) {
      $amountCandidate = $statRow['amount'] ?? $statRow['requested_amount'] ?? $statRow['withdraw_amount'] ?? 0;
      $totalRequestedAmount += (float) $amountCandidate;

      $statusCandidate = strtolower((string) ($statRow['status'] ?? $statRow['state'] ?? 'pending'));
      if ($statusCandidate === 'approved') {
        $approvedCount++;
      } elseif ($statusCandidate === 'rejected') {
        $rejectedCount++;
      }
    }

    $safe = function ($value, $fallback = 'N/A') {
      if ($value === null || $value === '') {
        return $fallback;
      }
      return htmlspecialchars((string) $value);
    };

    $amountValue = function ($value) {
      if ($value === null || $value === '') {
        return 'N/A';
      }
      return 'Rs ' . number_format((float) $value, 2);
    };

    $readField = function ($row, $keys, $fallback = null) {
      foreach ($keys as $key) {
        if (isset($row[$key])) {
          return $row[$key];
        }
      }
      return $fallback;
    };
    ?>
    <div class="main-content">
      <section id="settings" class="page active" aria-labelledby="settings-title">
        <div class="page-header">
          <div class="header-title-line">
            <i class="fa-solid fa-money-bill-transfer"></i>
            <h1 class="title" id="settings-title">Withdraw Requests</h1>
          </div>
          <p class="subtitle">Approve or reject stakeholder withdrawal requests, and review full request history.</p>
        </div>

        <?php if (isset($_GET['message']) && $_GET['message'] !== '') : ?>
          <div class="alert"><i class="fa-solid fa-circle-info"></i> <?= $safe($_GET['message']) ?></div>
        <?php endif; ?>

        <div class="summary-grid">
          <div class="summary-card pending">
            <span class="label">Pending</span>
            <span class="value"><?= $safe($pendingCount, '0') ?></span>
          </div>
          <div class="summary-card approved">
            <span class="label">Approved</span>
            <span class="value"><?= $safe($approvedCount, '0') ?></span>
          </div>
          <div class="summary-card rejected">
            <span class="label">Rejected</span>
            <span class="value"><?= $safe($rejectedCount, '0') ?></span>
          </div>
          <div class="summary-card">
            <span class="label">Total Requested</span>
            <span class="value"><?= $safe($amountValue($totalRequestedAmount), 'Rs 0.00') ?></span>
          </div>
        </div>

        <div class="withdraw-layout">
          <div class="withdraw-card">
            <h2><i class="fa-regular fa-hourglass-half"></i> Pending Approvals</h2>
            <p>All requests waiting for admin decision. Approve or reject using POST actions.</p>

            <div class="table-wrap">
              <table class="withdraw-table">
                <thead>
                  <tr>
                    <th>Request</th>
                    <th>Stakeholder</th>
                    <th>Role</th>
                    <th>Requested Amount</th>
                    <th>Requested At</th>
                    <th>Status</th>
                    <th>Decision</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($pending)) : ?>
                    <tr>
                      <td colspan="7" class="empty-row"><i class="fa-regular fa-circle-check"></i>No pending withdrawal requests right now.</td>
                    </tr>
                  <?php else : ?>
                    <?php foreach ($pending as $row) : ?>
                      <?php
                      $requestId = $readField($row, ['request_id', 'withdraw_id', 'id'], 'N/A');
                      $stakeholderId = $readField($row, ['user_id', 'stakeholder_id', 'owner_id'], 'N/A');
                      $stakeholderName = $readField($row, ['name', 'full_name', 'stakeholder_name'], 'Unknown');
                      $role = $readField($row, ['role', 'user_role', 'stakeholder_role'], 'N/A');
                      $amount = $readField($row, ['amount', 'requested_amount', 'withdraw_amount'], null);
                      $requestedAt = $readField($row, ['requested_at', 'created_at', 'date'], 'N/A');

                      $approveUrl = 'index.php?controller=admin&action=withdrawApprove_' . mt_rand(10000, 99999);
                      $rejectUrl = 'index.php?controller=admin&action=withdrawReject_' . mt_rand(10000, 99999);
                      ?>
                      <tr>
                        <td>#<?= $safe($requestId) ?></td>
                        <td><?= $safe($stakeholderName) ?> (ID: <?= $safe($stakeholderId) ?>)</td>
                        <td><?= $safe($role) ?></td>
                        <td><strong><?= $safe($amountValue($amount)) ?></strong></td>
                        <td><?= $safe($requestedAt) ?></td>
                        <td><span class="pill pending">Pending</span></td>
                        <td>
                          <div class="actions">
                            <form class="action-form" method="POST" action="<?= $safe($approveUrl) ?>">
                              <input type="hidden" name="request_id" value="<?= $safe($requestId) ?>">
                              <input type="hidden" name="stakeholder_id" value="<?= $safe($stakeholderId) ?>">
                              <input type="text" name="message" placeholder="Approve message" maxlength="120">
                              <button type="submit" name="decision" value="approve" class="btn-mini btn-approve"><i class="fa-solid fa-check"></i> Approve</button>
                            </form>
                            <form class="action-form" method="POST" action="<?= $safe($rejectUrl) ?>">
                              <input type="hidden" name="request_id" value="<?= $safe($requestId) ?>">
                              <input type="hidden" name="stakeholder_id" value="<?= $safe($stakeholderId) ?>">
                              <input type="text" name="message" placeholder="Reject reason" maxlength="120">
                              <button type="submit" name="decision" value="reject" class="btn-mini btn-reject"><i class="fa-solid fa-xmark"></i> Reject</button>
                            </form>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>

          <div class="withdraw-card">
            <h2><i class="fa-solid fa-clock-rotate-left"></i> All Requests History</h2>
            <p>Full withdrawal request log across all stakeholders for audit and tracking.</p>

            <div class="table-wrap">
              <table class="withdraw-table">
                <thead>
                  <tr>
                    <th>Request</th>
                    <th>Stakeholder</th>
                    <th>Role</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Requested At</th>
                    <th>Reviewed At</th>
                    <th>Admin Message</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($all)) : ?>
                    <tr>
                      <td colspan="8" class="empty-row"><i class="fa-regular fa-folder-open"></i>No withdrawal history available yet.</td>
                    </tr>
                  <?php else : ?>
                    <?php foreach ($all as $row) : ?>
                      <?php
                      $requestId = $readField($row, ['request_id', 'withdraw_id', 'id'], 'N/A');
                      $stakeholderId = $readField($row, ['user_id', 'stakeholder_id', 'owner_id'], 'N/A');
                      $stakeholderName = $readField($row, ['name', 'full_name', 'stakeholder_name'], 'Unknown');
                      $role = $readField($row, ['role', 'user_role', 'stakeholder_role'], 'N/A');
                      $amount = $readField($row, ['amount', 'requested_amount', 'withdraw_amount'], null);
                      $statusRaw = strtolower((string) $readField($row, ['status', 'state'], 'pending'));
                      $requestedAt = $readField($row, ['requested_at', 'created_at', 'date'], 'N/A');
                      $reviewedAt = $readField($row, ['reviewed_at', 'updated_at', 'decision_at'], '-');
                      $adminMsg = $readField($row, ['admin_message', 'message', 'note'], '-');

                      $status = in_array($statusRaw, ['approved', 'rejected'], true) ? $statusRaw : 'pending';
                      ?>
                      <tr>
                        <td>#<?= $safe($requestId) ?></td>
                        <td><?= $safe($stakeholderName) ?> (ID: <?= $safe($stakeholderId) ?>)</td>
                        <td><?= $safe($role) ?></td>
                        <td><strong><?= $safe($amountValue($amount)) ?></strong></td>
                        <td><span class="pill <?= $safe($status) ?>"><?= ucfirst($safe($status)) ?></span></td>
                        <td><?= $safe($requestedAt) ?></td>
                        <td><?= $safe($reviewedAt) ?></td>
                        <td><?= $safe($adminMsg) ?></td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</body>

</html>
        
       