<?php
//session_start();
include('db_connection.php');

// Check if post ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect to the accommodations page if post ID is not provided
    header("Location: accommodations.php");
    exit();
}

$accommodations_id = mysqli_real_escape_string($conn, $_GET['id']);

// Retrieve post information from the database
$sql = "SELECT * FROM accommodations WHERE id = $accommodations_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $accommodations = $result->fetch_assoc();
} else {
    // Redirect to the accommodations page if the post is not found
    header("Location: accommodations.php");
    exit();
}

// Check if the user confirmed the deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_delete'])) {
    // Delete the accommodations from the 'accommodations' table
    $delete_sql = "DELETE FROM accommodations WHERE id = $accommodations_id";
    $imageFilename = $accommodations['image'];

    if ($conn->query($delete_sql) === TRUE) {
        // Redirect to the accommodations page after successful deletion
        $uploadDir = 'upload/';
        $imagePath = $uploadDir  . $imageFilename;
        if (file_exists($imagePath)) {
                unlink($imagePath);
        }
        header("Location: accommodations.php");
        exit();
    } else {
        echo "Error: " . $delete_sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

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
                        <h3 class="box-title">Delete accommodations</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <p>Are you sure you want to delete the post with the title: "<strong><?php echo $accommodations['name']; ?></strong>"?</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?id=' . $accommodations_id); ?>" method="post">
                            <input type="submit" name="confirm_delete" class="btn btn-danger" value="Yes, Delete">
                            <a href="accommodations.php" class="btn btn-default">Cancel</a>
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
