<?php include('header.php'); ?>

<?php

// if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] == "admin") {
    // $sql = "SELECT * FROM inventory";
// } else {
    // $sql = "SELECT * FROM inventory where user_id = " . $_SESSION['user_id'];
// }

$sql = "SELECT * FROM inventory";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $inventories = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $inventories = [];
}

$conn->close();
?>
<style>
    .limited-content {
        max-width: 200px;
        /* Adjust the value as per your design */
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
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
                        <h3 class="box-title">Inventory</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="add_inventory.php" class="btn btn-success">Add New Inventory</a>
                            </div>
                        </div>
                        <br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Description</th>
                                    <th>image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($inventories as $inventory) : ?>
                                    <tr>
                                        <td><?php echo $inventory['id']; ?></td>
                                        <td><?php echo $inventory['item']; ?></td>
                                        <td class="limited-content"><?php echo $inventory['quantity']; ?></td>
                                        <td><?php echo $inventory['desc']; ?></td>
                                        <td>
                                            <?php if ($inventory['item_img']) : ?>
                                                <img src="upload/<?php echo $inventory['item_img']; ?>" alt="<?php echo $inventory['item']; ?>" style="max-width: 100px;">
                                            <?php else : ?>
                                                <p>Image Not Found</p>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="edit_inventory.php?id=<?php echo $inventory['id']; ?>">Edit</a>
                                            <a class="btn btn-danger" href="delete_inventory.php?id=<?php echo $inventory['id']; ?>">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

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