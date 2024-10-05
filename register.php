<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $name = $_POST['name']; // Ensure there is a field to collect the name in the form
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Insert user into the users table
    $stmt = $conn->prepare("INSERT INTO users (username, password, name, email, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssss', $username, $password, $name, $email, $role);

    if ($stmt->execute()) {
        $user_id = $stmt->insert_id; // Get the inserted user ID

        // Set session variables
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $name;
        $_SESSION['role'] = $role;
        
        // Redirect to the profile page
        header('Location: profile.php');
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

