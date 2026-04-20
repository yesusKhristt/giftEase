<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delivery Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link rel="stylesheet" href="public/sideTopBar.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php
        $activePage = 'settings';
        include 'views\commonElements/leftSidebar.php';
        ?>
        <div class="main-content">
            <?php
            $isDelivered = false; // placeholder so status logic doesn't break
            ?>

            <div class="page-header">
                <h1 class="title">My Wallet</h1>
                <p class="subtitle">Manage your earnings and bank details</p>
            </div>

            <!-- Balance Cards -->
            <div class="summary-grid">

                <div class="cardColour">
                    <p class="subtitle">Available Balance</p>
                    <h1 class="title">Rs. <?= number_format($money, 2) ?></h1>
                    <button class="btn1" style="margin-top: 16px; width: fit-content;" onclick="openWithdrawPopup()">
                        <i class="fas fa-arrow-up"></i> Withdraw
                    </button>
                </div>

                <div class="card">
                    <p class="subtitle">Pending Withdrawal</p>
                    <h1 class="title">Rs. <?= number_format($pendingMoney, 2) ?></h1>
                    <p style="margin-top: 12px; font-size: 13px; color: #999;">
                        <i class="fas fa-clock"></i> Awaiting confirmation
                    </p>
                </div>

            </div>

            <!-- Bank Information -->
            <div class="card">
                <h4>Bank Information</h4>

                <div id="bankView">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group">
                            <label class="subtitle">Bank Name</label>
                            <div class="form-input"><?= htmlspecialchars($bank['bankName'] ?? 'Not set') ?></div>
                        </div>
                        <div class="form-group">
                            <label class="subtitle">Account Holder</label>
                            <div class="form-input"><?= htmlspecialchars($bank['accountName'] ?? 'Not set') ?></div>
                        </div>
                        <div class="form-group">
                            <label class="subtitle">Account Number</label>
                            <div class="form-input"><?= htmlspecialchars($bank['accountNumber'] ?? 'Not set') ?></div>
                        </div>
                        <div class="form-group">
                            <label class="subtitle">Branch / Routing</label>
                            <div class="form-input"><?= htmlspecialchars($bank['bankBranch'] ?? 'Not set') ?></div>
                        </div>
                    </div>
                    <button class="btn1" style="margin-top: 8px; width: fit-content;" onclick="toggleEdit()">
                        <i class="fas fa-pencil-alt"></i> Edit Details
                    </button>
                </div>

                <div id="bankEdit" style="display: none;">
                    <form method="POST" action="?controller=vendor&action=dashboard/wallet/updateBank">
                        <?php
                        //var_dump($_SESSION['user']);
                        ?>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                            <div class="form-group">
                                <label class="form-label">Bank Name</label>
                                <input type="text" class="form-input" name="bank_name"
                                    value="<?= htmlspecialchars($bank['bankName'] ?? '') ?>"
                                    placeholder="e.g. Commercial Bank">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Account Holder</label>
                                <input type="text" class="form-input" name="account_holder"
                                    value="<?= htmlspecialchars($bank['accountName'] ?? '') ?>"
                                    placeholder="Full name on account">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Account Number</label>
                                <input type="text" class="form-input" name="account_number"
                                    value="<?= htmlspecialchars($bank['accountNumber'] ?? '') ?>"
                                    placeholder="Account number">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Branch / Routing</label>
                                <input type="text" class="form-input" name="branch"
                                    value="<?= htmlspecialchars($bank['bankBranch'] ?? '') ?>"
                                    placeholder="Branch code or routing number">
                            </div>
                        </div>
                        <div style="display: flex; gap: 12px; margin-top: 8px;">
                            <button type="submit" class="btn1" style="width: fit-content;">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                            <button type="button" class="btn2" style="width: fit-content;" onclick="toggleEdit()">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>


            <!-- ── WITHDRAW POPUP ── -->
            <div class="overlay" id="withdrawOverlay">
                <div class="popup">
                    <h2>Withdraw Funds</h2>
                    <p class="subtitle" style="margin: 8px 0 20px;">
                        Available: <strong>Rs. <?= number_format($money, 2) ?></strong>
                    </p>
                    <form onsubmit="submitWithdraw(event)">
                        <div class="form-group">
                            <label class="form-label">Amount (Rs.)</label>
                            <input type="number" id="withdrawAmount" class="form-input"
                                placeholder="Enter amount" min="1"
                                max="<?= $money ?>" step="0.01" required>
                        </div>
                        <div style="display: flex; gap: 12px; margin-top: 16px;">
                            <button type="submit" class="btn1" style="flex: 1;">Confirm</button>
                            <button type="button" class="btn2" style="flex: 1;" onclick="closeWithdrawPopup()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ── CONFIRMATION POPUP ── -->
            <div class="overlay" id="confirmOverlay">
                <div class="popup">
                    <i class="fas fa-check-circle" style="font-size: 3rem; color: #d03c2e; margin-bottom: 12px;"></i>
                    <h2>Request Submitted</h2>
                    <p style="margin: 12px 0 8px; color: #555;">Your withdrawal of</p>
                    <p class="title" id="confirmedAmount" style="margin-bottom: 8px;"></p>
                    <p style="color: #555; margin-bottom: 20px;">is pending confirmation.</p>
                    <button class="btn1" style="width: fit-content; margin: 0 auto;" onclick="closeConfirmPopup()">
                        Done
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // ── Withdraw flow ──
        function openWithdrawPopup() {
            document.getElementById('withdrawOverlay').classList.add('show');
            document.getElementById('withdrawAmount').value = '';
            document.getElementById('withdrawAmount').focus();
        }

        function closeWithdrawPopup() {
            document.getElementById('withdrawOverlay').classList.remove('show');
        }

        function submitWithdraw(e) {
            e.preventDefault();
            const amount = parseFloat(document.getElementById('withdrawAmount').value);
            const max = <?= $money ?>;

            if (isNaN(amount) || amount <= 0) {
                alert('Please enter a valid amount.');
                return;
            }
            if (amount > max) {
                alert('Amount exceeds your available balance.');
                return;
            }

            // TODO: wire up a real AJAX call here, e.g.:
            fetch('?controller=vendor&action=dashboard/wallet/withdraw', {
                method: 'POST',
                body: new URLSearchParams({ amount })
            });

            closeWithdrawPopup();
            document.getElementById('confirmedAmount').textContent =
                'Rs. ' + amount.toLocaleString('en-US', {
                    minimumFractionDigits: 2
                });
            document.getElementById('confirmOverlay').classList.add('show');
        }

        function closeConfirmPopup() {
            document.getElementById('confirmOverlay').classList.remove('show');
            location.reload();
        }

        // Close overlays on backdrop click
        document.getElementById('withdrawOverlay').addEventListener('click', function(e) {
            if (e.target === this) closeWithdrawPopup();
        });
        document.getElementById('confirmOverlay').addEventListener('click', function(e) {
            if (e.target === this) closeConfirmPopup();
        });

        // ── Bank edit toggle ──
        function toggleEdit() {
            const view = document.getElementById('bankView');
            const edit = document.getElementById('bankEdit');
            const isEditing = edit.style.display !== 'none';
            view.style.display = isEditing ? 'block' : 'none';
            edit.style.display = isEditing ? 'none' : 'block';
        }
    </script>
</body>

</html>