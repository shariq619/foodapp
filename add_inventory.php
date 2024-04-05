<?php
// Start output buffering
ob_start();

// Start a session at the beginning of the script
//session_start();

// Include the header file after session start and any other PHP code
include('header.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user inputs (you might want to add more validation)
    $item = mysqli_real_escape_string($conn, $_POST['item']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $desc = mysqli_real_escape_string($conn, $_POST['desc']);

    $targetDir = 'upload/';
    $fileName = basename($_FILES['item_img']['name']);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
	move_uploaded_file($_FILES['item_img']['tmp_name'], $targetFilePath);

	
   
            // Check if the user is logged in
            if (isset($_SESSION["user_id"])) {
                $user_id = $_SESSION["user_id"];
				
				

                // Insert data into the 'inventory' table with the associated user_id
                $sql = "INSERT INTO inventory (item, quantity, `desc`, user_id, item_img) VALUES ('$item', '$quantity', '$desc', '$user_id', '$fileName')";

			
				
                if ($conn->query($sql) === TRUE) {
                    // Redirect to the inventory page after successful insertion
                    header("Location: inventory.php");
                    exit();
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                // Handle the case where the user is not logged in
                echo "User not logged in.";
            }
       
}

// Close the database connection after processing the form
$conn->close();

// Flush the output buffer
ob_end_flush();
?>




<aside class="main-sidebar">
    <section class="sidebar">
        <?php include('sidebar.php'); ?>
    </section>
</aside>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Add New Inventory</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="item">Item:</label>
                                <input type="text" class="form-control" id="item" name="item" required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity:</label>
                                <input type="number" class="form-control" id="quantity" name="quantity"  required>
                            </div>
                            <div class="form-group">
                                <label for="desc">Description:</label>
                                <textarea class="form-control" name="desc" placeholder="Description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="desc">Image:</label>
                                <input type="file" name="item_img" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Insert Inventory</button>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
    </section>
</div>

<?php include('footer.php'); ?>