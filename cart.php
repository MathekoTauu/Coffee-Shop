<?php
// This MUST be the very first thing in the file - no whitespace before!
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];

// Now include your header after all session operations
include 'includes/header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        
        
        main {
            padding: 20px;
            max-width: 1000px;
            margin: 0 auto;
        }
        
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #C4A484;
            color: white;
        }
        
        tr:hover {
            background-color: #f5f5f5;
        }
        
        .button {
            background-color: #6F4E37;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        
        .button:hover {
            background-color: #3E2723;
        }
    </style>
</head>
<body>
    <header>
        <h1><?php echo htmlspecialchars($user['name']); ?>'s Shopping Cart</h1>
    </header>

 
    <main>
<section>
    <table>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "coffee_db";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $total = 0;

        // Check if cart exists and has items
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            echo "<tr><td colspan='5'>Your cart is empty</td></tr>";
        } else {
            // Loop through items in cart and display in table
            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                // Sanitize product_id
                $product_id = (int)$product_id;

                // Use prepared statement to prevent SQL injection
                $stmt = $conn->prepare("SELECT name, price FROM tblproduct WHERE id = ?");
                $stmt->bind_param("i", $product_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $name = htmlspecialchars($row['name']);
                    $price = (float)$row['price'];
                    $quantity = (int)$quantity;
                    $item_total = $price * $quantity;
                    $total += $item_total;

                    echo "<tr>";
                    echo "<td>$name</td>";
                    echo "<td>$quantity</td>";
                    echo "<td>" . number_format($price, 2) . " $</td>";
                    echo "<td>" . number_format($item_total, 2) . " $</td>";
                    echo "<td>
                              <form action='update_cart.php' method='post'>
                                  <input type='hidden' name='product_id' value='$product_id' />
                                  <input type='hidden' name='action' value='reduce' />
                                  <input type='submit' value='Reduce' class='button' />
                              </form>
                          </td>";
                    echo "</tr>";
                }
            }

            // Display total if there are items in cart
            if ($total > 0) {
                echo "<tr>";
                echo "<td colspan='3'><strong>Total:</strong></td>";
                echo "<td><strong>" . number_format($total, 2) . " $</strong></td>";
                echo "<td></td>";  // Empty cell for alignment
                echo "</tr>";
            }
        }
        $conn->close();
        ?>
    </table>

    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart']) && $total > 0): ?>
    <form action="checkout.php" method="post">
        <input type="submit" 
               value="Proceed to Checkout" 
               class="button" />
    </form>
    <?php endif; ?>
</section>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>