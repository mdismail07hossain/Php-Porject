<?php include('check_user.php'); ?>
                        <!-- database -->

                        <!-- header part -->
                        <?php include("./pages/common_pages/header.php");?>

                        <!--navbar and sidebar part start-->
                        <?php include("./pages/common_pages/navber.php"); ?>
                        <?php include("./pages/common_pages/sidebar.php"); ?>
                        <?php
                        $conn = mysqli_connect("localhost", "root", "", "phamanest_db");
                    if(isset($_GET['inoviceId'])) {
                        $inoviceId = $_GET['inoviceId'];
                        var_dump($inoviceId);

                        $getInovice = "SELECT id FROM orders where id = $inoviceId";
                        $stmt = $db_conn->prepare($getInovice);
                        $stmt->bind_param("i", $inoviceId);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        var_dump($result);

                        if ($result->num_rows > 0) {
                            $invoices = $result->fetch_assoc();
                            var_dump($invoices);
                        } else {
                            echo "Invoice not found.";
                        }
                    }        

                       
                        ?>

                        <!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Document</title>
                        </head>
                        <body>
                            <!-- <h2><?php echo htmlspecialchars($invoices['name'])?></h2> -->
                        </body>
                        </html>

<?php include("./pages/common_pages/footer.php");?>