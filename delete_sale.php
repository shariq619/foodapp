<?php
// Your database connection logic
include('db_connection.php');

// Check if sale ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect to the sales page if sale ID is not provided
    header("Location: sales.php");
    exit();
}

$sale_id = mysqli_real_escape_string($conn, $_GET['id']);

// Retrieve sale information from the database
$sql = "SELECT * FROM sales WHERE id = $sale_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $sale = $result->fetch_assoc();
} else {
    // Redirect to the sales page if the sale is not found
    header("Location: sales.php");
    exit();
}

// Check if the user confirmed the deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_delete'])) {
    // Delete the sale from the 'sales' table
    $delete_sql = "DELETE FROM sales WHERE id = $sale_id";

    if ($conn->query($delete_sql) === TRUE) {
        // Redirect to the sales page after successful deletion
        header("Location: sales.php");
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
    <title>Delete Sale</title>
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
                        <h3 class="box-title">Delete Sale</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <p>Are you sure you want to delete this sale?</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?id=' . $sale_id); ?>" method="post">
                            <input type="submit" name="confirm_delete" class="btn btn-danger" value="Yes, Delete">
                            <a href="sales.php" class="btn btn-default">Cancel</a>
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
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.18/js/app.min.js"></script>
</body>
</html>
