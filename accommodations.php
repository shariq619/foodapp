<?php
include('header.php');

$sql = "SELECT * FROM accommodations";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $accommodations = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $accommodations = [];
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
                        <h3 class="box-title">Inventory</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="add_accommodations.php" class="btn btn-success">Add New Inventory</a>
                            </div>
                        </div>
                        <br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>name</th>
                                    <th>image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($accommodations as $accommodation) : ?>
                                    <tr>
                                        <td><?php echo $accommodation['id']; ?></td>
                                        <td><?php echo $accommodation['name']; ?></td>
                                        <td>
                                            <?php if ($accommodation['image']) : ?>
                                                <img src="upload/<?php echo $accommodation['image']; ?>" alt="<?php echo $accommodation['name']; ?>" style="max-width: 100px;">
                                            <?php else : ?>
                                                <p>Image Not Found</p>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="edit_accommodations.php?id=<?php echo $accommodation['id']; ?>">Edit</a>
                                            <a class="btn btn-danger" href="delete_accommodations.php?id=<?php echo $accommodation['id']; ?>">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include('footer.php'); ?>