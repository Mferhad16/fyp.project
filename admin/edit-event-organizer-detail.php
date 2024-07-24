<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid'] == 0)) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    $eoname = $_POST['eoname'];
    $eoemail = $_POST['eoemail'];
    $eocourse = $_POST['eocourse'];
    $gender = $_POST['gender'];
    $studentid = $_POST['studentid'];
    $phonenumber = $_POST['phonenumber'];
    $eid = $_GET['editid'];
    $sql = "UPDATE tbleventorganizer SET eoname=:eoname, eoemail=:eoemail, eocourse=:eocourse, gender=:gender, studentid=:studentid, phonenumber=:phonenumber WHERE ID=:eid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':eoname', $eoname, PDO::PARAM_STR);
    $query->bindParam(':eoemail', $eoemail, PDO::PARAM_STR);
    $query->bindParam(':eocourse', $eocourse, PDO::PARAM_STR);
    $query->bindParam(':gender', $gender, PDO::PARAM_STR);
    $query->bindParam(':studentid', $studentid, PDO::PARAM_STR);
    $query->bindParam(':phonenumber', $phonenumber, PDO::PARAM_STR);
    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
    $query->execute();
    echo '<script>alert("Event Organizer has been updated")</script>';
    echo "<script>window.location.href = 'manage-event-organizer.php'</script>";
  }

  $eid = $_GET['editid'];
  $sql = "SELECT tbleventorganizer.eoname, tbleventorganizer.eoemail, tbleventorganizer.eocourse, tbleventorganizer.gender, tbleventorganizer.studentid, tbleventorganizer.phonenumber, tbleventorganizer.image, tblcourse.coursename, tblcourse.coursecode 
          FROM tbleventorganizer 
          JOIN tblcourse ON tblcourse.ID = tbleventorganizer.eocourse 
          WHERE tbleventorganizer.ID = :eid";
  $query = $dbh->prepare($sql);
  $query->bindParam(':eid', $eid, PDO::PARAM_STR);
  $query->execute();
  $result = $query->fetch(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>AchieveX || Update Event Organizer</title>
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/select2/select2.min.css">
  <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
  <div class="container-scroller">
    <?php include_once('includes/header.php'); ?>
    <div class="container-fluid page-body-wrapper">
      <?php include_once('includes/sidebar.php'); ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title"> Update Event Organizer </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Update Event Organizer</li>
              </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title" style="text-align: center;">Update Event Organizer</h4>
                  <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="eoname">Event Organizer Name</label>
                      <input type="text" name="eoname" value="<?php echo htmlentities($result->eoname); ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="eoemail">Event Organizer Email</label>
                      <input type="email" name="eoemail" value="<?php echo htmlentities($result->eoemail); ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="eocourse">Event Organizer Course</label>
                      <select name="eocourse" class="form-control" required>
                        <option value="<?php echo htmlentities($result->eocourse); ?>"><?php echo htmlentities($result->coursename); ?> <?php echo htmlentities($result->coursecode); ?></option>
                        <?php
                        $sql2 = "SELECT * FROM tblcourse";
                        $query2 = $dbh->prepare($sql2);
                        $query2->execute();
                        $courses = $query2->fetchAll(PDO::FETCH_OBJ);
                        foreach ($courses as $course) {
                        ?>
                          <option value="<?php echo htmlentities($course->ID); ?>"><?php echo htmlentities($course->coursename); ?> <?php echo htmlentities($course->coursecode); ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="gender">Gender</label>
                      <select name="gender" class="form-control" required>
                        <option value="<?php echo htmlentities($result->gender); ?>"><?php echo htmlentities($result->gender); ?></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="studentid">Student ID</label>
                      <input type="text" name="studentid" value="<?php echo htmlentities($result->studentid); ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                      <label for="image">Student Photo</label>
                      <img src="images/<?php echo htmlentities($result->image); ?>" width="100" height="100">
                      <a href="changeimage.php?editid=<?php echo htmlentities($result->ID); ?>"> &nbsp; Edit Image</a>
                    </div>
                    <div class="form-group">
                      <label for="phonenumber">Phone Number</label>
                      <textarea name="phonenumber" class="form-control" required><?php echo htmlentities($result->phonenumber); ?></textarea>
                    </div>
                    <h3>Login details</h3>
                    <div class="form-group">
                      <label for="username">User Name</label>
                      <input type="text" name="username" value="<?php echo htmlentities($result->username); ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" name="password" value="<?php echo htmlentities($result->password); ?>" class="form-control" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Update</button>
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
  <script src="vendors/select2/select2.min.js"></script>
  <script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <script src="js/typeahead.js"></script>
  <script src="js/select2.js"></script>
</body>
</html>
<?php } ?>
