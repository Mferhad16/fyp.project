<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsstuid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $eventname = $_POST['eventname'];
        $eventdate = $_POST['eventdate'];
        $eoname = $_POST['eoname'];
        $eaname = $_POST['eaname'];
        $eventloc = $_POST['eventloc'];
        $sql = "insert into tblevent(eventname,eventdate,eoname,eaname,eventloc)values(:eventname,:eventdate,:eoname,:eaname,:eventloc)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':eventname', $eventname, PDO::PARAM_STR);
        $query->bindParam(':eventdate', $eventdate, PDO::PARAM_STR);
        $query->bindParam(':eoname', $eoname, PDO::PARAM_STR);
        $query->bindParam(':eaname', $eaname, PDO::PARAM_STR);
        $query->bindParam(':eventloc', $eventloc, PDO::PARAM_STR);
        $query->execute();
        $LastInsertId = $dbh->lastInsertId();
        if ($LastInsertId > 0) {
            echo '<script>alert("Event has been created.")</script>';
            echo "<script>window.location.href ='add-event.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>AchieveX|| Add Event</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
        <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="vendors/select2/select2.min.css">
        <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <!-- endinject -->
        <!-- Layout styles -->
        <link rel="stylesheet" href="css/style.css" />

    </head>

    <body>
        <div class="container-scroller">
            <!-- partial:partials/_navbar.html -->
            <?php include_once('includes/header.php'); ?>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_sidebar.html -->
                <?php include_once('includes/sidebar.php'); ?>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="page-header">
                            <h3 class="page-title"> Add Event </h3>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Add Event</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="row">

                            <div class="col-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title" style="text-align: center;">Add Event</h4>

                                        <form class="forms-sample" method="post">

                                            <div class="form-group">
                                                <label for="exampleInputName1">Event Name</label>
                                                <input type="text" name="eventname" value="" class="form-control" required='true'>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Event Date</label>
                                                <input type="date" name="eventdate" value="" class="form-control" required='true'>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Event Organizer Name</label>
                                                <input type="text" name="eoname" value="" class="form-control" required='true'>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Event Advisor Name</label>
                                                <input type="text" name="eaname" value="" class="form-control" required='true'>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Event Location</label>
                                                <select name="evenloc" class="form-control" required='true'>
                                                    <option value="Dewan Al-ghazali">Dewan Al-ghazali</option>
                                                    <option value="DATC">DATC</option>
                                                    <option value="Dewan Kuliah 1">Dewan Kuliah 1</option>
                                                    <option value="Dewan Kuliah 2">Dewan Kuliah 2</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary mr-2" name="submit">Add</button>


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer.html -->
                    <?php include_once('includes/footer.php'); ?>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="vendors/select2/select2.min.js"></script>
        <script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="js/off-canvas.js"></script>
        <script src="js/misc.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page -->
        <script src="js/typeahead.js"></script>
        <script src="js/select2.js"></script>
        <!-- End custom js for this page -->
    </body>

    </html><?php }  ?>