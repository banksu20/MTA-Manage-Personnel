<?php
require_once('connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:login.php");
  exit();
}

$check_submit = "";

$sql = "SELECT * FROM tb_user WHERE user_username = '".$_SESSION['user_username']."'";
$query = mysqli_query($Connection,$sql);
$result = mysqli_fetch_array($query);

if (isset($_GET['update'])) {
  if ($_GET['update'] == "pass") {
    $check_submit = '<div class="alert alert-success" role="alert">';
    $check_submit .= '<span><i class="bi bi-check2-circle"></i> บันทึกข้อมูลเรียบร้อยแล้ว</span>';
    $check_submit .= '</div>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/icons/bootstrap-icons.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <link rel="stylesheet" href="assets/icons/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css"/>
    <link rel="stylesheet" href="assets/dashboard.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js">
</head>
<body class="default">
  <?php include 'includes/navbar.php';?>
  <div class="container-fluid">
    <div class="row justify-content-md-center">
        <?php include 'includes/sidebarMenu.php'; ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="col-md-auto"><?php echo $check_submit;?></div>
      </div>
    <div class="row justify-content-md-center">
      <div class="col-md-5 mb-4">
        <div class="card border-dark mt-2">
          <h5 class="card-header"><i class="bi bi-person-bounding-box"></i> ข้อมูลส่วนตัวของฉัน</h5>
          <div class="card-body">
            <h5 class="card-text">ชื่อผู้ใช้ : <span class="badge bg-primary"><?php echo $result[1]; ?></span></h5>
            <h5 class="card-text">ชื่อ - นามสกุล : <span class="badge bg-primary"><?php echo $result[3].' '.$result[4]; ?></span></h5>
            <h5 class="card-text">อีเมล์ :
              <?php
              if ($result[6] == NULL) {
                echo "<span class='badge bg-danger'>ว่าง</span>";
              }else{
                echo "<span class='badge bg-primary'>$result[5]</span>";
              }
              ?>
            </h5>
            <h5 class="card-text">ระดับผู้ใช้ : <span class="badge bg-primary"><?php if ($result[6] == "member") {echo "พนักงาน";}else{echo "ผู้ดูแลระบบ";} ?></span></h5>
            <div class="mt-3">
              <!-- <a href="profile_edit.php" class="btn btn-success">แก้ไขข้อมูล</a> -->
              <a href="change_password.php" class="btn btn-warning">เปลี่ยนรหัสผ่าน</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <?php mysqli_close($Connection);?>
</body>
</html>
