<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Order History - GiftEase Vendor</title>
  <link rel="stylesheet" href="public/style.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
  <div class="container">
    <?php
    $activePage = 'history';
    include 'views/commonElements/leftSidebar.php';
    ?>

    <div class="main-content">
      <div class="page-header">
        <h1 class="title">Order History</h1>
        <p class="subtitle">View your complete sales history</p>
      </div>

      <?php
      $statusFilter = $_GET['status'] ?? 'all';
      
      $buildHistoryUrl = function ($page = 1, $status = 'all') {
          $params = [
              'controller' => 'vendor',
              'action' => 'dashboard/history',
              'page' => $page,
          ];
          if ($status && $status !== 'all') {
              $params['status'] = $status;
          }
          return '?' . http_build_query($params);
      };
      ?>

      <!-- Filter Tabs -->
      <div class="filter-tabs">
        <a class="btn1 filter-tab <?= $statusFilter === 'all' ? 'active' : '' ?>"
          href="<?= $buildHistoryUrl(1, 'all') ?>">All Orders</a>
        <a class="btn1 filter-tab <?= $statusFilter === 'delivered' ? 'active' : '' ?>"
          href="<?= $buildHistoryUrl(1, 'delivered') ?>">Delivered</a>
        <a class="btn1 filter-tab <?= $statusFilter === 'pending' ? 'active' : '' ?>"
          href="<?= $buildHistoryUrl(1, 'pending') ?>">Pending</a>

        <button class="btn1" onclick="exportHistory()" style="margin-left: auto;">
          <i class="fas fa-download"></i> Export
        </button>
      </div>

      <!-- Orders Table -->
      <?php if (empty($paginatedOrders)): ?>
        <div style="text-align: center; padding: 40px; color: #999;">
          <i class="fas fa-inbox" style="font-size: 48px; margin-bottom: 16px; display: block;"></i>
          <h3>No orders found</h3>
          <p>You don't have any orders yet.</p>
        </div>
      <?php else: ?>
        <table class="table">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Customer</th>
              <th>Items</th>
              <th>Delivery Date</th>
              <th>Status</th>
              <th>Amount</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="historyTableBody">
            <?php foreach ($paginatedOrders as $order): ?>
              <tr>
                <td><strong>#<?= htmlspecialchars($order['order_id']) ?></strong></td>
                <td>
                  <div class="customer-cell">
                    <div class="customer-avatar-small">
                      <?= strtoupper(substr($order['client_name'], 0, 2)) ?>
                    </div>
                    <div>
                      <div class="customer-name"><?= htmlspecialchars($order['client_name']) ?></div>
                      <div class="customer-phone"><?= htmlspecialchars($order['client_email']) ?></div>
                    </div>
                  </div>
                </td>
                <td>
                  <span class="badge">
                    <i class="fas fa-box"></i> Items
                  </span>
                </td>
                <td>
                  <div class="date-cell">
                    <div class="delivery-date">
                      <?= htmlspecialchars(date('M d, Y', strtotime($order['deliveryDate']))) ?>
                    </div>
                  </div>
                </td>
                <td>
                  <?php if ($order['is_delivered']): ?>
                    <span class="order-status status-delivered">DELIVERED</span>
                  <?php else: ?>
                    <span class="order-status status-pending">PENDING</span>
                  <?php endif; ?>
                </td>
                <td class="earnings-cell">
                  <strong>Rs.<?= htmlspecialchars(number_format($order['vendor_total'], 2)) ?></strong>
                </td>
                <td>
                  <div class="action-buttons">
                    <a href="?controller=vendor&action=dashboard/vieworder/<?= htmlspecialchars($order['order_id']) ?>"
                      class="btn btn-ghost btn-small" title="View Details">
                      <i class="fas fa-eye"></i>
                    </a>
                    <button class="btn btn-ghost btn-small" onclick="downloadReceipt('<?= htmlspecialchars($order['order_id']) ?>')"
                      title="Download Receipt">
                      <i class="fas fa-download"></i>
                    </button>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
          <div class="pagination">
            <?php if ($page > 1): ?>
              <a class="page-arrow" href="<?= $buildHistoryUrl($page - 1, $statusFilter) ?>">
                <i class="fas fa-chevron-left"></i>
              </a>
            <?php else: ?>
              <span class="page-arrow disabled">
                <i class="fas fa-chevron-left"></i>
              </span>
            <?php endif; ?>

            <a class="page-num <?= $page == 1 ? 'active' : '' ?>"
              href="<?= $buildHistoryUrl(1, $statusFilter) ?>">1</a>

            <?php if ($totalPages > 1): ?>
              <?php
              $range = 2;
              $start = max(2, $page - $range);
              $end = min($totalPages - 1, $page + $range);

              if ($start > 2): ?>
                <span class="page-dots">...</span>
              <?php endif; ?>

              <?php for ($i = $start; $i <= $end; $i++): ?>
                <a class="page-num <?= $page == $i ? 'active' : '' ?>"
                  href="<?= $buildHistoryUrl($i, $statusFilter) ?>"><?= $i ?></a>
              <?php endfor; ?>

              <?php if ($end < $totalPages - 1): ?>
                <span class="page-dots">...</span>
              <?php endif; ?>

              <a class="page-num <?= $page == $totalPages ? 'active' : '' ?>"
                href="<?= $buildHistoryUrl($totalPages, $statusFilter) ?>"><?= $totalPages ?></a>
            <?php endif; ?>

            <?php if ($page < $totalPages): ?>
              <a class="page-arrow" href="<?= $buildHistoryUrl($page + 1, $statusFilter) ?>">
                <i class="fas fa-chevron-right"></i>
              </a>
            <?php else: ?>
              <span class="page-arrow disabled">
                <i class="fas fa-chevron-right"></i>
              </span>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      <?php endif; ?>

    </div>
  </div>

  <script>
    function exportHistory() {
      alert('Exporting order history...');
    }

    function downloadReceipt(orderId) {
      alert(`Downloading receipt for order ${orderId}`);
    }
  </script>
</body>

</html>
              <div class="action-buttons">
                <button class="btn btn-ghost btn-small" onclick="viewHistoryDetails('DEL-096')" title="View Details">
                  <i class="fas fa-eye"></i>
                </button>
                <button class="btn btn-ghost btn-small" onclick="downloadReceipt('DEL-096')" title="Download Receipt">
                  <i class="fas fa-download"></i>
                </button>
                <button class="btn btn-ghost btn-small" onclick="repeatOrder('DEL-096')" title="Repeat Order">
                  <i class="fas fa-redo"></i>
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

    </div>
    <script src="main.js"></script>
  </div>
</body>

</html>