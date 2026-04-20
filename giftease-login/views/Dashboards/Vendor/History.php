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



            
        <?php endif; ?>


    </div>
  </div>
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