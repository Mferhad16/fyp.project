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

// Check if event_id is set
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
} else {
    header('location:event-list.php');
    exit;
}

// Fetch participants for the given event ID
$sql = "SELECT * FROM tblparticipant WHERE eventID = :eventID";
$queryz = $dbh->prepare($sql);
$queryz->bindParam(':eventID', $event_id, PDO::PARAM_INT);

try {
    $queryz->execute();
    $resultsz = $queryz->fetchAll(PDO::FETCH_OBJ);
    if ($queryz->rowCount() > 0) {
        foreach ($resultsz as $row) {
            error_log("Fetched Participant: " . print_r($row, true)); // Debugging line
        }
    } else {
        error_log("No participants found for event ID: " . $event_id); // Debugging line
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participants List</title>
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/style.css">
    <script>
        function toggleVerification(participantId, currentStatus) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "verify-participate.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        var button = document.getElementById("verification-btn-" + participantId);
                        button.innerText = response.newStatus === 'Yes' ? 'Unverified' : 'Verified';
                        button.className = response.newStatus === 'Yes' ? 'btn btn-success' : 'btn btn-danger';
                        button.setAttribute('onclick', "toggleVerification(" + participantId + ", '" + response.newStatus + "')");
                        
                        // Update the verification status text in the table
                        var statusCell = document.getElementById("verification-status-" + participantId);
                        statusCell.innerText = response.newStatus;
                    } else {
                        alert("Failed to update verification status");
                    }
                }
            };
            xhr.send("participant_id=" + participantId + "&current_status=" + currentStatus);
        }
    </script>
</head>
<body>
    <div class="container-scroller">
        <?php include_once('includes/header.php'); ?>
        <div class="container-fluid page-body-wrapper">
            <?php include_once('includes/sidebar.php'); ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">Participants List</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="event-list.php">Event List</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Participants List</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Participants for Event ID: <?php echo htmlentities($event_id); ?></h4>
                                    <div class="table-responsive border rounded p-1">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="font-weight-bold">S.No</th>
                                                    <th class="font-weight-bold">Student IC</th>
                                                    <th class="font-weight-bold">Student Name</th>
                                                    <th class="font-weight-bold">Student Phone Number</th>
                                                    <th class="font-weight-bold">Verification Status</th>
                                                    <th class="font-weight-bold">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $cnt = 1;
                                                if ($queryz->rowCount() > 0) {
                                                    foreach ($resultsz as $row) {
                                                        $studentIC = isset($row->studentIC) ? htmlentities($row->studentIC) : '';
                                                        $studentName = isset($row->studentName) ? htmlentities($row->studentName) : '';
                                                        $studentPhoneNumber = isset($row->studentPhoneNumber) ? htmlentities($row->studentPhoneNumber) : '';
                                                        $verificationStatus = isset($row->verificationStatus) ? htmlentities($row->verificationStatus) : '';

                                                        echo "<tr>";
                                                        echo "<td>" . htmlentities($cnt) . "</td>";
                                                        echo "<td>" . $studentIC . "</td>";
                                                        echo "<td>" . $studentName . "</td>";
                                                        echo "<td>" . $studentPhoneNumber . "</td>";
                                                        echo "<td id='verification-status-" . $row->ID . "'>" . $verificationStatus . "</td>";
                                                        echo "<td>";
                                                        echo "<button id='verification-btn-" . $row->ID . "' class='btn " . ($verificationStatus == 'Yes' ? 'btn-danger' : 'btn-success') . "' onclick=\"toggleVerification(" . htmlentities($row->ID) . ", '" . htmlentities($verificationStatus) . "')\">" . ($verificationStatus == 'No' ? 'Unverified' : 'Verified') . "</button>";
                                                        echo "</td>";
                                                        echo "</tr>";
                                                        $cnt++;
                                                    }
                                                } else {
                                                    echo '<tr><td colspan="6">No participants found</td></tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include_once('includes/footer.php'); ?>
            </div>
        </div>
    </div>
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
</body>
</html>
