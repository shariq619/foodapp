<?php
//session_start();
include('db_connection.php');

// Check if post ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect to the inventory page if post ID is not provided
    header("Location: inventory.php");
    exit();
}

$inventory_id = mysqli_real_escape_string($conn, $_GET['id']);

// Retrieve post information from the database
$sql = "SELECT * FROM inventory WHERE id = $inventory_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $inventory = $result->fetch_assoc();
} else {
    // Redirect to the inventory page if the post is not found
    header("Location: inventory.php");
    exit();
}

// Check if the user confirmed the deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_delete'])) {
    // Delete the inventory from the 'inventory' table
    $delete_sql = "DELETE FROM inventory WHERE id = $inventory_id";
    $imageFilename = $inventory['item_img'];

    if ($conn->query($delete_sql) === TRUE) {
        // Redirect to the inventory page after successful deletion
        $uploadDir = 'upload/';
        $imagePath = $uploadDir  . $imageFilename;
        if (file_exists($imagePath)) {
                unlink($imagePath);
        }
        header("Location: inventory.php");
        exit();
    } else {
        echo "Error: " . $delete_sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Post</title>
</head>
<body>

<?php include('header.php'); ?>

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
                        <h3 class="box-title">Delete Inventory</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <p>Are you sure you want to delete the post with the title: "<strong><?php echo $inventory['item']; ?></strong>"?</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?id=' . $inventory_id); ?>" method="post">
                            <input type="submit" name="confirm_delete" class="btn btn-danger" value="Yes, Delete">
                            <a href="inventory.php" class="btn btn-default">Cancel</a>
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

<div class="control-sidebar-bg"></div>
</div>

<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 2.2.3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/js/app.min.js"></script>
</body>
</html>
