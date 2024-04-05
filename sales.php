<?php include('header.php'); ?>

<?php
// Check if user is authenticated and if the user is an admin or not
// if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] == "admin"){
    // $sql = "SELECT sales.*, inventory.item 
            // FROM sales 
            // INNER JOIN inventory ON sales.item_id = inventory.id";
// } else {
    
    // $user_id = $_SESSION['user_id'];
    // $sql = "SELECT sales.*, inventory.item 
            // FROM sales 
            // INNER JOIN inventory ON sales.item_id = inventory.id 
            // WHERE sales.user_id = $user_id";
// }

$sql = "SELECT sales.*, inventory.item 
            FROM sales 
            INNER JOIN inventory ON sales.item_id = inventory.id";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $sales = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $sales = [];
}

$conn->close();
?>

<style>
    .limited-content {
        max-width: 200px; /* Adjust the value as per your design */
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
                        <h3 class="box-title">Sales</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="add_sale.php" class="btn btn-success">Add New Sale</a>
                            </div>
                        </div>
                        <br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Item ID</th>
                                <th>Quantity Sold</th>
                                <th>Transaction Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($sales as $sale): ?>
                                    <tr>
                                        <td><?php echo $sale['id']; ?></td>
                                        <td><?php echo $sale['item']; ?></td>
                                        <td class="limited-content"><?php echo $sale['quantity_sold']; ?></td>
                                        <td><?php echo $sale['transaction_date']; ?></td>
                                        <td>
                                            <!-- <a class="btn btn-primary" href="edit_sale.php?id=<?php //echo $sale['id']; ?>">Edit</a> -->
                                            <a class="btn btn-danger" href="delete_sale.php?id=<?php echo $sale['id']; ?>">Delete</a>
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
