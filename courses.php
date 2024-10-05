<?php
session_start();
include 'db_connection.php'; // Include the database connection

// Fetch all courses from the database
$query = "SELECT * FROM courses";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Learn web development with courses on HTML, CSS, JavaScript, PHP, and MySQL.">
    <title>Courses - Web Development</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Navigation Bar -->
    <header>
        <nav>
            <div class="logo">Virtual Learning Platform</div>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="resources.html">Resources</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.html">Login</a></li>
                    <li><a href="register.html">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <!-- Courses Section -->
    <section class="courses">
        <h1>Web Development Courses</h1>
        <div class="course-card-container">

            <?php
            if ($result->num_rows > 0) {
                // Loop through the courses and display them
                while ($course = $result->fetch_assoc()) {
            ?>
                    <div class="course-card">
                        <h2><?php echo $course['title']; ?></h2>
                        <p><?php echo $course['description']; ?></p>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <form action="enroll.php" method="POST">
                                <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                                <button type="submit" class="cta-button">Enroll in <?php echo $course['title']; ?></button>
                            </form>
                        <?php else: ?>
                            <p class="login-prompt">Please <a href="login.html">log in</a> to enroll.</p>
                        <?php endif; ?>
                        <br>
                        <!-- Like/Dislike Buttons -->
                        <div class="like-dislike">
                            <button class="like-button" onclick="likeItem(<?php echo $course['id']; ?>)">👍</button>
                            <span id="like-count-<?php echo $course['id']; ?>">0</span>
                            <button class="dislike-button" onclick="dislikeItem(<?php echo $course['id']; ?>)">👎</button>
                            <span id="dislike-count-<?php echo $course['id']; ?>">0</span>
                        </div>

                    </div>
            <?php
                }
            } else {
                echo "<p>No courses available at the moment.</p>";
            }
            ?>

        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Virtual Learning Platform. All rights reserved.</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
