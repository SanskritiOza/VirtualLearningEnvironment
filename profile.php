<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['name']) || !isset($_SESSION['role'])) {
    // Redirect to login page if not logged in
    header('Location: index.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="User Profile - View and update your profile information.">
    <title>User Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navigation Bar -->
    <header>
        <nav>
            <div class="logo">Virtual Learning Platform</div>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Profile Section -->
    <div class="container">
        <div class="profile-wrapper">
            <h2>User Profile</h2>
            <div class="profile-details">
                <p><strong>Username:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['name']); ?></p>
                <p><strong>Role:</strong> <?php echo htmlspecialchars(ucfirst($_SESSION['role'])); ?></p>
            </div>
            <a href="edit_profile.php" class="cta-button">Edit Profile</a>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Virtual Learning Platform. All rights reserved.</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>
