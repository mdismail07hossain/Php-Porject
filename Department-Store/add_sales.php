<?php include('check_user.php'); ?>
                        <!-- database -->

                        <!-- header part -->
                        <?php include("./pages/common_pages/header.php");?>

                        <!--navbar and sidebar part start-->
                        <?php include("./pages/common_pages/navber.php"); ?>
                        <?php include("./pages/common_pages/sidebar.php"); ?>
                        <?php
                        $conn = mysqli_connect("localhost", "root", "", "phamanest_db");

                        $orders = $conn->query("SELECT * FROM orders");

                        function getOrderDetails($conn, $orderId) {
                            return $conn->query("SELECT products.name, order_items.quantity, order_items.subtotal 
                                                FROM order_items
                                                JOIN products ON order_items.product_id = products.id
                                                WHERE order_id = $orderId");
                        }
                        ?>
                           <?php
                    $conn = mysqli_connect("localhost", "root", "", "phamanest_db");
                    if (isset($_POST['add_product'])) {
                        $name = $_POST['name'];
                        $price = $_POST['price'];
                        $stock = $_POST['stock'];
                        $conn->query("INSERT INTO products (name, price, stock) VALUES ('$name', $price, $stock)");
                    }
                    ?>

                        <!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Order History</title>
                            <!------------------------- design start  ---------------------->
                            <style>
                                /* body {
                                    font-family: Arial, sans-serif;
                                    margin: 20px;
                                    background-color: #f9f9f9;
                                    color: #333;
                                } */

                                h2 {
                                    text-align: center;
                                    color:rgb(9, 20, 141);
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
                                    background-color:rgb(11, 17, 174);
                                    color: white;
                                }

                                tr:nth-child(even) {
                                    background-color: #f2f2f2;
                                }

                                button {
                                    background-color:rgb(5, 9, 130);
                                    color: white;
                                    border: none;
                                    padding: 8px 12px;
                                    cursor: pointer;
                                    border-radius: 4px;
                                    font-size: 14px;
                                }

                                button:hover {
                                    background-color:rgb(59, 56, 247);
                                }

                                .details {
                                    margin-top: 10px;
                                    padding: 10px;
                                    background-color: #f1f1f1;
                                    border: 1px solid #ddd;
                                    border-radius: 4px;
                                    display: none;
                                }

                                .details p {
                                    margin: 5px 0;
                                }
                            </style>
                            <!-------------- design end  --------------------->
                        </head>
                        <body>
                            <main>
                            <form method="POST">
                                    <td><input type="text" name="name" value=""></td>
                                    <td><input type="number" name="price" step="0.01" value=""></td>
                                    <td><input type="number" name="stock" value=""></td>
                                    <button type="submit" name="add_product">Add Sales</button>
                                </form>
                           
                            </main>
                        </body>
                        </html>
                        <?php include("./pages/common_pages/footer.php");?>