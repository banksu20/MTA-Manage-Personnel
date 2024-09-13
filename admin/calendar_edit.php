<?php
require_once('../connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}

$id = $_GET["id"];

$sql = "SELECT * FROM tb_calendar WHERE cal_id = '".$id."'";
$query = mysqli_query($Connection,$sql);
$result = mysqli_fetch_array($query,MYSQLI_ASSOC);

if (isset($_POST["submit"])) {
  $sql_2 = "UPDATE tb_calendar SET emp_id = '".$_POST["emp_id"]."',start_date = '".($_POST["start_date"])."',end_date = '".$_POST["end_date"]."', times = '".$_POST["times"]."', approved_date = '".$_POST["approved_date"]."' WHERE cal_id = '".$id."'";
                  
  $query_2 = mysqli_query($Connection,$sql_2);

  header("location:calendar.php?update=pass");
  exit();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/dashboard.css">
    <title>กรอกข้อมูล</title>
  </head>
  <body>
    <?php include 'include/header.php'; ?>
    <div class="container-fluid">
      <div class="row">
        <?php include 'include/sidebarMenu.php'; ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">แก้ไขข้อมูลลาหยุดพนักงาน</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <button type="button" class="btn btn-secondary" onclick="window.location.href='calendar.php'">ย้อนกลับ</button>
            </div>
          </div>
          <div class="row justify-content-md-center">
            <div class="col-6">
              <div class="card">
                <h5 class="card-header">แก้ไขข้อมูลลาหยุดพนักงาน</h5>
                <div class="card-body">
                  <form method="post">
                    <div class="mb-3">
                      <label class="form-label">รหัสพนักงาน</label>
                      <input type="text" class="form-control" name="emp_id" value="<?php echo $result['emp_id']; ?>" required/>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">วันที่เริ่มลาหยุด</label>
                      <input type="date" class="form-control" name="start_date" value="<?php echo $result['start_date']; ?>" required/>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">วันที่สิ้นสุดการลาหยุด</label>
                      <input type="date" class="form-control" name="end_date" value="<?php echo $result['end_date']; ?>" required/>
                    </div>
                    <div class="mb-3">
                    <label class="form-label">หยุด/ลา ครั้งที่</label>
                    <input type="text" class="form-control" name="times" value="<?php echo $result['times']; ?>" required/>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">วันที่ลงวันหยุด/ลา</label>
                      <input type="date" class="form-control" name="approved_date" value="<?php echo $result['approved_date']; ?>" required/>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">บันทึก</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <?php mysqli_close($Connection); ?>
  </body>
</html>
