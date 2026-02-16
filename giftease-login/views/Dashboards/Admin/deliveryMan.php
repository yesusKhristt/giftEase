<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delivery Men</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="icon" type="image/png" href="resources/1.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php
            $activePage = 'deliveryman';
            include 'views/commonElements/leftSidebarChathu.php';
        ?>
        <div class="main-content">
            <section id="customers" class="page active">
                <div class="page-header">
                    <h1 class="title">Delivery Men</h1>
                    <p class="subtitle">Manage Delivery Man Accounts</p>
                </div>

                <!-- Search Bar -->
                <div style="margin: 20px 0; display: flex; gap: 10px; align-items: center;">
                    <form id="searchForm" method="GET" style="display: flex; gap: 10px; flex: 1;">
                        <input type="hidden" name="controller" value="admin">
                        <input type="hidden" name="action" value="dashboard/deliveryman">
                        <input type="text" id="searchInput" name="search" placeholder="Search by name, email or vehicle plate..." value="<?php echo htmlspecialchars($search); ?>" style="flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                        <button type="submit" style="padding: 10px 20px; background-color: #e91e63; color: white; border: none; border-radius: 5px; cursor: pointer; display: none;"><i class="fas fa-search"></i> Search</button>
                        <?php if (!empty($search)): ?>
                            <a href="?controller=admin&action=dashboard/deliveryman" style="padding: 10px 15px; background-color: #999; color: white; border: none; border-radius: 5px; text-decoration: none; cursor: pointer;"><i class="fas fa-times"></i> Clear</a>
                        <?php endif; ?>
                    </form>
                </div>

                <script>
                    document.getElementById('searchInput').addEventListener('input', function(e) {
                        // Auto-submit form after user stops typing (300ms debounce)
                        clearTimeout(window.searchTimeout);
                        window.searchTimeout = setTimeout(function() {
                            document.getElementById('searchForm').submit();
                        }, 300);
                    });
                </script>

                <!-- Results Count -->
                <div style="margin-bottom: 15px; color: #666; font-size: 14px;">
                    Showing <?php echo count($paginatedDeliveryman); ?> of <?php echo $totalItems; ?> delivery men
                </div>

                <div class="staff-cards-container">
                    <?php 
                      // Sort to show unverified (pending) first
                      $pending = [];
                      $verified = [];
                      foreach ($paginatedDeliveryman as $row) {
                        if ($row['verified']) {
                          $verified[] = $row;
                        } else {
                          $pending[] = $row;
                        }
                      }
                      $paginatedDeliveryman = array_merge($pending, $verified);
                      foreach ($paginatedDeliveryman as $row): 
                    ?>
                        <div class="staff-card <?php echo $row['verified'] ? 'verified' : 'pending'; ?>">
                            
                            <!-- Header Section -->
                            <div class="staff-header">
                                <div class="staff-info">
                                    <h3><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></h3>
                                    <p class="shop-name"><i class="fas fa-truck"></i>Vehicle: <?php echo htmlspecialchars($row['vehiclePlate']); ?></p>
                                </div>
                                <div class="staff-status">
                                    <span class="status-badge <?php echo $row['verified'] ? 'status-verified' : 'status-pending'; ?>">
                                        <?php echo $row['verified'] ? 'Verified' : 'Pending'; ?>
                                    </span>
                                </div>
                            </div>

                            <!-- Details Section -->
                            <div class="staff-details">
                                <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                                <p><strong>Phone:</strong> <?php echo htmlspecialchars($row['phone']); ?></p>
                                <p><strong>Address:</strong> <?php echo htmlspecialchars($row['address']); ?></p>
                                <p><strong>Status:</strong> <?php echo ucfirst($row['status']); ?></p>
                            </div>

                            <!-- Documents Section -->
                            <div class="documents-section">
                                <h4><i class="fas fa-file-alt"></i> Required Documents</h4>
                                <div class="documents-grid">
                                    <div class="doc-item">
                                        <span class="doc-label">Identity (NIC/Passport)</span>
                                        <?php if (!empty($row['identity_doc'])): ?>
                                            <a href="<?php echo htmlspecialchars($row['identity_doc']); ?>" class="doc-link" target="_blank">
                                                <i class="fas fa-download"></i> View
                                            </a>
                                        <?php else: ?>
                                            <span class="doc-missing">Not Uploaded</span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="doc-item">
                                        <span class="doc-label">Driving License</span>
                                        <?php if (!empty($row['driving_license'])): ?>
                                            <a href="<?php echo htmlspecialchars($row['driving_license']); ?>" class="doc-link" target="_blank">
                                                <i class="fas fa-download"></i> View
                                            </a>
                                        <?php else: ?>
                                            <span class="doc-missing">Not Uploaded</span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="doc-item">
                                        <span class="doc-label">Vehicle Registration</span>
                                        <?php if (!empty($row['vehicle_registration'])): ?>
                                            <a href="<?php echo htmlspecialchars($row['vehicle_registration']); ?>" class="doc-link" target="_blank">
                                                <i class="fas fa-download"></i> View
                                            </a>
                                        <?php else: ?>
                                            <span class="doc-missing">Not Uploaded</span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="doc-item">
                                        <span class="doc-label">Vehicle Insurance</span>
                                        <?php if (!empty($row['vehicle_insurance'])): ?>
                                            <a href="<?php echo htmlspecialchars($row['vehicle_insurance']); ?>" class="doc-link" target="_blank">
                                                <i class="fas fa-download"></i> View
                                            </a>
                                        <?php else: ?>
                                            <span class="doc-missing">Not Uploaded</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions Section -->
                            <div class="staff-actions">
                                <?php if ($row['verified']): ?>
                                    <a class="btn-unverify" href="?controller=admin&action=dashboard/deliveryman/unverify/<?php echo htmlspecialchars($row['deliveryman_id']); ?>">
                                        <i class="fas fa-times"></i> Unverify
                                    </a>
                                <?php else: ?>
                                    <a class="btn-verify" href="?controller=admin&action=dashboard/deliveryman/verify/<?php echo htmlspecialchars($row['deliveryman_id']); ?>">
                                        <i class="fas fa-check"></i> Verify
                                    </a>
                                <?php endif; ?>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination Controls -->
                <?php if ($totalPages > 1): ?>
                <div style="margin-top: 30px; display: flex; justify-content: center; gap: 10px; align-items: center; flex-wrap: wrap;">
 
                    <?php 
                    $startPage = max(1, $currentPage - 2);
                    $endPage = min($totalPages, $currentPage + 2);
                    
                    if ($startPage > 1) echo '<span style="padding: 8px 5px;">...</span>';
                    
                    for ($i = $startPage; $i <= $endPage; $i++) {
                        $isActive = $i === $currentPage;
                        $bgColor = $isActive ? '#e91e63' : '#f0f0f0';
                        $color = $isActive ? 'white' : 'black';
                        $border = $isActive ? '1px solid #e91e63' : '1px solid #ddd';
                        echo '<a href="?controller=admin&action=dashboard/deliveryman&page=' . $i . ((!empty($search) ? '&search=' . urlencode($search) : '')) . '" style="padding: 8px 12px; background-color: ' . $bgColor . '; color: ' . $color . '; border: ' . $border . '; border-radius: 4px; text-decoration: none; cursor: pointer;">' . $i . '</a>';
                    }
                    ?>  
                </div>
                <div style="text-align: center; margin-top: 15px; color: #666;">
                    Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?>
                </div>
                <?php endif; ?>
            </section>
        </div>
    </div>
</body>

</html>