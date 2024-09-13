<?php
require_once('../connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}

$id = $_GET["id"];

$sql = "SELECT * FROM tb_employee WHERE user_id = '".$id."'";
$query = mysqli_query($Connection,$sql);
$result = mysqli_fetch_array($query,MYSQLI_ASSOC);

if (isset($_POST["submit"])){
  $sql_2 = "UPDATE tb_employee SET emp_id = '".$_POST["emp_id"]."',emp_name = '".($_POST["emp_name"])."',emp_gender = '".$_POST["emp_gender"]."',emp_date = '".$_POST["emp_date"]."', emp_age = '".$_POST["emp_age"]."',emp_race = '".$_POST["emp_race"]."',emp_nation = '".$_POST["emp_nation"]."',emp_religion = '".$_POST["emp_religion"]."',emp_address = '".$_POST["emp_address"]."',emp_tel = '".$_POST["emp_tel"]."',emp_id_card = '".$_POST["emp_id_card"]."',emp_status = '".$_POST["emp_status"]."',pos_id = '".$_POST["pos_id"]."',file = '".$_FILES["file"]."' WHERE user_id = '".$id."'";
  $query_2 = mysqli_query($Connection,$sql_2);

  header("location:resume.php?update=pass");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>โปรไฟล์พนักงาน</title>
</head>

<body>
<!--อย่าลืมทำโชว์รูปภาพ-->
<?php include 'include/header.php';?>
<section style="background-color: #eee">
  <div class="container py-3">
  <main class="col-md-3 ms-sm-auto col-lg-12 px-md-2">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">โปรไฟล์</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
</div>
<div class="btn-toolbar mb-2 mb-md-0">
              <button type="button" class="btn btn-secondary" onclick="window.location.href='profile_show.php'">ย้อนกลับ</button>
            </div>
</div>
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <div class="item-label mb-2"><strong>รุูปภาพ</strong> </div>
            <div class="item-data"><img style="width:250px; height:250px;" class="profile-image rounded-circle" src="../images/<?php echo $result['file']; ?>" alt=""></div>
            <h5 class="my-3"></h5>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">รหัสพนักงาน :</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $result['emp_id']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">ชื่อ-นามสกุล :</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $result['emp_name']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">เพศ :</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $result['emp_gender']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">วัน/เดือน/ปีเกิด :</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $result['emp_date']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">อายุ :</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $result['emp_age']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">เชื้อชาติ :</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $result['emp_race']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">สัญชาติ :</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $result['emp_nation']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">ศาสนา :</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $result['emp_religion']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">ที่อยู่ :</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $result['emp_address']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">เบอร์โทรศัพท์ :</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $result['emp_tel']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">รหัสบัตรประจำตัวประชาชน :</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $result['emp_id_card']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">สถานะภาพ :</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $result['emp_status']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">ตำแหน่ง :</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $result['pos_id']; ?></p>
              </div>
            </div>
            <hr>
          </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<?php mysqli_close($Connection);?>
</body>
</html>