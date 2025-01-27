<?php include("./pages/common_pages/header.php");?>

<!--navbar and sidebar part start-->
<?php include("./pages/common_pages/navber.php"); ?>
<?php include("./pages/common_pages/sidebar.php"); ?>
<?php
$conn = mysqli_connect("localhost", "root", "", "phamanest_db");

if (isset($_GET['invoiceId'])) {
    $invoiceId = $_GET['invoiceId'];

    // Prepare query to get the invoice details from the 'orders' table
    $getInvoice = "SELECT * FROM orders WHERE id = ?";
    $stmt = $conn->prepare($getInvoice);
    $stmt->bind_param("i", $invoiceId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $invoice = $result->fetch_assoc();
    } else {
        echo "Invoice not found.";
        exit;
    }
} else {
    echo "No invoice ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Details</title>
    <style>
        /* Grid layout for 2 columns */
        .invoice-detail{
            margin: 20px;
            padding: 40px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }
        .invoice-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            /* margin: 20px; */
            /* padding: 40px; */
            /* box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; */
        }
        .invoice_store{
            display: grid;
            grid-template-columns: repeat(3,1fr);
        }

        .invoice-details .invoice-item {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            /* box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); */
        }

        .invoice-details .invoice-item th {
            text-align: left;
            padding-bottom: 8px;
        }

        .invoice-details .invoice-item td {
            padding-bottom: 8px;
        }

        .invoice-details .invoice-item .title {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            /* box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); */
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background:transparent;
            color:rgb(75, 75, 75);
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        
    </style>
</head>
<main>
    

    <div class="invoice-detail">
    <div class="invoice_store">
    <div class="store">
        <h4>Billing from</h4>
        <p>Your Needs</p>
        <p>Adddress : Mirpur-12</p>
        <p>Email : yourneeds@gmail.com</p>
    </div>
        <div>
            <img class="img" src="<?php echo "./asstes/images/Your_Needs1.png"?>" alt="" width="200" >
        </div>
        <div class="store">
        <h4>Billing to</h4>
        <p>Customer : NOt founde</p>
        <p>Number : 013*****215</p>
        <p>Email : customer@gmail.com</p>
    </div>
    </div>
        <div class="invoice-details">
        <!-- Left Column: Invoice Details -->
        <div class="invoice-item">
            <table>
                <tr>
                    <th>Order ID</th>
                    <td><?php echo $invoice['id']; ?></td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td><?php echo $invoice['order_date']; ?></td>
                </tr>
                <tr>
                    <th>Total Amount</th>
                    <td>$<?php echo number_format($invoice['total_amount'], 2); ?></td>
                </tr>
            </table>
        </div>

        <!-- Right Column: Additional Details (Discount, Tax, Net Total) -->
        <div class="invoice-item">
            <table>
                <tr>
                    <th>Discount</th>
                    <td>$<?php echo number_format($invoice['discount'], 2); ?></td>
                </tr>
                <tr>
                    <th>Tax</th>
                    <td>$<?php echo number_format($invoice['tax'], 2); ?></td>
                </tr>
                <tr>
                    <th>Net Total</th>
                    <td>$<?php echo number_format($invoice['net_total'], 2); ?></td>
                </tr>
            </table>
        </div>
    </div>
    </div>

</main>
</html>

<?php include("./pages/common_pages/footer.php"); ?>
