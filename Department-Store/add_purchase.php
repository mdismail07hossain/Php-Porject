
                    <?php include('check_user.php'); ?>
                    <!-- database -->

                    <!-- header part -->
                    <?php include("./pages/common_pages/header.php");?>

                    <!--navbar and sidebar part start-->
                    <?php include("./pages/common_pages/navber.php"); ?>
                   <?php include("./pages/common_pages/sidebar.php"); ?>
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "phamanest_db");

                    $products = $conn->query("SELECT * FROM products");

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

                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>POS</title>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                margin: 20px;
                                background-color: #f4f4f9;
                                color: #333;
                            }

                            h2, h3 {
                                text-align: center;
                                color:rgb(58, 11, 178);
                            }

                            table {
                                width: 100%;
                                border-collapse: collapse;
                                margin-top: 20px;
                                background-color: #fff;
                                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                            }

                            th, td {
                                padding: 12px;
                                text-align: left;
                                border: 1px solid #ddd;
                            }

                            th {
                                background-color:rgb(24, 14, 167);
                                color: white;
                            }

                            tr:nth-child(even) {
                                background-color: #f2f2f2;
                            }

                            input[type="number"] {
                                width: 70px;
                                padding: 5px;
                                border: 1px solid #ccc;
                                border-radius: 4px;
                            }

                            label {
                                display: block;
                                margin: 15px 0;
                                font-size: 16px;
                            }

                            button {
                                background-color:rgb(33, 10, 165);
                                color: white;
                                border: none;
                                padding: 10px 15px;
                                cursor: pointer;
                                border-radius: 4px;
                                font-size: 16px;
                                display: block;
                                margin: 20px auto;
                            }

                            button:hover {
                                background-color:rgb(44, 18, 246);
                            }

                            form {
                                max-width: 800px;
                                margin: 0 auto;
                                padding: 20px;
                                background-color: #fff;
                                border: 1px solid #ddd;
                                border-radius: 8px;
                                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                            }

                            .receipt {
                                max-width: 600px;
                                margin: 20px auto;
                                border-collapse: collapse;
                                width: 100%;
                            }

                            .receipt th {
                                background-color: #333;
                                color: white;
                                text-align: left;
                            }

                            .receipt td {
                                text-align: right;
                            }

                            .receipt tr:last-child td {
                                font-weight: bold;
                                color:rgb(14, 10, 130);
                            }
                        </style>
                    </head>
                    <body>
                        <main>
                        <h2>Point of Sale</h2>
                        <form method="POST">
                            <table>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Quantity</th>
                                </tr>
                                <?php while ($product = $products->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                                    <td>$<?php echo number_format($product['price'], 2); ?></td>
                                    <td><?php echo $product['stock']; ?></td>
                                    <td><input type="number" name="cart[<?php echo $product['id']; ?>]" min="0" max="<?php echo $product['stock']; ?>"></td>
                                </tr>
                                <?php endwhile; ?>
                            </table>
                            <label>Discount (%): <input type="number" name="discount" value="0" min="0" max="100"></label>
                            <label>Tax Rate (%): <input type="number" name="tax" value="0" min="0" max="100"></label>
                            <button type="submit" name="process_order">Process Order</button>
                        </form>
                        </main>
                    </body>
                    </html>
<?php include("./pages/common_pages/footer.php");?>