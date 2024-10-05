<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header('Location: index.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="<?php echo htmlspecialchars($theme); ?>"> <!-- Use the theme for styling -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navigation Bar -->
    <header>
        <nav>
            <div class="logo">Virtual Learning Platform</div>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="courses.php">Courses</a></li>
                <li><a href="#">Live Classes</a></li>
                <li><a href="resources.html">Resources</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Dashboard Content -->
    <div class="container dashboard-container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
        <!--<p>Theme: <?php echo htmlspecialchars($theme); ?></p>
        <p>Items per page: <?php echo htmlspecialchars($items_per_page); ?></p>-->

        <div class="card-container">
            <div class="card">
                <h3>Upcoming Live Classes</h3>
                <p>No live classes scheduled.</p>
            </div>
            <div class="card">
                <h3>Shared Resources</h3>
                <p>No resources available.</p>
            </div>
        </div>
    </div>
</body>
</html>

