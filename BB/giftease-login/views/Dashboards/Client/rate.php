<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rate Vendor - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <style>
        .rating-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .rating-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .star-rating {
            display: flex;
            justify-content: center;
            gap: 10px;
            font-size: 40px;
            margin: 20px 0;
        }
        .star {
            cursor: pointer;
            color: #ddd;
            transition: color 0.2s;
        }
        .star:hover,
        .star.active {
            color: #ffc107;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: inherit;
            resize: vertical;
            min-height: 100px;
        }
        .btn-submit {
            background: #4CAF50;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            margin-top: 10px;
        }
        .btn-submit:hover {
            background: #45a049;
        }
        .btn-cancel {
            background: #f44336;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            margin-top: 10px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        .btn-cancel:hover {
            background: #da190b;
        }
        .rating-value {
            text-align: center;
            font-size: 18px;
            color: #666;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        $activePage = 'rate';
        include 'views/commonElements/leftSidebarDilma.php';
        ?>
        <div class="main-content">
            <div class="rating-container">
                <div class="rating-header">
                    <h1>Rate Vendor</h1>
                    <p>Share your experience with this vendor</p>
                </div>

                <form action="index.php?controller=vendorRating&action=submit" method="POST" id="ratingForm">
                    <input type="hidden" name="vendor_id" value="<?= htmlspecialchars($_GET['vendor_id']) ?>">
                    <input type="hidden" name="order_id" value="<?= htmlspecialchars($_GET['order_id']) ?>">
                    <input type="hidden" name="rating" id="ratingValue" value="0">
                    
                    <!-- DEBUG: Show vendor_id and order_id being passed -->
                    <div style="background: #f0f0f0; padding: 10px; border-radius: 5px; margin-bottom: 20px; font-size: 12px;">
                        <strong>Debug Info:</strong><br>
                        Vendor ID: <?= htmlspecialchars($_GET['vendor_id'] ?? 'NULL') ?><br>
                        Order ID: <?= htmlspecialchars($_GET['order_id'] ?? 'NULL') ?>
                    </div>

                    <div class="form-group">
                        <label>Your Rating</label>
                        <div class="star-rating" id="starRating">
                            <span class="star" data-rating="1">★</span>
                            <span class="star" data-rating="2">★</span>
                            <span class="star" data-rating="3">★</span>
                            <span class="star" data-rating="4">★</span>
                            <span class="star" data-rating="5">★</span>
                        </div>
                        <div class="rating-value" id="ratingText">Click stars to rate</div>
                    </div>

                    <div class="form-group">
                        <label for="review">Your Review (Optional)</label>
                        <textarea name="review" id="review" placeholder="Share details of your experience..."></textarea>
                    </div>

                    <button type="submit" class="btn-submit">Submit Rating</button>
                    <a href="index.php?controller=client&action=history" class="btn-cancel">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        const stars = document.querySelectorAll('.star');
        const ratingValue = document.getElementById('ratingValue');
        const ratingText = document.getElementById('ratingText');
        const ratingForm = document.getElementById('ratingForm');

        let selectedRating = 0;

        stars.forEach(star => {
            star.addEventListener('click', function() {
                selectedRating = parseInt(this.getAttribute('data-rating'));
                ratingValue.value = selectedRating;
                updateStars(selectedRating);
                updateRatingText(selectedRating);
            });

            star.addEventListener('mouseenter', function() {
                const hoverRating = parseInt(this.getAttribute('data-rating'));
                updateStars(hoverRating);
            });
        });

        document.getElementById('starRating').addEventListener('mouseleave', function() {
            updateStars(selectedRating);
        });

        function updateStars(rating) {
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });
        }

        function updateRatingText(rating) {
            const ratingTexts = ['', 'Poor', 'Fair', 'Good', 'Very Good', 'Excellent'];
            ratingText.textContent = ratingTexts[rating] + ' (' + rating + ' star' + (rating !== 1 ? 's' : '') + ')';
        }

        ratingForm.addEventListener('submit', function(e) {
            if (selectedRating === 0) {
                e.preventDefault();
                alert('Please select a rating before submitting');
            }
        });
    </script>
</body>
</html>
