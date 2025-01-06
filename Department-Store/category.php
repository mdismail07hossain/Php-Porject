<?php include('check_user.php'); ?>
<!-- database -->
<?php require_once './config/config.php'; ?>
<!-- header part -->
<?php include("./pages/common_pages/header.php");?>

<!--navbar and sidebar part start-->
<?php include("./pages/common_pages/navber.php"); ?>
<?php include("./pages/common_pages/sidebar.php"); ?>

<?php 
$message_delete = isset($_GET['message_delete']) ? $_GET['message_delete'] : null;
$type = isset($_GET['type']) ? $_GET['type'] : null;
?>

<!-- main part start -->
<main class="app-main">
    <!-- Add Category Section -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Display success or error messages -->
                <?php
                if (isset($_SESSION['success'])) {
                    echo "<p id='message' class='alert alert-success text-center animated fadeIn'>" . htmlspecialchars($_SESSION['success']) . "</p>";
                    unset($_SESSION['success']);
                }
                
                if (isset($_SESSION['error'])) {
                    echo "<p id='message' class='alert alert-danger text-center animated fadeIn'>" . htmlspecialchars($_SESSION['error']) . "</p>";
                    unset($_SESSION['error']);
                }
                ?>

                <div class="card shadow-lg hover-shadow-xl">
                    <div class="card-header bg-gradient-primary text-white">
                        <h4>Add Category</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" id="submitBrandForm" action="./php_action/create_categories.php" enctype="multipart/form-data">
                            <!-- Category Name -->
                            <div class="mb-4 row">
                                <label class="col-sm-3 col-form-label" for="categoriesName">Category Name</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        name="category" 
                                        placeholder="Category Name" 
                                        required 
                                        pattern="^[a-zA-Z\s]+$" 
                                        title="Only alphabets are allowed.">
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="mb-4 row">
                                <label class="col-sm-3 col-form-label" for="categoriesStatus">Status</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="categoriesStatus" name="categoriesStatus" required>
                                        <option value="">-SELECT-</option>
                                        <option value="1">Available</option>
                                        <option value="2">Not Available</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-sm-12 text-end">
                                    <button type="submit" name="create" id="createCategoriesBtn" class="btn btn-gradient-success px-4 py-2">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Show message for 3 seconds using JavaScript -->
    <script>
        setTimeout(() => {
            const messageElement = document.getElementById('message');
            if (messageElement) {
                messageElement.style.display = 'none';
            }
        }, 3000);
    </script>

    <!-- Category List Section -->
    <section class="container my-5">
        <h2 class="mb-4 text-center">Category List</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $activeCategory = '';
                    $category_list = $db->query("SELECT * FROM category");
                    if ($category_list->num_rows > 0) {
                        $counter = 1;
                        while (list($id, $category, $status) = $category_list->fetch_row()) {
                            $activeCategory = $status == 1 ? "<span class='badge bg-success'>Active</span>" : "<span class='badge bg-warning text-dark'>Inactive</span>";
                            echo "
                            <tr class='category-row'>
                                <td>$counter</td>
                                <td>$category</td>
                                <td>$activeCategory</td>
                                <td>
                                    <a href='./edit_category.php?id=$id' class='btn btn-outline-primary btn-sm' data-bs-toggle='tooltip' title='Edit'>
                                        <i class='bi bi-pencil-square'></i> Edit
                                    </a>
                                    <a href='./php_action/category_delete.php?id=$id' class='btn btn-outline-danger btn-sm' data-bs-toggle='tooltip' title='Delete'>
                                        <i class='bi bi-trash'></i> Delete
                                    </a>
                                </td>
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
    </section>
    <style>
/* Gradient Button */
.btn-gradient-success {
    background: linear-gradient(90deg, rgba(56, 126, 255, 1) 0%, rgba(102, 192, 255, 1) 100%);
    color: white;
    border: none;
    transition: all 0.3s ease;
}
.btn-gradient-success:hover {
    background: linear-gradient(90deg, rgba(102, 192, 255, 1) 0%, rgba(56, 126, 255, 1) 100%);
}

/* Hover effect for table rows */
.category-row:hover {
    background: linear-gradient(45deg, rgba(230, 245, 255, 0.5), rgba(255, 255, 255, 0.8));
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    cursor: pointer;
}

/* Card Hover Effect */
.card:hover {
    /* transform: translateY(-5px); */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}

</style>
    <!-- Modal for Success or Error Message -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">
                        <?php echo ($type === 'success') ? 'Success' : 'Error'; ?>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo htmlspecialchars($message_delete); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Check if a message is set and display the modal
        <?php if ($message_delete): ?>
        var messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
        messageModal.show();
        <?php endif; ?>
    </script>
</main>
<!-- main part end -->

<!-- footer part start -->
<?php include("./pages/common_pages/footer.php");?>
