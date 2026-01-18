<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vendor Analysis</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .main-content {
            margin-left: 240px;
            padding: 20px 40px;
            width: calc(100% - 240px);
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header input {
            padding: 8px 12px;
            border: none;
            border-radius: 15px;
            background: #ffe4ec;
            width: 200px;
        }

        .cards {
            display: grid;
            . grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }

        .card {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(255, 105, 180, 0.3);
            text-align: center;
        }

        .card h3 {
            color: #ff4f8b;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 1.4em;
            font-weight: 600;
            color: #333;
        }

        .charts {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }

        .chart-container {
            background: #fff;
            border-radius: 20px;
            padding: 20px;
            flex: 1;
            min-width: 350px;
            box-shadow: 0 2px 8px rgba(255, 105, 180, 0.2);
        }

        .chart-container h3 {
            text-align: center;
            color: #ff4f8b;
            margin-bottom: 15px;
        }
    </style>
</head>

<body data-page="reports">

    <div class="container">
        <?php
        $activePage = 'reports';
        include 'views/commonElements/leftSidebarChathu.php';
        ?>
        <div class="main-content">
            <section id="reports" class="page active" aria-labelledby="reports-title">
                <div class="page-header">
                    <h1 class="title">Reports</h1>
                    <p class="subtitle">Generate and download reports</p>

                </div>
                <div style="display: flex; justify-content: center;">

                    <button class="card">
                        <h4>Vendor Report</h4>
                    </button>
                    <button class="card">
                        <h4>Items Report</h4>
                    </button>
                    <button class="card">
                        <h4>Daily Summary</h4>
                    </button>
                    <button class="card">
                        <h4>Cost Analysis</h4>
                    </button>
                </div>

            </section>




            <section class="cards">
                <div class="card">
                    <h3>Monthly Growth</h3>
                    <p>+8.4%</p>
                </div>
                <div class="card">
                    <h3>Top Category</h3>
                    <p>Fashion</p>
                </div>
                <div class="card">
                    <h3>Customer Retention</h3>
                    <p>76%</p>
                </div>
                <div class="card">
                    <h3>Refund Rate</h3>
                    <p>1.2%</p>
                </div>
            </section>



   <script src="/giftEase/giftease-login/public/main.js"></script>

</body>

</html>