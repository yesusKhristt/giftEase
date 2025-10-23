<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wrapping Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link rel="profile" href="profile.php" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
   
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <div class="container">
        <?php
        $activePage = 'analytics';
        include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/leftSidebarJeshani.php';
        ?>
        <!-- <div id="home" class="tab-content active"> -->
        <!-- Home page -->
        <div class="main-content">
            <div class="section-header">
                <div>
                    <h2 class="section-title">Business Analytics</h2>
                    <p class="section-subtitle">Detailed insights into your wrapping business performance</p>
                </div>
                <div style="display: flex; gap: 12px;">
                    <select style="padding: 8px 12px; border: 1px solid #e0e0e0; border-radius: 6px;"
                        onchange="changeAnalyticsPeriod(this.value)">
                        <option value="week">This Week</option>
                        <option value="month" selected>This Month</option>
                        <option value="quarter">This Quarter</option>
                        <option value="year">This Year</option>
                    </select>
                    <button class="btn1" onclick="generateReport()">
                        <i class="fas fa-file-pdf"></i>
                        Generate Report
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="summary-grid">
                <div class="card">
                    <div class="stat-header">
                        <span class="stat-label">Total Orders</span>
                        <!-- <div class="stat-icon" style="background: linear-gradient(135deg, #9c27b0, #ba68c8);"> -->
                        <i class="fas fa-shopping-bag"></i>
                    </div>


                    <div class="stat-value">47</div>
                    <div class="stat-description">
                        <i class="fas fa-arrow-up trend-up"></i>
                        <span>+23% from last month</span>
                    </div>
                </div>



                <div class="card">
                    <div class="stat-header">
                        <span class="stat-label">Customer Retention</span>
                        <!-- <div class="stat-icon" style="background: linear-gradient(135deg, #4caf50, #66bb6a);"> -->
                        <i class="fas fa-users"></i>
                        <!-- </div> -->
                    </div>
                    <div class="stat-value">78%</div>
                    <div class="stat-description">
                        <i class="fas fa-arrow-up trend-up"></i>
                        <span>Excellent retention rate</span>
                    </div>
                </div>
                </div>
                


                <div class="summary-grid">
                <div class="card">
                    <div class="stat-header">
                        <span class="stat-label">Peak Hours</span>
                        <!-- <div class="stat-icon" style="background: linear-gradient(135deg, #ff9800, #ffb74d);"> -->
                        <i class="fas fa-clock"></i>
                        <!-- </div> -->
                    </div>
                    <div class="stat-value">2-6 PM</div>
                    <div class="stat-description">
                        <i class="fas fa-info-circle"></i>
                        <span>Busiest time period</span>
                    </div>
                </div>



                <div class="card">
                    <div class="stat-header">
                        <span class="stat-label">Efficiency Score</span>
                        <!-- <div class="stat-icon" style="background: linear-gradient(135deg, #2196f3, #42a5f5);"> -->
                        <i class="fas fa-tachometer-alt"></i>
                        <!-- </div> -->
                    </div>
                    <div class="stat-value">94%</div>
                    <div class="stat-description">
                        <i class="fas fa-arrow-up trend-up"></i>
                        <span>Above industry average</span>
                    </div>
                </div>
            </div>
            </div>

            <canvas id="riskChart"></canvas>
                       

            <div class="card">
                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; margin-bottom: 32px;">
                    <div
                        style="background: white; border-radius: 16px; padding: 28px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);">
                        <h3 style="margin-bottom: 24px; color: #333; font-size: 1.2rem;">
                            <i class="fas fa-chart-area" style="color: #e91e63; margin-right: 8px;"></i>
                            Revenue Trend
                        </h3>
                        <!-- <div class="card">
                            <div
                                style="height: 220px; display: flex; align-items: end; justify-content: space-between; padding: 20px; background: #f8f9fa; border-radius: 12px;">
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                                    <div
                                        style="width: 30px; height: 80px; background: linear-gradient(to top, #e91e63, #fed2ed); border-radius: 4px;">
                                    </div>
                                    <span style="font-size: 0.8rem; color: #666;">Week 1</span>
                                </div>
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                                    <div
                                        style="width: 30px; height: 120px; background: linear-gradient(to top, #e91e63, #fed2ed); border-radius: 4px;">
                                    </div>
                                    <span style="font-size: 0.8rem; color: #666;">Week 2</span>
                                </div>
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                                    <div
                                        style="width: 30px; height: 100px; background: linear-gradient(to top, #e91e63, #fed2ed); border-radius: 4px;">
                                    </div>
                                    <span style="font-size: 0.8rem; color: #666;">Week 3</span>
                                </div>
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                                    <div
                                        style="width: 30px; height: 160px; background: linear-gradient(to top, #e91e63, #fed2ed); border-radius: 4px;">
                                    </div>
                                    <span style="font-size: 0.8rem; color: #666;">Week 4</span>
                                </div>
                            </div>
                        </div> -->
                        
                         <canvas id="vaccChart" height="255px"></canvas>
                    </div>

                    <div class="card">
                        <div
                            style="background: white; border-radius: 16px; padding: 28px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);">
                            <h3 style="margin-bottom: 24px; color: #333; font-size: 1.2rem;">
                                <i class="fas fa-star" style="color: #e91e63; margin-right: 8px;"></i>
                                Customer Feedback
                            </h3>
                            <div style="space-y: 16px;">
                                <div style="margin-bottom: 16px;">
                                    <div
                                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                        <span style="font-size: 0.9rem; color: #666;">5 Stars</span>
                                        <span style="font-size: 0.9rem; font-weight: 600;">78%</span>
                                    </div>
                                    <div
                                        style="width: 100%; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                        <div style="height: 100%; background: #e91e63; width: 78%;"></div>
                                    </div>
                                </div>
                                <div style="margin-bottom: 16px;">
                                    <div
                                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                        <span style="font-size: 0.9rem; color: #666;">4 Stars</span>
                                        <span style="font-size: 0.9rem; font-weight: 600;">18%</span>
                                    </div>
                                    <div
                                        style="width: 100%; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                        <div style="height: 100%; background: #e91e63; width: 18%;"></div>
                                    </div>
                                </div>
                                <div style="margin-bottom: 16px;">
                                    <div
                                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                        <span style="font-size: 0.9rem; color: #666;">3 Stars</span>
                                        <span style="font-size: 0.9rem; font-weight: 600;">3%</span>
                                    </div>
                                    <div
                                        style="width: 100%; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                        <div style="height: 100%; background: #e91e63; width: 3%;"></div>
                                    </div>
                                </div>
                                <div style="margin-bottom: 16px;">
                                    <div
                                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                        <span style="font-size: 0.9rem; color: #666;">2 Stars</span>
                                        <span style="font-size: 0.9rem; font-weight: 600;">1%</span>
                                    </div>
                                    <div
                                        style="width: 100%; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                        <div style="height: 100%; background: #e91e63; width: 1%;"></div>
                                    </div>
                                </div>
                                <div style="margin-bottom: 0;">
                                    <div
                                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                        <span style="font-size: 0.9rem; color: #666;">1 Star</span>
                                        <span style="font-size: 0.9rem; font-weight: 600;">0%</span>
                                    </div>
                                    <div
                                        style="width: 100%; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                        <div style="height: 100%; background: #e91e63; width: 0%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                style="background: white; border-radius: 16px; padding: 28px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);">
                <h3 style="margin-bottom: 24px; color: #333; font-size: 1.2rem;">
                    <i class="fas fa-lightbulb" style="color: #e91e63; margin-right: 8px;"></i>
                    Business Insights & Recommendations
                </h3>
                <div class="card">
                    <div class="summary-grid">
                    <div class="card">
                        <h4>Growth Opportunity</h4>
                        <p>Your premium wrapping service has 23% higher demand. Consider expanding your premium material
                            inventory.</p>
                    </div>
                    <div class="card">
                        <h4>Peak Time Insight</h4>
                        <p>Most orders come between 2-6 PM. Consider offering express service during these hours for
                            premium pricing.</p>
                    </div>
                    <div class="card">
                        <h4>Customer Loyalty</h4>
                        <p>78% customer retention rate is excellent! Consider implementing a loyalty program to reward
                            repeat customers.</p>
                    </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- <script src="script.js"></script> -->
    <script>
    // ---------- Stacked Bar (Antenatal Risk Cases) ----------
    const riskCtx = document.getElementById('riskChart').getContext('2d');

    const riskData = {
        labels: ['18 - 25', '25 - 30', '30 - 40', '40 - 50', '50+'],
        datasets: [
            {
                label: 'Normal',
                data: [7, 11, 13, 2, 3],
                backgroundColor: '#10B981', // green
                borderRadius: 6,
                barThickness: 28
            },
            {
                label: 'Moderate',
                data: [5, 11, 16, 3, 4],
                backgroundColor: '#F59E0B', // amber
                borderRadius: 6,
                barThickness: 28
            },
            {
                label: 'High',
                data: [1, 12, 6, 7, 4],
                backgroundColor: '#EF4444', // red
                borderRadius: 6,
                barThickness: 28
            }
        ]
    };

    const riskConfig = {
        type: 'bar',
        data: riskData,
        options: {
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    labels: { boxWidth: 12, boxHeight: 12, padding: 12 }
                },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                x: {
                    stacked: true,
                    grid: { display: false },
                    ticks: { color: '#374151', font: { size: 12 } }
                },
                y: {
                    stacked: true,
                    beginAtZero: true,
                    max: 50,
                    ticks: {
                        stepSize: 10,
                        color: '#6b7280',
                        font: { size: 12 }
                    },
                    grid: {
                        borderDash: [4, 4],
                        color: 'rgba(15, 23, 42, 0.06)'
                    }
                }
            }
        }
    };

    new Chart(riskCtx, riskConfig);

    // ---------- Doughnut (Monthly Vaccinations Completed) ----------
    const vaccCtx = document.getElementById('vaccChart').getContext('2d');

    // Values chosen to total 254 (so the center text matches)
    const vaccData = {
        labels: ['Completed', 'Pending', 'Upcoming'],
        datasets: [{
            data: [150, 80, 24], // sums to 254
            backgroundColor: ['#0EA5A4', '#FBC88D', '#F08B77'],
            hoverOffset: 8
        }]
    };

    // small plugin to draw centered text (value + label)
    const centerTextPlugin = {
        id: 'centerText',
        beforeDraw(chart) {
            if (chart.config.type !== 'doughnut') return;
            const { ctx, chartArea } = chart;
            const centerX = (chartArea.left + chartArea.right) / 2;
            const centerY = (chartArea.top + chartArea.bottom) / 2;

            ctx.save();
            // number (bold)
            ctx.font = '700 30px Inter, Arial';
            ctx.fillStyle = '#111827';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillText('254', centerX, centerY - 8);

            // label (lighter)
            ctx.font = '400 13px Inter, Arial';
            ctx.fillStyle = '#6b7280';
            ctx.fillText('Children', centerX, centerY + 20);
            ctx.restore();
        }
    };

    const vaccConfig = {
        type: 'doughnut',
        data: vaccData,
        options: {
            responsive: false,
            maintainAspectRatio: false,
            cutout: '64%',
            plugins: {
                legend: {
                    position: 'right',
                    labels: { usePointStyle: true, pointStyle: 'circle', padding: 12 }
                },
                tooltip: {
                    callbacks: {
                        label: ctx => `${ctx.label}: ${ctx.formattedValue}`
                    }
                }
            }
        },
        plugins: [centerTextPlugin]
    };

    new Chart(vaccCtx, vaccConfig);
</script>
</body>

</html>

<!-- <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                            <div style="padding: 20px; background: linear-gradient(135deg, #e3f2fd, #bbdefb); border-radius: 12px; border-left: 4px solid #2196f3;">
                                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                                    <i class="fas fa-trending-up" style="color: #2196f3; font-size: 1.2rem;"></i>
                                    <h4 style="color: #1976d2; font-size: 1rem;">Growth Opportunity</h4>
                                </div>
                                <p style="color: #1565c0; font-size: 0.9rem; line-height: 1.4;">Your premium wrapping service has 23% higher demand. Consider expanding your premium material inventory.</p>
                            </div>
                            
                            <div style="padding: 20px; background: linear-gradient(135deg, #f3e5f5, #e1bee7); border-radius: 12px; border-left: 4px solid #9c27b0;">
                                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                                    <i class="fas fa-clock" style="color: #9c27b0; font-size: 1.2rem;"></i>
                                    <h4 style="color: #7b1fa2; font-size: 1rem;">Peak Time Insight</h4>
                                </div>
                                <p style="color: #6a1b9a; font-size: 0.9rem; line-height: 1.4;">Most orders come between 2-6 PM. Consider offering express service during these hours for premium pricing.</p>
                            </div>
                            
                            <div style="padding: 20px; background: linear-gradient(135deg, #e8f5e8, #c8e6c9); border-radius: 12px; border-left: 4px solid #4caf50;">
                                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                                    <i class="fas fa-users" style="color: #4caf50; font-size: 1.2rem;"></i>
                                    <h4 style="color: #388e3c; font-size: 1rem;">Customer Loyalty</h4>
                                </div>
                                <p style="color: #2e7d32; font-size: 0.9rem; line-height: 1.4;">78% customer retention rate is excellent! Consider implementing a loyalty program to reward repeat customers.</p>
                            </div>
                        </div> -->