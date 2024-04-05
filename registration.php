<?php
// Include the database connection code (modify as needed)
include("db_connection.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get user input from the registration form
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password for security
    $role = $_POST["role"];

    // Check if the username is already taken
    $check_username_query = "SELECT id FROM users WHERE username = ?";
    $stmt = $conn->prepare($check_username_query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Username already exists, redirect back to the registration page with an error message
        header("Location: register.php?error=username_taken");
        exit();
    }

    // Prepare and execute the SQL statement to insert the new user into the database
    $insert_user_query = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_user_query);
    $stmt->bind_param("sss", $username, $password, $role);
    $stmt->execute();

    // Redirect to the login page after successful registration
    header("Location: login.php?success=registration_successful");
    exit();
} else {
    // If the form is not submitted, redirect to the registration page
    header("Location: register.php");
    exit();
}

// Close the database connection
$conn->close();
?>
