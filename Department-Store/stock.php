<?php include('check_user.php'); ?>
<!-- database -->
<?php require_once './config/config.php'; ?>
<!-- header part -->
<?php include("./pages/common_pages/header.php");?>

<!--navbar and sidebar part start-->
<?php include("./pages/common_pages/navber.php"); ?>
<?php include("./pages/common_pages/sidebar.php"); ?>

<!-- main part start -->
<main class="app-main">
                 <div class="container mt-5">
    <h2 class="text-center">Stock Inventory</h2>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">SL</th>
                <th scope="col">Product Name</th>
                <th scope="col">Price</th>
                <th scope="col">Available Stock</th>
            </tr>
        </thead>
        <tbody>
        <?php
                   
                   $category_list = $db->query("SELECT * FROM products");
                   if ($category_list->num_rows > 0) {
                       $counter = 1;
                       while (list($id, $name,$stock,$price) = $category_list->fetch_row()) {
                        
                           echo "
                           <tr class='category-row'>
                               <td>$counter</td>
                               <td>$name</td>
                               <td>$stock</td>
                               <td>$price</td>

                           </tr>";
                           $counter++;
                       }
                   } else {
                       echo "
                       <tr>
                           <td colspan='4' class='text-center text-muted'>
                               <i class='bi bi-info-circle me-2'></i> No categories available at the moment.
                           </td>
                       </tr>";
                   }
                   ?>
            
        </tbody>
    </table>
</div>
</main>
<!-- main part end -->

<!-- footer part start -->
<?php include("./pages/common_pages/footer.php");?>
