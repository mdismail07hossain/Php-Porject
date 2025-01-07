                    <?php include('check_user.php'); ?>
                    <!-- database -->

                    <!-- header part -->
                    <?php include("./pages/common_pages/header.php");?>

                    <!--navbar and sidebar part start-->
                    <?php include("./pages/common_pages/navber.php"); ?>
                    <?php include("./pages/common_pages/sidebar.php"); ?>
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "phamanest_db");

                    if (isset($_POST['edit_product'])) {
                        $id = $_POST['id'];
                        $name = $_POST['name'];
                        $price = $_POST['price'];
                        $stock = $_POST['stock'];
                        $conn->query("UPDATE products SET name='$name', price=$price, stock=$stock WHERE id=$id");
                    }

                    if (isset($_GET['delete'])) {
                        $id = $_GET['delete'];
                        $conn->query("DELETE FROM products WHERE id=$id");
                    }

                    $products = $conn->query("SELECT * FROM products");
                    ?>
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Product Management</title>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                margin: 20px;
                                background-color: #f4f4f9;
                                color: #333;
                            }

                            h2, h3 {
                                text-align: center;
                                color:rgb(53, 6, 140);
                            }

                            form {
                                max-width: 600px;
                                margin: 20px auto;
                                padding: 20px;
                                background-color: #fff;
                                border: 1px solid #ddd;
                                border-radius: 8px;
                                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                            }

                            form input, form button {
                                width: 100%;
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
                                background-color:rgb(28, 18, 225);
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
                        <h3>Products</h3>
                        <table>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                            <?php while ($product = $products->fetch_assoc()): ?>
                            <tr>
                                <form method="POST">
                                    <td><input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>"></td>
                                    <td><input type="number" name="price" step="0.01" value="<?php echo htmlspecialchars($product['price']); ?>"></td>
                                    <td><input type="number" name="stock" value="<?php echo htmlspecialchars($product['stock']); ?>"></td>
                                    <td class="actions">
                                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                        <button type="submit" name="edit_product">Edit</button>
                                    
                                        <a href="product_management.php?delete=<?php echo $product['id']; ?>">Delete</a>
                                    </td>
                                </form>
                            </tr>
                            <?php endwhile; ?>
                        </table>
                            </main>


                    <?php include("./pages/common_pages/footer.php");?>