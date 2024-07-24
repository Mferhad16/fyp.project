<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('includes/dbconnection.php');

// Check if the user is logged in
if (!isset($_SESSION['sturecmsstuid']) || strlen($_SESSION['sturecmsstuid']) == 0) {
    header('location:logout.php');
    exit;
}

// Initialize eventID
$eventID = 0;

// Check if event_id is set in GET request
if (isset($_GET['event_id'])) {
    $eventID = $_GET['event_id'];
} elseif (isset($_POST['eventID'])) {
    $eventID = $_POST['eventID'];
} else {
    header('location:event-list.php');
    exit;
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $studentIC = $_POST['studentIC'];
    $studentName = $_POST['studentName'];
    $studentPhoneNumber = $_POST['studentPhoneNumber'];

    // Insert participant into the database
    $sql = "INSERT INTO tblparticipant (studentIC, studentName, studentPhoneNumber, eventID) VALUES (:studentIC, :studentName, :studentPhoneNumber, :eventID)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':studentIC', $studentIC, PDO::PARAM_STR);
    $query->bindParam(':studentName', $studentName, PDO::PARAM_STR);
    $query->bindParam(':studentPhoneNumber', $studentPhoneNumber, PDO::PARAM_STR);
    $query->bindParam(':eventID', $eventID, PDO::PARAM_INT);

    if ($query->execute()) {
        echo '<script>alert("Registration successful.")</script>';
        echo "<script>window.location.href ='participant-list.php?event_id=" . htmlentities($eventID) . "'</script>";
    } else {
        $errorInfo = $query->errorInfo();
        echo '<script>alert("Error: ' . $errorInfo[2] . '")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Participation</title>
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container-scroller">
        <?php include_once('includes/header.php'); ?>
        <div class="container-fluid page-body-wrapper">
            <?php include_once('includes/sidebar.php'); ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title"> Register Participation </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Register Participation</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title" style="text-align: center;">Register Participation</h4>
                                    <form class="forms-sample" method="post">
                                        <div class="form-group">
                                            <label for="studentIC">Student IC</label>
                                            <input type="text" name="studentIC" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="studentName">Student Name</label>
                                            <input type="text" name="studentName" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="studentPhoneNumber">Student Phone Number</label>
                                            <input type="text" name="studentPhoneNumber" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="eventID">Event ID</label>
                                            <input type="number" name="eventID" value="<?php echo htmlentities($eventID); ?>" class="form-control" required readonly>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2" name="submit">Add</button>
                                    </form>
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
<?php
?>
