<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$user_id = $_SESSION['user_id'];

// Check if course_id exists in POST data
if (!isset($_POST['course_id'])) {
    die("No course selected.");
}

$course_id = intval($_POST['course_id']);  // Sanitize the course ID

// Debugging: Print the course_id to check if it's being passed correctly
echo 'Course ID: ' . $course_id . '<br>';

// Check if the course exists in the courses table
$stmt = $conn->prepare("SELECT * FROM courses WHERE id = ?");
$stmt->bind_param('i', $course_id);
$stmt->execute();
$course_result = $stmt->get_result();
$course = $course_result->fetch_assoc();

if (!$course) {
    die("Course not found. Please select a valid course.");  // This message shows if no course is found
}

// Check if the user is already enrolled in the course
$stmt = $conn->prepare("SELECT * FROM enrollments WHERE user_id = ? AND course_id = ?");
$stmt->bind_param('ii', $user_id, $course_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    die("User already enrolled in this course.");
}

// Enroll the user in the course
$stmt = $conn->prepare("INSERT INTO enrollments (user_id, course_id) VALUES (?, ?)");
$stmt->bind_param('ii', $user_id, $course_id);
if ($stmt->execute()) {
    echo "Successfully enrolled in " . $course['title'] . "!";
} else {
    echo "Enrollment failed.";
}

$conn->close();
?>
