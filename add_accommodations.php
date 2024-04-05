<?php 
    include('header.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = mysqli_real_escape_string($conn, $_POST['acco_name']);

        $targetDir = 'upload/';
        $fileName = basename($_FILES['image']['name']);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    
        $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
        move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath);

        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];

            $sql = "INSERT INTO accommodations (name, image, user_id) VALUE ('$name','$fileName', $user_id)";
            
            if ($conn->query($sql) === true) {
                header("Location: accommodations.php");
                exit();
            }else{
                echo "User not logged in.";
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
$conn->close();
?>

<aside class="main-sidebar">
    <section class="sidebar">
        <?php include('sidebar.php'); ?>
    </section>
</aside>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Add New Accommodations</h3>
                    </div>
                    <div class="box-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="item">Name:</label>
                                <input type="text" class="form-control" name="acco_name" required>
                            </div>
                            <div class="form-group">
                                <label for="desc">Image:</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Insert Accommodations</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include('footer.php'); ?>