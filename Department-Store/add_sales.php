 
<?php include('check_user.php'); ?>
<!-- database  -->
 <?php require_once './config/config.php';?>
<!-- header part  -->
 <?php  include("./pages/common_pages/header.php");?>



        <!--navber and sideber part start-->
 <?php include("./pages/common_pages/navber.php");?>
 <?php include("./pages/common_pages/sidebar.php");?>
<?php 
$message_delete = isset($_GET['message_delete']) ? $_GET['message_delete'] : null;
$type = isset($_GET['type']) ? $_GET['type'] : null;


?>
<?php
                    
                    $conn = mysqli_connect("localhost", "root", "", "phamanest_db");
                    if (isset($_POST['add_product'])) {
                        $names = $_POST['name'];
                        $prices = $_POST['price'];
                        $stocks = $_POST['stock'];
                        // $conn->query("INSERT INTO products (name, price, stock) VALUES ('$name', $price, $stock)");
                    
                        if (!empty($names)) {
                            foreach ($names as $index => $name) {
                                $price = $prices[$index];
                                $stock = $stocks[$index];
                                $conn->query("INSERT INTO products (name, price, stock) VALUES ('$name', $price, $stock)");

                                $_SESSION['success'] = "Purchase successfully.";
                            }
                        } else {
                            $_SESSION['error'] = "Not found the Product.";
                        }
                        //  header('location:add_product.php');
                         $conn->close();
                    }
                    ?>
  <style>
     h2 {
            text-align: center;
            color: rgb(9, 20, 141);
        }      
                   
  </style>

<main  class="app-main m-5">

<div class="container mt-5">
        <div class="d-flex justify-content-between">
        <h1 >Purchase Product</h1>
            <div>
            <a href="purchase_history.php" class="btn btn-success d-block my-2" role="button">
        View Sell List
        </a>
            </div>

        </div>
        <?php
        if (isset($_SESSION['success'])) {
            echo "<p id='message' style='color: green;font-size: 30px;background-color: lightgreen; text-align: center; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px;'>" . htmlspecialchars($_SESSION['success']) . "</p>";
            unset($_SESSION['success']); // Clear the message after displaying it
        }
        
        if (isset($_SESSION['error'])) {
            echo "<p id='message' style='color: red;font-size: 30px;background-color: lightred; text-align: center; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px;'>" . htmlspecialchars($_SESSION['error']) . "</p>";
            unset($_SESSION['error']); // Clear the message after displaying it
        }
        ?>

    <form id="sellMedicineForm">
    <div class="row mb-4">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="customerName" class="form-label">Customer Name:</label>
                    <input type="text" class="form-control" id="customerName" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="invoice" class="form-label">Invoice Number:</label>
                    <input type="text" class="form-control" id="randomNumber" readonly>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">

            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="purchaseDate" class="form-label">sell Date:</label>
                    <input type="date" class="form-control" id="purchaseDate" required value="<?php echo date('Y-m-d'); ?>">
                </div>
            </div>
        </div>
        <!-- Medicine Table -->

        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle" id="medicineSellTable">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col">Purchase Price</th>
                        <th scope="col">Sell Price </th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                                    <td>
                                        <input type="text" name="name[]" placeholder="product name" id="name" >
                                    </td>
                                    <td>
                                    <input type="number" name="price2[]" placeholder="product price" id="price" >
                                    </td>
                                    <td>
                                    <input type="number" name="price[]" placeholder="product price" id="price" >
                                    </td>
                                    <td>
                                    <input type="number" name="stock[]" placeholder="product stock" id="stock" >
                                    </td>
                                    <td>
                                     <button type="button" class="btn btn-danger btn-sm" onclick="removeMedicineRow(this)">
                                     <i class="bi bi-trash"></i>
                                    </button>
                                     </td>
                                </tr>
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-primary mb-3" onclick="addMedicineRow()">
            <i class="bi bi-plus-square"></i> Add Product
        </button>

        <!-- Payment Section -->
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="subAmount" class="form-label">Sub Total:</label>
                    <input type="number" class="form-control" id="subAmount" readonly>
                </div>
                <div class="mb-3">
                    <label for="discount" class="form-label">Discount:</label>
                    <input type="number" class="form-control" id="discount" placeholder="Enter discount" min="0" oninput="calculateTotal()">
                </div>
                <div class="mb-3">
                    <label for="payableAmount" class="form-label">Payable Amount:</label>
                    <input type="number" class="form-control" id="payableAmount" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="receivedAmount" class="form-label">Received Amount:</label>
                    <input type="number" class="form-control" id="receivedAmount" placeholder="Enter received amount" min="0" oninput="calculateDueAmount()">
                </div>
                <div class="mb-3">
                    <label for="dueAmount" class="form-label">Due Amount:</label>
                    <input type="number" class="form-control" id="dueAmount" readonly>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success" name="add_product">Submit</button>
        </div>
    </form>
</div>
<script>
        // Function to generate a random 6-digit integer
        function generateRandomSixDigitNumber() {
            return Math.floor(Math.random() * 900000) + 100000; // Range: 100000 to 999999
        }

        // Generate a random number when the page loads
        window.onload = function() {
            const randomNumber = generateRandomSixDigitNumber();
            document.getElementById('randomNumber').value = randomNumber;
        };

    </script>

<script>
            // Function to add a new row
            function addMedicineRow() {
                const table = document.getElementById('medicineSellTable').getElementsByTagName('tbody')[0];
                const newRow = table.insertRow();

                // Product Name
                const cell1 = newRow.insertCell(0);
                const input1 = document.createElement('input');
                input1.type = 'text';
                input1.className = 'form-control';
                input1.name = "name[]";
                input1.placeholder = 'Product Name';
                cell1.appendChild(input1);

                //Product price
                const cell2 = newRow.insertCell(1);
                const input2 = document.createElement('input');
                input2.type = 'number';
                input2.className = 'form-control quantity';
                input2.name = 'price2[]';
                input2.placeholder = 'Enter product price';
                cell2.appendChild(input2);
                //Product price
                const cell3 = newRow.insertCell(2);
                const input3 = document.createElement('input');
                input2.type = 'number';
                input2.className = 'form-control quantity';
                input2.name = 'price[]';
                input2.placeholder = 'Enter product price';
                cell2.appendChild(input2);

                // Product stock
                const cell4 = newRow.insertCell(3);
                const input4 = document.createElement('input');
                input3.type = 'number';
                input3.className = 'form-control price';
                input3.name = 'stock[]';
                input3.placeholder = 'Product stock';
                cell3.appendChild(input3);
                // Remove Button
                const cell5 = newRow.insertCell(4);
                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'btn btn-danger btn-sm';
                button.innerHTML = '<i class="bi bi-trash"></i>';
                button.onclick = function () {
                    removeMedicineRow(button);
                };
                cell5.appendChild(button);
            }

            // Function to remove a row
            function removeMedicineRow(button) {
                const row = button.closest('tr');
                row.remove();
                calculateSubTotal();
            }
        </script>
        <script>
    // Hide the message after 3 seconds
    setTimeout(() => {
        const messageElement = document.getElementById('success');
        if (messageElement) {
            messageElement.style.display = 'none';
        }
    }, 1000);
</script>


</main>
     <!-- main part end -->


        <!-- footer part start  -->
<?php include("./pages/common_pages/footer.php");?>



    
   
                