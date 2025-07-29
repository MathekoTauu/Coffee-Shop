<?php
session_start();

if (!isset($_SESSION['order_number'])) {
    header("Location: menu.php");
    exit();
}

$order_number = $_SESSION['order_number'];
unset($_SESSION['order_number']);

include 'includes/header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation - Coffee Shop</title>
    <style>
        .confirmation-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        h1 {
            color: #6F4E37;
            margin-bottom: 1rem;
        }
        .order-number {
            font-size: 1.5rem;
            margin: 1rem 0;
            color: #3E2723;
        }
        .confirmation-message {
            margin: 2rem 0;
            line-height: 1.6;
        }
        .button {
            background-color: #6F4E37;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            margin-top: 1rem;
        }
        .button:hover {
            background-color: #3E2723;
        }
    </style>
</head>
<body>
    <div class="confirmation-container">
        <h1>Order Confirmed!</h1>
        <div class="order-number">Order #<?php echo htmlspecialchars($order_number); ?></div>
        
        <div class="confirmation-message">
            <p>Thank you for your order! We've sent a confirmation to your email.</p>
            <p>Your coffee will be ready at the selected pickup time.</p>
        </div>
        
        <a href="menu.php" class="button">Back to Menu</a>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>