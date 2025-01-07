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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <!------------------------- design start  ---------------------->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #4CAF50;
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
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 14px;
        }

        button:hover {
            background-color: #45a049;
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
    <h2>Order History</h2>
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
                <button onclick="toggleDetails(<?php echo $order['id']; ?>)">View Details</button>
                <div id="details-<?php echo $order['id']; ?>" class="details">
                    <?php 
                    $details = getOrderDetails($conn, $order['id']);
                    while ($detail = $details->fetch_assoc()): ?>
                    <p><?php echo $detail['name']; ?> (x<?php echo $detail['quantity']; ?>): $<?php echo number_format($detail['subtotal'], 2); ?></p>
                    <?php endwhile; ?>
                </div>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <script>
        function toggleDetails(id) {
            const details = document.getElementById(`details-${id}`);
            details.style.display = details.style.display === "none" ? "block" : "none";
        }
    </script>
</body>
</html>
