<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/dbconnection.php');

if (!isset($_SESSION['sturecmsaid']) || strlen($_SESSION['sturecmsaid']) == 0) {
  header('location:logout.php');
  exit;
}

if (isset($_POST['submit'])) {
  $eoname = $_POST['eoname'];
  $eoemail = $_POST['eoemail'];
  $eocourse_id = $_POST['eocourse'];
  $gender = $_POST['gender'];
  $studentid = $_POST['studentid'];
  $phonenumber = $_POST['phonenumber'];
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $image = $_FILES["image"]["name"];

  $ret = "SELECT UserName FROM tbleventorganizer WHERE username=:username || studentid=:studentid";
  $query = $dbh->prepare($ret);
  $query->bindParam(':username', $username, PDO::PARAM_STR);
  $query->bindParam(':studentid', $studentid, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);

  if ($query->rowCount() == 0) {
    $extension = substr($image, strlen($image) - 4, strlen($image));
    $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");

    if (!in_array($extension, $allowed_extensions)) {
      echo "<script>alert('Image has Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
    } else {
      $image = md5($image) . time() . $extension;
      move_uploaded_file($_FILES["image"]["tmp_name"], "images/" . $image);
      $sql = "INSERT INTO tbleventorganizer(eoname, eoemail, eocourse, gender, studentid, phonenumber, username, password, image) VALUES (:eoname, :eoemail, :eocourse, :gender, :studentid, :phonenumber, :username, :password, :image)";
      $query = $dbh->prepare($sql);
      $query->bindParam(':eoname', $eoname, PDO::PARAM_STR);
      $query->bindParam(':eoemail', $eoemail, PDO::PARAM_STR);
      $query->bindParam(':eocourse', $eocourse_id, PDO::PARAM_STR);
      $query->bindParam(':gender', $gender, PDO::PARAM_STR);
      $query->bindParam(':studentid', $studentid, PDO::PARAM_STR);
      $query->bindParam(':phonenumber', $phonenumber, PDO::PARAM_STR);
      $query->bindParam(':username', $username, PDO::PARAM_STR);
      $query->bindParam(':password', $password, PDO::PARAM_STR);
      $query->bindParam(':image', $image, PDO::PARAM_STR);

      if ($query->execute()) {
        echo '<script>alert("Event Organizer has been added.")</script>';
        echo "<script>window.location.href ='add-event-organizer.php'</script>";
      } else {
        echo '<script>alert("Something Went Wrong. Please try again")</script>';
      }
    }
  } else {
    echo "<script>alert('Username or Student ID already exist. Please try again');</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>AchieveX|| Add Event Organizer</title>
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/select2/select2.min.css">
  <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
  <div class="container-scroller">
    <?php include_once('includes/header.php');?>
    <div class="container-fluid page-body-wrapper">
      <?php include_once('includes/sidebar.php');?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title"> Add Event Organizer </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Add Event Organizer</li>
              </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title" style="text-align: center;">Add Event Organizer</h4>
                  <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputName1">Event Organizer Name</label>
                      <input type="text" name="eoname" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Event Organizer Email</label>
                      <input type="text" name="eoemail" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputEmail3">Event Organizer Course</label>
                      <select name="eocourse" class="form-control" required>
                        <option value="">Select Course</option>
                        <?php
                        $sql2 = "SELECT * FROM tblcourse";
                        $query2 = $dbh->prepare($sql2);
                        $query2->execute();
                        $result2 = $query2->fetchAll(PDO::FETCH_OBJ);
                        foreach ($result2 as $row1) {
                          echo '<option value="'.htmlentities($row1->ID).'">'.htmlentities($row1->coursename).' '.htmlentities($row1->coursecode).'</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Gender</label>
                      <select name="gender" class="form-control" required>
                        <option value="">Choose Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Student ID</label>
                      <input type="text" name="studentid" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Student Photo</label>
                      <input type="file" name="image" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Phone Number</label>
                      <input type="text" name="phonenumber" class="form-control" required maxlength="10" pattern="[0-9]+">
                    </div>
                    <h3>Login details</h3>
                    <div class="form-group">
                      <label for="exampleInputName1">User Name</label>
                      <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Password</label>
                      <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Add</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php include_once('includes/footer.php');?>
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
<?php ?>
