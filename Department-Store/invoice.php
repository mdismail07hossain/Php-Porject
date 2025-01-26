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
                        // var_dump($orders);
    
                        
                        ?>

                        <!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Purchase History</title>
                            <!------------------------- design start  ---------------------->
                            <style>
                                /* body {
                                    font-family: Arial, sans-serif;
                                    margin: 20px;
                                    background-color: #f9f9f9;
                                    color: #333;
                                } */
                                                                .details {
                                    background-color: #f9f9f9;
                                    padding: 20px;
                                    border-radius: 8px;
                                    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                                }

                                .order-item {
                                    display: flex;
                                    justify-content: space-between;
                                    padding: 10px 0;
                                    border-bottom: 1px solid #ddd;
                                }

                                .order-item:last-child {
                                    border-bottom: none;
                                }

                                .item-name {
                                    font-size: 1em;
                                    color: #555;
                                }

                                .item-subtotal {
                                    font-size: 1.1em;
                                    color: #e74c3c;
                                    font-weight: bold;
                                }

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
                        <main class="m-5">
        <h2>Purchase History</h2>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Total</th>
                <th>Discount</th>
                <th>Tax</th>
                <th>Net Total</th>
                <th>Details</th>
            </tr>
            <?php while ($order = $orders->fetch_assoc()): ?>
            <tr>
                <td><?php echo $order['id']; ?></td>
                <td><?php echo $order['order_date']; ?></td>
                <td>$<?php echo number_format($order['total_amount'], 2); ?></td>
                <td>$<?php echo number_format($order['discount'], 2); ?></td>
                <td>$<?php echo number_format($order['tax'], 2); ?></td>
                <td>$<?php echo number_format($order['net_total'], 2); ?></td>
                <td>
                    <a href="invoicedetails.php?invoiceId=<?php echo urlencode($order['id']); ?>" class="btn btn-primary">
                        View Order Details
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </main>
                        </body>
                        </html>
                        <?php include("./pages/common_pages/footer.php");?>