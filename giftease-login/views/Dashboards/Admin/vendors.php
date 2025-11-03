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


                <table class="table">
                    <thead>
                        <tr>
                            <th>oredr ID</th>
                            <th>Vendor id</th>
                            <th>Phone</th>
                            <th>company name</th>
                            <th>rating</th>
                            <th>other details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>001</td>
                            <td>WRP-001</td>
                            <td>0786607436</td>
                            <td>Premium Gift Wrapping</td>
                            <td style="font-weight: 600;">⭐⭐⭐⭐⭐</td>
                            <td><span class="status-badge status-paid">Paid</span></td>
                            <!-- <td>
                                        <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="viewReceipt('WRP-001')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td> -->
                        </tr>
                        <tr>
                            <td>002</td>
                            <td>WRP-002</td>
                            <td>0740792252</td>
                            <td>Custom Ribbon + Card</td>
                            <td style="font-weight: 600;">⭐⭐⭐⭐⭐</td>
                            <td><span class="status-badge status-paid">Paid</span></td>
                            <!-- <td>
                                        <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="viewReceipt('WRP-002')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td> -->
                        </tr>
                        <tr>
                            <td>003</td>
                            <td>WRP-003</td>
                            <td>078570015</td>
                            <td>Luxury Gift Box</td>
                            <td style="font-weight: 600;">⭐⭐⭐⭐⭐</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <!-- <td>
                                        <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="followUpPayment('WRP-003')">
                                            <i class="fas fa-phone"></i>
                                        </button>
                                    </td> -->
                        </tr>
                        <tr>
                            <td>005</td>
                            <td>WRP-004</td>
                            <td>076792354</td>
                            <td>cake</td>
                            <td style="font-weight: 600;">⭐⭐⭐⭐⭐</td>
                            <td><span class="status-badge status-paid">Paid</span></td>
                            <!-- <td>
                                        <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="viewReceipt('WRP-004')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td> -->
                        </tr>
                    </tbody>
                </table>
        </div>
        </section>
    </div>
    </div>
</body>