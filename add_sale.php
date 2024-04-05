<?php include('header.php'); ?>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user inputs (you might want to add more validation)
    $item_id = mysqli_real_escape_string($conn, $_POST['item_id']);
    $quantity_sold = mysqli_real_escape_string($conn, $_POST['quantity_sold']);

    // Check if the user is logged in
    if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];

        // Insert data into the 'sales' table with the associated user_id
        $sql = "INSERT INTO sales (item_id, quantity_sold, user_id, transaction_date) VALUES ('$item_id', '$quantity_sold', '$user_id', NOW())";

        if ($conn->query($sql) === TRUE) {



            // Deduct the quantity sold from the inventory
            $update_inventory_sql = "UPDATE inventory SET quantity = quantity - $quantity_sold WHERE id = $item_id";
            if ($conn->query($update_inventory_sql) === FALSE) {
                echo "Error updating inventory: " . $conn->error;
            }


            // Redirect to the sales page after successful insertion
            header("Location: sales.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Handle the case where the user is not logged in
        echo "User not logged in.";
    }
}

// Fetch items from the inventory table to populate the dropdown
$sql_items = "SELECT id, item FROM inventory where quantity > 0";
$result_items = $conn->query($sql_items);
$items = [];
if ($result_items->num_rows > 0) {
    while ($row = $result_items->fetch_assoc()) {
        $items[$row['id']] = $row['item'];
    }
} else {
    echo "No items available.";
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
                        <h3 class="box-title">Add New Sale</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label for="item_id">Item:</label>
                                <select class="form-control" id="item_id" name="item_id" required>
                                    <option value="">Select Item</option>
                                    <?php foreach ($items as $id => $item): ?>
                                        <option value="<?php echo $id; ?>"><?php echo $item; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantity_sold">Quantity Sold:</label>
                                <input type="number" class="form-control" id="quantity_sold" name="quantity_sold" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Insert Sale</button>
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
