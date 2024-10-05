<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$user_id = $_SESSION['user_id'];

// Check if course_id and action (like or dislike) are provided in POST data
if (!isset($_POST['course_id']) || !isset($_POST['action'])) {
    die("Invalid request.");
}

$course_id = intval($_POST['course_id']);
$action = $_POST['action'];

// Determine the value for liked (1 for like, 0 for dislike)
$liked = ($action === 'like') ? 1 : 0;

// Check if the user has already liked or disliked this course
$stmt = $conn->prepare("SELECT * FROM likes_dislikes WHERE user_id = ? AND course_id = ?");
$stmt->bind_param('ii', $user_id, $course_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Update the existing like/dislike
    $stmt = $conn->prepare("UPDATE likes_dislikes SET liked = ? WHERE user_id = ? AND course_id = ?");
    $stmt->bind_param('iii', $liked, $user_id, $course_id);
} else {
    // Insert a new like/dislike
    $stmt = $conn->prepare("INSERT INTO likes_dislikes (user_id, course_id, liked) VALUES (?, ?, ?)");
    $stmt->bind_param('iii', $user_id, $course_id, $liked);
}

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Action recorded']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to record action']);
}

$conn->close();
?>
