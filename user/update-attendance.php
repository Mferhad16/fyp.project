<?php
session_start();
error_reporting(E_ALL); // Set error reporting to ALL for debugging
ini_set('display_errors', 1); // Ensure errors are displayed

include('includes/dbconnection.php');

// Check if the user is logged in
if (strlen($_SESSION['sturecmsstuid']) == 0) {
    header('location:logout.php');
    exit;
}

// Check if participant ID and attendance status are set
if (isset($_POST['participant_id']) && isset($_POST['attendance'])) {
    $participant_id = intval($_POST['participant_id']);
    $attendance_status = $_POST['attendance']; // Should be either 'attend' or 'absent'

    // Update attendance status in the database
    $sql = "UPDATE tblparticipant SET attendanceStatus = :attendanceStatus WHERE ID = :participantID";
    $query = $dbh->prepare($sql);
    $query->bindParam(':attendanceStatus', $attendance_status, PDO::PARAM_STR);
    $query->bindParam(':participantID', $participant_id, PDO::PARAM_INT);

    try {
        $query->execute();
        header('Location: ' . $_SERVER['HTTP_REFERER']); // Redirect back to the participant list page
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>
