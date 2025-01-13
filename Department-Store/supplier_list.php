 
<?php include('check_user.php'); ?>
<!-- database  -->
 <?php require_once './config/config.php';?>
<!-- header part  -->
 <?php  include("./pages/common_pages/header.php");?>



        <!--navber and sideber part start-->
 <?php include("./pages/common_pages/navber.php");?>
 <?php include("./pages/common_pages/sidebar.php");?>

<?php
// Database connection
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "phamanest_db"; // Replace with your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM suppliers";
$result = $conn->query($sql);
?>


    <!-- Sidebar and Header (Same as in your existing code) -->
   

    <main class="app-main">
        <div class="container p-5">
            <h3>Supplier List</h3>
            <table class="table table-striped ">
                <thead>
                    <tr class="bg-primary">
                        <th>#</th>
                        <th>Supplier Name</th>
                        <th>Company</th>
                        <th>Mobile Number</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row["id"] . "</td>
                                    <td>" . $row["supplier_name"] . "</td>
                                    <td>" . $row["company"] . "</td>
                                    <td>" . $row["mobile_number"] . "</td>
                                    <td>" . $row["email"] . "</td>
                                    <td>" . $row["address"] . "</td>
                                    <td>" . $row["city"] . "</td>
                                    <td>" . $row["state"] . "</td>
                                    <td>
                                        <a href='edit_supplier.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm'>Edit</a>
                                        <a href='delete_supplier.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete?\")'>Delete</a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No suppliers found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>




<?php
$conn->close();
?>

     <!-- main part end -->


        <!-- footer part start  -->
<?php include("./pages/common_pages/footer.php");?>



    
   
                