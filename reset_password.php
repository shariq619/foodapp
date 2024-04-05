<?php
// Include the database connection code (modify as needed)
include("db_connection.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the reset password form
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Perform basic validation
    if ($password != $confirm_password) {
        // Passwords do not match, redirect back to the reset password page with an error message
        header("Location: forgot_password.php?error=password_mismatch");
        exit();
    }

    // Check if the username exists in the database
    $check_username_query = "SELECT * FROM users WHERE username = ?";
    $stmt_check = $conn->prepare($check_username_query);
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows == 0) {
        // Username does not exist, redirect back to the reset password page with an error message
        header("Location: forgot_password.php?error=username_not_found");
        exit();
    }

    // Hash the new password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Update the user's password in the database
    $update_password_query = "UPDATE users SET password = ? WHERE username = ?";
    $stmt = $conn->prepare($update_password_query);
    $stmt->bind_param("ss", $hashed_password, $username);
    $stmt->execute();

    // Redirect to the login page after successful password reset
    header("Location: login.php?success=password_reset_successful");
    exit();
} else {
    // If the form is not submitted, redirect to the reset password page
    header("Location: forgot_password.php");
    exit();
}

// Close the database connection
$conn->close();
?>
