<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Withdraw Requests - GiftEase</title>
  <link rel="stylesheet" href="public/backup/style.css">
  <link rel="stylesheet" href="public/sideTopBar.css" />
  <link rel="icon" type="image/png" href="resources/1.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    .withdraw-layout {
      display: grid;
      gap: 24px;
    }

    .withdraw-card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 2px 16px rgba(0, 0, 0, 0.06);
      padding: 18px;
    }

    .withdraw-card h2 {
      margin: 0 0 8px;
      font-size: 1.2rem;
      color: #1f2937;
    }

    .withdraw-card p {
      margin: 0 0 14px;
      color: #6b7280;
      font-size: 0.92rem;
    }

    .withdraw-table {
      width: 100%;
      border-collapse: collapse;
    }

    .withdraw-table th,
    .withdraw-table td {
      padding: 11px 10px;
      border-bottom: 1px solid #e5e7eb;
      text-align: left;
      vertical-align: top;
      font-size: 0.9rem;
    }

    .withdraw-table th {
      background: #f8fafc;
      color: #374151;
      font-weight: 700;
    }

    .pill {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 999px;
      font-size: 0.75rem;
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
      /* stack vertically */
      gap: 8px;
      justify-content: center;
      /* horizontal */
      align-items: center;
      /* vertical */
      /* optional: makes buttons full width */
    }

    .actions input[type="text"] {
      width: 180px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      padding: 7px 9px;
      font-size: 0.82rem;
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
      color: #9ca3af;
      padding: 24px 0;
    }

    .alert {
      background: #ecfeff;
      border: 1px solid #a5f3fc;
      color: #155e75;
      padding: 10px 12px;
      border-radius: 10px;
      margin-bottom: 15px;
      font-size: 0.88rem;
    }
  </style>
</head>

<body>
  <!-- <div class="container"> -->
  <?php
  $activePage = 'settings';
  include 'views/commonElements/leftSidebarChathu.php';

  ?>
  <div class="main-content">
    <section id="settings" class="page active" aria-labelledby="settings-title">
      <div class="page-header">
        <h1 class="title" id="settings-title">Withdraw Requests</h1>
        <p class="subtitle">Approve or reject stakeholder withdrawal requests, and review full request history.</p>
      </div>



      <div class="withdraw-layout">
        <div class="withdraw-card">
          <h2>Pending Approvals</h2>
          <p>All requests waiting for admin decision. Approve or reject using POST actions.</p>

          <div style="overflow-x:auto;">
            <table class="table">
              <thead>
                <tr>
                  <th>User ID</th>
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
                    <td colspan="6" class="empty-row">No pending withdrawal requests right now.</td>
                  </tr>
                <?php else : ?>
                  <?php foreach ($pending as $row) :
                    $id;
                    $role;
                    $status;
                    //var_dump($row);
                    if ($row['vendor_id']) {
                      $id = htmlspecialchars($row['vendor_id']);
                      $role = 'Vendor';
                    }
                    if ($row['delivery_id']) {
                      $id = htmlspecialchars($row['delivery_id']);
                      $role = 'Delivery';
                    }
                    if ($row['giftWrapper_id']) {
                      $id = htmlspecialchars($row['giftWrapper_id']);
                      $role = 'Gift Wrapper';
                    }

                    if ($row['status'] === null) {
                      $status = 'Pending';
                    }
                    if ($row['status'] === 1) {
                      $status = 'Aproved';
                    }
                    if ($row['status'] === 0) {
                      $status = 'Rejected';
                    }
                  ?>
                    <tr>
                      <td><?= htmlspecialchars($id) ?></td>
                      <td><?= htmlspecialchars($role) ?></td>
                      <td><?= htmlspecialchars($row['amount']) ?></td>
                      <td><?= htmlspecialchars($row['createdAT']) ?></td>
                      <td><?= htmlspecialchars($status) ?></td>
                      <td>
                        <div class="actions">
                          <form method="POST" action="?controller=admin&action=dashboard/withdraw/approve">
                            <input type="hidden" name="withdraw_id" value="<?= htmlspecialchars($row['id']) ?>">
                            <input type="hidden" name="amount" value="<?= htmlspecialchars($row['amount']) ?>">
                            <input type="hidden" name="role" value="<?= htmlspecialchars($role) ?>">
                            <input type="hidden" name="user_id" value="<?= htmlspecialchars($id) ?>">
                            <button type="submit" name="decision" value="approve" class="btn-mini btn-approve">Approve</button>
                          </form>
                          <form method="POST" action="?controller=admin&action=dashboard/withdraw/reject">
                            <input type="hidden" name="withdraw_id" value="<?= htmlspecialchars($row['id']) ?>">
                            <input type="hidden" name="amount" value="<?= htmlspecialchars($row['amount']) ?>">
                            <input type="hidden" name="role" value="<?= htmlspecialchars($role) ?>">
                            <input type="hidden" name="user_id" value="<?= htmlspecialchars($id) ?>">
                            <button type="submit" name="decision" value="reject" class="btn-mini btn-reject">Reject</button>
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
          <h2>All Requests History</h2>
          <p>Full withdrawal request log across all stakeholders for audit and tracking.</p>

          <div style="overflow-x:auto;">
            <table class="table">
              <thead>
                <tr>
                  <th>User ID</th>
                  <th>Role</th>
                  <th>Requested Amount</th>
                  <th>Requested At</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($all)) : ?>
                  <tr>
                    <td colspan="5" class="empty-row">No pending withdrawal requests right now.</td>
                  </tr>
                <?php else : ?>
                  <?php foreach ($all as $row) :
                    $id;
                    $role;
                    $status;
                    //var_dump($row);
                    if ($row['vendor_id']) {
                      $id = htmlspecialchars($row['vendor_id']);
                      $role = 'Vendor';
                    }
                    if ($row['delivery_id']) {
                      $id = htmlspecialchars($row['delivery_id']);
                      $role = 'Delivery';
                    }
                    if ($row['giftWrapper_id']) {
                      $id = htmlspecialchars($row['giftWrapper_id']);
                      $role = 'Gift Wrapper';
                    }

                    if ($row['status'] === null) {
                      $status = 'Pending';
                    }
                    if ($row['status'] === 1) {
                      $status = 'Aproved';
                    }
                    if ($row['status'] === 0) {
                      $status = 'Rejected';
                    }
                  ?>
                    <tr>
                      <td><?= htmlspecialchars($id) ?></td>
                      <td><?= htmlspecialchars($role) ?></td>
                      <td><?= htmlspecialchars($row['amount']) ?></td>
                      <td><?= htmlspecialchars($row['createdAT']) ?></td>
                      <td><?= htmlspecialchars($status) ?></td>
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