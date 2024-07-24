<?php
include('includes/dbconnection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $participant_id = isset($_POST['participant_id']) ? $_POST['participant_id'] : null;
    $current_status = isset($_POST['current_status']) ? $_POST['current_status'] : null;

    if ($participant_id && $current_status) {
        $new_status = ($current_status === 'No') ? 'Yes' : 'No';
        $sql = "UPDATE tblparticipant SET verificationStatus = :new_status WHERE ID = :participant_id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':new_status', $new_status, PDO::PARAM_STR);
        $query->bindParam(':participant_id', $participant_id, PDO::PARAM_INT);

        $response = ['success' => false, 'newStatus' => $new_status];
        if ($query->execute()) {
            $response['success'] = true;
        }

        echo json_encode($response);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
