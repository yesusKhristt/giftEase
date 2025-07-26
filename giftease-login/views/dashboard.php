<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome</title>
  <link rel="stylesheet" href="/style.css">
</head>
<body>
  <div class="login-container">
    <h1>✅ Welcome, <?= htmlspecialchars($user['name']) ?>!</h1>
    <p>You have successfully logged in to GiftEase.</p>
  </div>
</body>
</html>
