<?php include('check_user.php'); ?>
<!-- database -->

<!-- header part -->
<?php include("./pages/common_pages/header.php"); ?>

<!--navbar and sidebar part start-->
<?php include("./pages/common_pages/navber.php"); ?>
<?php include("./pages/common_pages/sidebar.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS</title>
    <style>
        h2 {
            text-align: center;
            color: rgb(9, 20, 141);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: rgb(11, 17, 174);
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        button {
            background-color: rgb(5, 9, 130);
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 14px;
        }

        button:hover {
            background-color: rgb(59, 56, 247);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search-input');
            searchInput.addEventListener('keyup', function () {
                const searchValue = this.value.toLowerCase();
                const tableRows = document.querySelectorAll('#product-table-body tr');

                tableRows.forEach(function (row) {
                    const productName = row.querySelector('td:first-child').textContent.toLowerCase();
                    if (productName.includes(searchValue)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>
</head>
<body>
    <main>
        <h2>Point of Sale</h2>
        <div class="form-group">
            <label for="search-input">Search by name</label>
            <input type="text" id="search-input" class="form-control" placeholder="Enter product name">
        </div>
        <form method="POST" id="order-form">
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody id="product-table-body">
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "phamanest_db");
                    $products = $conn->query("SELECT * FROM products");
                    while ($product = $products->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($product['name']); ?></td>
                            <td>$<?php echo number_format($product['price'], 2); ?></td>
                            <td><?php echo $product['stock']; ?></td>
                            <td>
                                <input type="number" name="cart[<?php echo $product['id']; ?>]" 
                                    min="0" max="<?php echo $product['stock']; ?>" value="0">
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <div>
                <label>Discount (%): <input type="number" name="discount" value="0" min="0" max="100"></label>
                <label>Tax Rate (%): <input type="number" name="tax" value="0" min="0" max="100"></label>
            </div>
            <button class="d-block mx-auto" type="submit" name="process_order">Process Order</button>
        </form>
    

    <?php
    if (isset($_POST['process_order'])) {
        $cart = $_POST['cart'];
        $discount = $_POST['discount'];
        $taxRate = $_POST['tax'];
        $total = 0;

        $conn->query("INSERT INTO orders (total_amount, discount, tax, net_total) VALUES (0, 0, 0, 0)");
        $orderId = $conn->insert_id;

        foreach ($cart as $productId => $quantity) {
            if ($quantity > 0) {
                $product = $conn->query("SELECT * FROM products WHERE id=$productId")->fetch_assoc();
                $subtotal = $product['price'] * $quantity;
                $total += $subtotal;

                $conn->query("INSERT INTO order_items (order_id, product_id, quantity, subtotal) VALUES ($orderId, $productId, $quantity, $subtotal)");
                $conn->query("UPDATE products SET stock = stock - $quantity WHERE id=$productId");
            }
        }

        $discountAmount = ($total * $discount) / 100;
        $tax = (($total - $discountAmount) * $taxRate) / 100;
        $netTotal = $total - $discountAmount + $tax;

        $conn->query("UPDATE orders SET total_amount=$total, discount=$discountAmount, tax=$tax, net_total=$netTotal WHERE id=$orderId");

        echo "<h3>Order Processed Successfully! Receipt:</h3>";
        echo "<table class='receipt'>
                <tr><th>Description</th><th>Amount</th></tr>
                <tr><td>Total</td><td>$" . number_format($total, 2) . "</td></tr>
                <tr><td>Discount</td><td>$" . number_format($discountAmount, 2) . "</td></tr>
                <tr><td>Tax</td><td>$" . number_format($tax, 2) . "</td></tr>
                <tr><td><strong>Net Total</strong></td><td><strong>$" . number_format($netTotal, 2) . "</strong></td></tr>
              </table>";
             
    }
    ?>
    </main>
</body>
</html>

<?php include("./pages/common_pages/footer.php"); ?>
