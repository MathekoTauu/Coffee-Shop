<?php
/*
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Include database configuration
require_once 'db.php';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $pickup_time = filter_input(INPUT_POST, 'pickup_time', FILTER_SANITIZE_STRING);
    $special_instructions = filter_input(INPUT_POST, 'special_instructions', FILTER_SANITIZE_STRING);
    
    // Validate required fields
    if (!$name || !$email || !$phone || !$pickup_time) {
        $_SESSION['error'] = "Please fill all required fields";
        header("Location: order_ahead.php");
        exit();
    }

    // Get cart items
    $cart_items = [];
    $total = 0;
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $stmt = $conn->prepare("SELECT name, price FROM tblproduct WHERE id = ?");
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $item_total = $row['price'] * $quantity;
                $total += $item_total;
                
                $cart_items[] = [
                    'name' => $row['name'],
                    'quantity' => $quantity,
                    'price' => $row['price'],
                    'item_total' => $item_total
                ];
            }
        }
    }

    // Save order to database
    $order_number = 'ORD-' . strtoupper(uniqid());
    $order_date = date('Y-m-d H:i:s');
    $status = 'pending';
    
    $stmt = $conn->prepare("INSERT INTO orders (order_number, user_id, order_date, pickup_time, total, status, special_instructions) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssds", $order_number, $_SESSION['user']['id'], $order_date, $pickup_time, $total, $status, $special_instructions);
    $stmt->execute();
    $order_id = $stmt->insert_id;
    
    // Save order items
    foreach ($cart_items as $item) {
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_name, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isid", $order_id, $item['name'], $item['quantity'], $item['price']);
        $stmt->execute();
    }

    // Send confirmation email
    sendOrderConfirmationEmail($email, $name, $order_number, $pickup_time, $cart_items, $total);
    
    // Clear cart
    unset($_SESSION['cart']);
    
    // Redirect to confirmation page
    $_SESSION['order_number'] = $order_number;
    header("Location: order_confirmation.php");
    exit();
}

// Email sending function
function sendOrderConfirmationEmail($to, $name, $order_number, $pickup_time, $items, $total) {
    $subject = "Your Coffee Order Confirmation (#$order_number)";
    
    $message = "
    <html>
    <head>
        <title>Order Confirmation</title>
        <style>
            body { font-family: Arial, sans-serif; }
            .header { color: #6F4E37; }
            table { width: 100%; border-collapse: collapse; }
            th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
            .total { font-weight: bold; }
        </style>
    </head>
    <body>
        <h2 class='header'>Thank you for your order, $name!</h2>
        <p>Your order #$order_number is confirmed and will be ready for pickup at $pickup_time.</p>
        
        <h3>Order Summary</h3>
        <table>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>";
    
    foreach ($items as $item) {
        $message .= "
            <tr>
                <td>{$item['name']}</td>
                <td>{$item['quantity']}</td>
                <td>$".number_format($item['price'], 2)."</td>
                <td>$".number_format($item['item_total'], 2)."</td>
            </tr>";
    }
    
    $message .= "
            <tr class='total'>
                <td colspan='3'>Total</td>
                <td>$".number_format($total, 2)."</td>
            </tr>
        </table>
        
        <p>We look forward to serving you!</p>
        <p>The Coffee Shop Team</p>
    </body>
    </html>
    ";
    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: orders@coffeeshop.com" . "\r\n";
    
    mail($to, $subject, $message, $headers);
}
*/
include 'includes/header.php';
?>


<!DOCTYPE html>
<html>
<head>
    <title>Order Ahead - Coffee Shop</title>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Poppins', sans-serif;
        }
        .order-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #6F4E37;
            text-align: center;
            margin-bottom: 2rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        input, textarea, select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: inherit;
        }
        .required:after {
            content: " *";
            color: red;
        }
        .button {
            background-color: #6F4E37;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            width: 100%;
            margin-top: 1rem;
        }
        .button:hover {
            background-color: #3E2723;
        }
        .error {
            color: red;
            margin-top: 0.5rem;
        }
        .cart-summary {
            margin-top: 2rem;
            border-top: 1px solid #eee;
            padding-top: 1rem;
        }
    </style>
</head>
<h1>Page Under develpment </h1>
<body>
    <div class="order-container">
       
        <h1>Order Ahead</h1>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        
        <form method="post" action="order_ahead.php">
            <div class="form-group">
                <label class="required">Full Name</label>
                <input type="text" name="name" required value="<?php echo isset($_SESSION['user']['name']) ? htmlspecialchars($_SESSION['user']['name']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label class="required">Email</label>
                <input type="email" name="email" required value="<?php echo isset($_SESSION['user']['email']) ? htmlspecialchars($_SESSION['user']['email']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label class="required">Phone Number</label>
                <input type="tel" name="phone" required>
            </div>
            
            <div class="form-group">
                <label class="required">Pickup Time</label>
                <input type="datetime-local" name="pickup_time" required min="<?php echo date('Y-m-d\TH:i'); ?>">
            </div>
            
            <div class="form-group">
                <label>Special Instructions</label>
                <textarea name="special_instructions" rows="3"></textarea>
            </div>
            
            <div class="cart-summary">
                <h3>Your Order</h3>
                <?php if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])): ?>
                    <p>Your cart is empty</p>
                <?php else: ?>
                    <table>
                        <tr>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Price</th>
                        </tr>
                        <?php 
                        $total = 0;
                        foreach ($_SESSION['cart'] as $product_id => $quantity): 
                            $stmt = $conn->prepare("SELECT name, price FROM tblproduct WHERE id = ?");
                            $stmt->bind_param("i", $product_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            $item_total = $row['price'] * $quantity;
                            $total += $item_total;
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo $quantity; ?></td>
                                <td>$<?php echo number_format($item_total, 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="2"><strong>Total</strong></td>
                            <td><strong>$<?php echo number_format($total, 2); ?></strong></td>
                        </tr>
                    </table>
                <?php endif; ?>
            </div>
            
            <button type="submit" class="button">Place Order</button>
        </form>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>