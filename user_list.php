<?php include('header.php'); ?>

<?php
// Your database connection logic
include('db_connection.php');

// Retrieve users from the database (replace with your actual database query)
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Check if there are users
if ($result->num_rows > 0) {
    $users = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $users = [];
}

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
                        <h3 class="box-title">Users</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
<!--                        <div class="row">-->
<!--                            <div class="col-md-12">-->
<!--                                <a href="add_user.php" class="btn btn-success">Add New User</a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <br>-->
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Role</th>
<!--                                <th>Action</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?php echo $user['id']; ?></td>
                                    <td><?php echo $user['username']; ?></td>
                                    <td><?php echo $user['role']; ?></td>
<!--                                    <td>-->
<!--                                        <a href="edit_user.php?id=--><?php //echo $user['id']; ?><!--" class="btn btn-primary">Edit</a>-->
<!--                                        <a href="delete_user.php?id=--><?php //echo $user['id']; ?><!--" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>-->
<!--                                    </td>-->
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

<div class="control-sidebar-bg"></div>
</div>

<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 2.2.3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></
