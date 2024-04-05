<?php 
ob_start();
include('header.php'); 
session_start();

// Check if accommodations ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect to the accommodations page if accommodations ID is not provided
    header("Location: accommodations.php");
    exit();
}

$post_id = mysqli_real_escape_string($conn, $_GET['id']);

// Retrieve post information from the database
$sql = "SELECT * FROM accommodations WHERE id = $post_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $post = $result->fetch_assoc();
} else {
    // Redirect to the accommodations page if the post is not found
    header("Location: accommodations.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user inputs (you might want to add more validation)
    $item = mysqli_real_escape_string($conn, $_POST['acc_name']);

    // Check if a new image file is uploaded
    if ($_FILES["image"]["name"]) {
        // File upload handling
        $targetDir = "upload/";
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Check if file is a valid image
        $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                // Update data in the 'accommodations' table
                if (!empty($post['image'])) {
                    $prevFilePath = $targetDir . $post['image'];
                    if (file_exists($prevFilePath)) {
                        unlink($prevFilePath);
                    }
                }

                $update_sql = "UPDATE accommodations SET name = '$item', image = '$fileName' WHERE id = $post_id";

                if ($conn->query($update_sql) === TRUE) {
                    // Redirect to the accommodations page after successful update
                    header("Location: accommodations.php");
                    exit();
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Invalid file format.";
        }
    } else {
        // Update data in the 'accommodations' table without changing the image
        $update_sql = "UPDATE accommodations SET name = '$item' WHERE id = $post_id";

        if ($conn->query($update_sql) === TRUE) {
            // Redirect to the accommodations page after successful update
            header("Location: accommodations.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}


// Close the database connection
$conn->close();
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
                        <h3 class="box-title">Edit accommodations</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?id=' . $post_id); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="item">Name:</label>
                                <input type="text" class="form-control" id="item" name="acc_name" value="<?php echo $post['name']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="desc">Image:</label>
                                <input type="text" class="form-control" id="prev_image" name="prev_image" value="<?php echo $post['image']; ?>" readonly>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">Update accommodations</button>
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