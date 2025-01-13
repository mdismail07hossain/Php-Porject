<?php include('check_user.php'); ?>
      <!-- header part start  -->
      <?php 
       include("./pages/common_pages/header.php");
       
       ?>

       <?php include("./pages/common_pages/navber.php");?>
      <!-- header part end -->



        <!--Sidebar part start-->
        <?php 
       include("./pages/common_pages/sidebar.php");
       ?>
        <!--Sidebar part end-->
        <?php
// Database connection
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "phamanest_db"; // Replace with your database name

// Create connection
$conn =mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["subbtn"])) {
    // Get the data from the form
    $supplier_name = $_POST['supplierName'];
    $company = $_POST['company'];
    $mobile_number = $_POST['mobileNumber'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];

    // Insert data into the database
    $conn->query( "INSERT INTO suppliers (supplier_name, company, mobile_number, email, address, city, state)
            VALUES ('$supplier_name', '$company', '$mobile_number', '$email', '$address', '$city', '$state')");

   
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Supplier</title>
    <link rel="stylesheet" href="path/to/your/css/bootstrap.min.css"> <!-- Make sure to include bootstrap -->
</head>
<body>
    <!-- Sidebar and Header (Same as in your existing code) -->

    <main class="app-main">
        <div class="container p-5">
            <h3>Add Supplier</h3>
            <form method="POST" action="">
                <div class="row">
                    <!-- Supplier Name -->
                    <div class="col-md-6 mb-3">
                        <label for="supplierName" class="form-label">Supplier Name</label>
                        <input type="text" class="form-control" id="supplierName" name="supplierName" required>
                    </div>

                    <!-- Company -->
                    <div class="col-md-6 mb-3">
                        <label for="company" class="form-label">Company</label>
                        <input type="text" class="form-control" id="company" name="company" required>
                    </div>
                </div>

                <div class="row">
                    <!-- Mobile Number -->
                    <div class="col-md-6 mb-3">
                        <label for="mobileNumber" class="form-label">Mobile Number</label>
                        <input type="tel" class="form-control" id="mobileNumber" name="mobileNumber" required>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>

                <div class="row">
                    <!-- Supplier Address -->
                    <div class="col-md-12 mb-3">
                        <label for="address" class="form-label">Supplier Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                    </div>
                </div>

                <div class="row">
                    <!-- City -->
                    <div class="col-md-6 mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>

                    <!-- State -->
                    <div class="col-md-6 mb-3">
                        <label for="state" class="form-label">State</label>
                        <input type="text" class="form-control" id="state" name="state" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" name="subbtn" class="btn btn-info text-white">Submit</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>

        <!-- footer part start  -->
       <?php 
       include("./pages/common_pages/footer.php");
       ?>
       <!-- footer part end  -->



