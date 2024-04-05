<?php include('header.php'); ?>

<?php
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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate and sanitize user inputs (you might want to add more validation)
    $item_id = mysqli_real_escape_string($conn, $_POST['item_id']);
    $quantity_sold = mysqli_real_escape_string($conn, $_POST['quantity_sold']);

    // Update data in the 'sales' table
    $update_sql = "UPDATE sales SET item_id = '$item_id', quantity_sold = '$quantity_sold' WHERE id = $sale_id";

    if ($conn->query($update_sql) === TRUE) {
        // Redirect to the sales page after successful update
        header("Location: sales.php");
        exit();
    } else {
        echo "Error: " . $update_sql . "<br>" . $conn->error;
    }
}

// Fetch items from the inventory table to populate the dropdown
$sql_items = "SELECT id, item FROM inventory";
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
                        <h3 class="box-title">Edit Sale</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?id=' . $sale_id); ?>" method="post">
                            <div class="form-group">
                                <label for="item_id">Item:</label>
                                <select class="form-control" id="item_id" name="item_id" required>
                                    <?php foreach ($items as $id => $item): ?>
                                        <option value="<?php echo $id; ?>" <?php if ($id == $sale['item_id']) echo 'selected'; ?>><?php echo $item; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantity_sold">Quantity Sold:</label>
                                <input type="number" class="form-control" id="quantity_sold" name="quantity_sold" value="<?php echo $sale['quantity_sold']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Sale</button>
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
