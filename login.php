<?php
session_start(); // Start the session
include 'db_connection.php'; // Include the database connection script

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch the user from the database
    $stmt = $conn->prepare("SELECT id, password, name, role FROM users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Set session variables
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['user_id'] = $row['id']; // Store user ID for further database interactions

            header('Location: dashboard.php');
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "No user found with that username.";
    }

    $stmt->close();
}

$conn->close();
?>

