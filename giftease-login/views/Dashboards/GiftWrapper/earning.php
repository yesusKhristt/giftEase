<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delivery Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link rel="profile" href="profile.php" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFw0Qbyq9zTFTd-tUY6dkmvuFiYMuEv20&libraries=geometry,places"
        async defer></script>
</head>

<body>

    <div class="container">
        <?php
        $activePage = 'earnings';
        include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/leftSidebarJeshani.php';
        ?>
        <!-- <div id="home" class="tab-content active"> -->
        <!-- Home page -->
        <div class="main-content">
            <!-- <div class="card"> -->
            <div class="stats-grid" style="margin-bottom: 32px;">
                <div class="card" style="grid-column: span 2;">
                    <div style="text-align: center; padding: 20px;">
                        <div
                            style="font-size: 3rem; font-weight: bold; background: linear-gradient(135deg, #e91e63, #fed2ed); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 8px;">
                            $1,847</div>
                        <div style="font-size: 1.1rem; color: #666; margin-bottom: 16px;">Total Earnings This Month
                        </div>
                        <div style="display: flex; justify-content: center; gap: 24px; font-size: 0.9rem;">
                            <div>
                                <div style="font-weight: 600; color: #333;">$156</div>
                                <div style="color: #666;">Today</div>
                            </div>
                            <div>
                                <div style="font-weight: 600; color: #333;">$892</div>
                                <div style="color: #666;">This Week</div>
                            </div>
                            <div>
                                <div style="font-weight: 600; color: #333;">47</div>
                                <div style="color: #666;">Orders Completed</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="card"> -->
                    <div class="summary-grid">
                        <div class="card">

                            <div class="stat-header">
                                <span class="stat-label">Average Order Value</span>
                                <div class="stat-icon" style="background: linear-gradient(135deg, #e91e63, #fed2ed);">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                            </div>
                            <div class="stat-value">$39.30</div>
                            <div class="stat-description">
                                <i class="fas fa-arrow-up trend-up"></i>
                                <span>+12% from last month</span>
                            </div>
                        </div>



                        <div class="card">
                            <div class="stat-header">
                                <span class="stat-label">Completion Rate</span>
                                <div class="stat-icon" style="background: linear-gradient(135deg, #e91e63, #fed2ed);">
                                    <i class="fas fa-percentage"></i>
                                </div>
                            </div>
                            <div class="stat-value">98.5%</div>
                            <div class="stat-description">
                                <i class="fas fa-arrow-up trend-up"></i>
                                <span>Excellent performance</span>
                            </div>
                        </div>
                    </div>

                <div class="cardColour">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 32px;">
                        <div
                            style="background: white; border-radius: 16px; padding: 28px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);">
                            <h3 style="margin-bottom: 24px; color: #333; font-size: 1.2rem;">
                                <i class="fas fa-chart-pie" style="color: #e91e63; margin-right: 8px;"></i>
                                Service Revenue Breakdown
                            </h3>
                            <div style="space-y: 16px;">
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; padding: 12px; background: #f8f9fa; border-radius: 8px;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div
                                            style="width: 12px; height: 12px; background: #e91e63; border-radius: 50%;">
                                        </div>
                                        <span style="font-size: 0.9rem; color: #666;">Premium Wrapping</span>
                                    </div>
                                    <div style="text-align: right;">
                                        <div style="font-weight: 600; color: #333;">$1,247</div>
                                        <div style="font-size: 0.8rem; color: #666;">67.5%</div>
                                    </div>
                                </div>
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; padding: 12px; background: #f8f9fa; border-radius: 8px;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div
                                            style="width: 12px; height: 12px; background: #e91e63; border-radius: 50%;">
                                        </div>
                                        <span style="font-size: 0.9rem; color: #666;">Custom Ribbons</span>
                                    </div>
                                    <div style="text-align: right;">
                                        <div style="font-weight: 600; color: #333;">$324</div>
                                        <div style="font-size: 0.8rem; color: #666;">17.5%</div>
                                    </div>
                                </div>
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; padding: 12px; background: #f8f9fa; border-radius: 8px;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div
                                            style="width: 12px; height: 12px; background: #e91e63; border-radius: 50%;">
                                        </div>
                                        <span style="font-size: 0.9rem; color: #666;">Gift Cards</span>
                                    </div>
                                    <div style="text-align: right;">
                                        <div style="font-weight: 600; color: #333;">$156</div>
                                        <div style="font-size: 0.8rem; color: #666;">8.4%</div>
                                    </div>
                                </div>
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0; padding: 12px; background: #f8f9fa; border-radius: 8px;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div
                                            style="width: 12px; height: 12px; background: #e91e63; border-radius: 50%;">
                                        </div>
                                        <span style="font-size: 0.9rem; color: #666;">Gift Boxes</span>
                                    </div>
                                    <div style="text-align: right;">
                                        <div style="font-weight: 600; color: #333;">$120</div>
                                        <div style="font-size: 0.8rem; color: #666;">6.5%</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            style="background: white; border-radius: 16px; padding: 28px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);">
                            <h3 style="margin-bottom: 24px; color: #333; font-size: 1.2rem;">
                                <i class="fas fa-calendar-alt" style="color: #e91e63; margin-right: 8px;"></i>
                                Weekly Performance
                            </h3>
                            <div style="space-y: 12px;">
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                    <span style="font-size: 0.9rem; color: #666;">Monday</span>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div
                                            style="width: 60px; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                            <div style="height: 100%; background: #e91e63; width: 80%;"></div>
                                        </div>
                                        <span style="font-weight: 600; color: #333; font-size: 0.9rem;">$124</span>
                                    </div>
                                </div>
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                    <span style="font-size: 0.9rem; color: #666;">Tuesday</span>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div
                                            style="width: 60px; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                            <div style="height: 100%; background: #e91e63; width: 65%;"></div>
                                        </div>
                                        <span style="font-weight: 600; color: #333; font-size: 0.9rem;">$98</span>
                                    </div>
                                </div>
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                    <span style="font-size: 0.9rem; color: #666;">Wednesday</span>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div
                                            style="width: 60px; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                            <div style="height: 100%; background: #e91e63; width: 90%;"></div>
                                        </div>
                                        <span style="font-weight: 600; color: #333; font-size: 0.9rem;">$142</span>
                                    </div>
                                </div>
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                    <span style="font-size: 0.9rem; color: #666;">Thursday</span>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div
                                            style="width: 60px; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                            <div style="height: 100%; background: #e91e63; width: 100%;"></div>
                                        </div>
                                        <span style="font-weight: 600; color: #333; font-size: 0.9rem;">$156</span>
                                    </div>
                                </div>
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                    <span style="font-size: 0.9rem; color: #666;">Friday</span>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div
                                            style="width: 60px; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                            <div style="height: 100%; background: #e91e63; width: 75%;"></div>
                                        </div>
                                        <span style="font-weight: 600; color: #333; font-size: 0.9rem;">$118</span>
                                    </div>
                                </div>
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                    <span style="font-size: 0.9rem; color: #666;">Saturday</span>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div
                                            style="width: 60px; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                            <div style="height: 100%; background: #e91e63; width: 95%;"></div>
                                        </div>
                                        <span style="font-weight: 600; color: #333; font-size: 0.9rem;">$148</span>
                                    </div>
                                </div>
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0;">
                                    <span style="font-size: 0.9rem; color: #666;">Sunday</span>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div
                                            style="width: 60px; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                            <div style="height: 100%; background: #e91e63; width: 60%;"></div>
                                        </div>
                                        <span style="font-weight: 600; color: #333; font-size: 0.9rem;">$92</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    style="background: white; border-radius: 16px; padding: 28px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);">
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                        <h3 style="color: #333; font-size: 1.2rem;">
                            <i class="fas fa-receipt" style="color: #e91e63; margin-right: 8px;"></i>
                            Recent Payment History
                        </h3>
                        <button class="btn btn-outline" onclick="exportPayments()">
                            <i class="fas fa-download"></i>
                            Export
                        </button>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Order ID</th>
                                <th>Service</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Jan 20, 2024</td>
                                <td>WRP-001</td>
                                <td>Premium Gift Wrapping</td>
                                <td>Sarah Johnson</td>
                                <td style="font-weight: 600;">$25.00</td>
                                <td><span class="status-badge status-paid">Paid</span></td>
                                <td>
                                    <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;"
                                        onclick="viewReceipt('WRP-001')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Jan 19, 2024</td>
                                <td>WRP-002</td>
                                <td>Custom Ribbon + Card</td>
                                <td>Michael Chen</td>
                                <td style="font-weight: 600;">$12.00</td>
                                <td><span class="status-badge status-paid">Paid</span></td>
                                <td>
                                    <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;"
                                        onclick="viewReceipt('WRP-002')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Jan 18, 2024</td>
                                <td>WRP-003</td>
                                <td>Luxury Gift Box</td>
                                <td>Emma Wilson</td>
                                <td style="font-weight: 600;">$35.00</td>
                                <td><span class="status-badge status-pending">Pending</span></td>
                                <td>
                                    <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;"
                                        onclick="followUpPayment('WRP-003')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Jan 17, 2024</td>
                                <td>WRP-004</td>
                                <td>Theme Wrapping</td>
                                <td>David Lee</td>
                                <td style="font-weight: 600;">$28.00</td>
                                <td><span class="status-badge status-paid">Paid</span></td>
                                <td>
                                    <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;"
                                        onclick="viewReceipt('WRP-004')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    </div>

    <script src="script.js"></script>
</body>

</html>