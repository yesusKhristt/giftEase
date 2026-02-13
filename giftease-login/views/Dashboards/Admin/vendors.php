<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vendor Analysis</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php
        $activePage = 'vendor';
        include 'views/commonElements/leftSidebarChathu.php';
        ?>
        <div class="main-content">
            <section id="deliveries" class="page active">
                <div class="page-header">
                    <h1 class="title">vendor</h1>
                    <p class="subtitle">vendor list</p>
                </div>

                <!-- Search Bar -->
                <div style="margin: 20px 0; display: flex; gap: 10px; align-items: center;">
                    <form id="searchForm" method="GET" style="display: flex; gap: 10px; flex: 1;">
                        <input type="hidden" name="controller" value="admin">
                        <input type="hidden" name="action" value="dashboard/vendor">
                        <input type="text" id="searchInput" name="search" placeholder="Search by name, email or shop..." value="<?php echo htmlspecialchars($search); ?>" style="flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                        <button type="submit" style="padding: 10px 20px; background-color: #e91e63; color: white; border: none; border-radius: 5px; cursor: pointer; display: none;"><i class="fas fa-search"></i> Search</button>
                        <?php if (!empty($search)): ?>
                            <a href="?controller=admin&action=dashboard/vendor" style="padding: 10px 15px; background-color: #999; color: white; border: none; border-radius: 5px; text-decoration: none; cursor: pointer;"><i class="fas fa-times"></i> Clear</a>
                        <?php endif; ?>
                    </form>
                </div>

                <!-- Results Count -->
                <div style="margin-bottom: 15px; color: #666; font-size: 14px;">
                    Showing <?php echo count($paginatedVendors); ?> of <?php echo $totalItems; ?> vendors
                </div>

                <script>
                    document.getElementById('searchInput').addEventListener('input', function(e) {
                        clearTimeout(window.searchTimeout);
                        window.searchTimeout = setTimeout(function() {
                            document.getElementById('searchForm').submit();
                        }, 300);
                    });
                </script>

                <div class="staff-cards-container">
                    <?php foreach ($paginatedVendors as $vendor): ?>
                        <div class="staff-card <?= $vendor['verified'] ? 'verified' : 'pending' ?>">
                            <div class="staff-header">
                                <div class="staff-info">
                                    <h3><?= htmlspecialchars($vendor['first_name'] . ' ' . $vendor['last_name']) ?></h3>
                                    <p class="shop-name"><i class="fas fa-store"></i> <?= htmlspecialchars($vendor['shopName']) ?></p>
                                    <p class="staff-email"><i class="fas fa-envelope"></i> <?= htmlspecialchars($vendor['email']) ?></p>
                                    <p class="staff-phone"><i class="fas fa-phone"></i> <?= htmlspecialchars($vendor['phone']) ?></p>
                                </div>
                                <div class="staff-status">
                                    <span class="status-badge <?= $vendor['verified'] ? 'status-verified' : 'status-pending' ?>">
                                        <?= $vendor['verified'] ? '✓ Verified' : '⏳ Pending' ?>
                                    </span>
                                    <div class="staff-rating">
                                        <i class="fas fa-star"></i> <?= number_format($vendor['rating'], 1) ?>
                                    </div>
                                </div>
                            </div>

                            <div class="staff-details">
                                <p><strong>Address:</strong> <?= htmlspecialchars($vendor['address']) ?></p>
                                <p><strong>Joined:</strong> <?= date('M d, Y', strtotime($vendor['created_at'])) ?></p>
                            </div>

                            <div class="documents-section">
                                <h4><i class="fas fa-file-alt"></i> Business Documentation</h4>
                                <div class="documents-grid">
                                    <div class="doc-item">
                                        <span class="doc-label">Identity Proof</span>
                                        <?php if (!empty($vendor['identity_doc'])): ?>
                                            <a href="<?= htmlspecialchars($vendor['identity_doc']) ?>" target="_blank" class="doc-link">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        <?php else: ?>
                                            <span class="doc-missing">Not uploaded</span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="doc-item">
                                        <span class="doc-label">Business Certificate</span>
                                        <?php if (!empty($vendor['business_cert'])): ?>
                                            <a href="<?= htmlspecialchars($vendor['business_cert']) ?>" target="_blank" class="doc-link">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        <?php else: ?>
                                            <span class="doc-missing">Not uploaded</span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="doc-item">
                                        <span class="doc-label">TIN Document</span>
                                        <?php if (!empty($vendor['tin_doc'])): ?>
                                            <a href="<?= htmlspecialchars($vendor['tin_doc']) ?>" target="_blank" class="doc-link">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        <?php else: ?>
                                            <span class="doc-missing">Not uploaded</span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="doc-item">
                                        <span class="doc-label">Address Proof</span>
                                        <?php if (!empty($vendor['address_proof'])): ?>
                                            <a href="<?= htmlspecialchars($vendor['address_proof']) ?>" target="_blank" class="doc-link">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        <?php else: ?>
                                            <span class="doc-missing">Not uploaded</span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="doc-item">
                                        <span class="doc-label">Bank Details</span>
                                        <?php if (!empty($vendor['bank_details'])): ?>
                                            <a href="<?= htmlspecialchars($vendor['bank_details']) ?>" target="_blank" class="doc-link">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        <?php else: ?>
                                            <span class="doc-missing">Not uploaded</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="staff-actions">
                                <?php if ($vendor['verified']): ?>
                                    <a class="btn-unverify" href="?controller=admin&action=dashboard/vendor/unverify/<?= htmlspecialchars($vendor['vendor_id']) ?>">
                                        <i class="fas fa-times-circle"></i> Unverify
                                    </a>
                                <?php else: ?>
                                    <a class="btn-verify" href="?controller=admin&action=dashboard/vendor/verify/<?= htmlspecialchars($vendor['vendor_id']) ?>">
                                        <i class="fas fa-check-circle"></i> Verify Vendor
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
                        echo '<a href="?controller=admin&action=dashboard/vendor&page=' . $i . ((!empty($search) ? '&search=' . urlencode($search) : '')) . '" style="padding: 8px 12px; background-color: ' . $bgColor . '; color: ' . $color . '; border: ' . $border . '; border-radius: 4px; text-decoration: none; cursor: pointer;">' . $i . '</a>';
                    }
                    ?>  
                </div>
                <div style="text-align: center; margin-top: 15px; color: #666;">
                    Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?>
                </div>
                <?php endif; ?>
                </div>
        </div>
        </section>
    </div>
    </div>
</body>