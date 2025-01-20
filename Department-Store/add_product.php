                    <?php include('check_user.php'); ?>
                    <!-- database -->

                    <!-- header part -->
                    <?php include("./pages/common_pages/header.php");?>

                    <!--navbar and sidebar part start-->
                    <?php include("./pages/common_pages/navber.php"); ?>
                    <?php include("./pages/common_pages/sidebar.php"); ?>
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
                        }}}
                    ?>
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Product Management</title>
                        <style>
                            /* body {
                                font-family: Arial, sans-serif;
                                margin: 20px;
                                background-color: #f4f4f9;
                                color: #333;
                            } */

                            h2, h3 {
                                margin-top: 20px;
                                text-align: center;
                                font-weight: bold;
                                color:rgb(53, 6, 140);
                            }

                            form {
                                /* max-width: 900px; */
                                /* margin: 20px auto; */
                                padding: 20px;
                                /* background-color: #fff; */
                                border: 1px solid #ddd;
                                border-radius: 8px;
                                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                            }

                            form input, form button {
                                /* width: 100%; */
                                padding: 10px;
                                margin: 10px 0;
                                border: 1px solid #ccc;
                                border-radius: 4px;
                            }

                            form button {
                                background-color:rgb(25, 3, 107);
                                color: white;
                                border: none;
                                cursor: pointer;
                            }

                            form button:hover {
                                background-color:rgb(10, 76, 183);
                            }

                            table {
                                width: 100%;
                                border-collapse: collapse;
                                margin: 20px 0;
                                background-color: #fff;
                                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                            }

                            th, td {
                                padding: 12px;
                                text-align: left;
                                border: 1px solid #ddd;
                            }

                            th {
                                background-color:rgb(63, 66, 68);
                                color: white;
                            }

                            tr:nth-child(even) {
                                background-color: #f2f2f2;
                            }

                            table input {
                                width: 90%;
                                padding: 5px;
                                border: 1px solid #ccc;
                                border-radius: 4px;
                            }

                            table button {
                                padding: 5px 10px;
                                background-color:rgb(9, 13, 126);
                                color: white;
                                border: none;
                                cursor: pointer;
                                border-radius: 4px;
                            }

                            table button:hover {
                                background-color:rgb(55, 62, 246);
                            }

                            table a {
                                color: #FF5722;
                                text-decoration: none;
                            }

                            table a:hover {
                                text-decoration: underline;
                            }

                            .actions {
                                display: flex;
                                gap: 10px;
                            }
                        </style>
                    </head>
                    <body>
                    <main>
                        <h2>Product Management</h2>
                        <form method="POST">
                            <table id="medicineSellTable">
                                <tr>
                                    <th>Product Name </th>
                                    <th>Product Price </th>
                                    <th>Product Stock </th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="name[]" placeholder="product name" id="name" >
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
                            </table>
                            <button type="submit" name="add_product">Add Product</button>
                            <div class="">
                                <button type="button" class="btn  fw-bold " onclick="addMedicineRow()">
                                 <i class="bi bi-plus-square fw-bold"></i> 
                                </button>
                        </div>
                        </form>
                       
                            </main>

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
                input2.name = 'price[]';
                input2.placeholder = 'Enter product price';
                cell2.appendChild(input2);

                // Product stock
                const cell3 = newRow.insertCell(2);
                const input3 = document.createElement('input');
                input3.type = 'number';
                input3.className = 'form-control price';
                input3.name = 'stock[]';
                input3.placeholder = 'Product stock';
                cell3.appendChild(input3);
                // Remove Button
                const cell5 = newRow.insertCell(3);
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

                    <?php include("./pages/common_pages/footer.php");?>