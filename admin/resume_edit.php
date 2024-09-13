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

if (isset($_POST["submit"])) {
  $sql_2 = "UPDATE tb_employee SET emp_id = '".$_POST["emp_id"]."',emp_name = '".($_POST["emp_name"])."',emp_gender = '".$_POST["emp_gender"]."',emp_date = '".$_POST["emp_date"]."', emp_age = '".$_POST["emp_age"]."',emp_race = '".$_POST["emp_race"]."',emp_nation = '".$_POST["emp_nation"]."',emp_religion = '".$_POST["emp_religion"]."',emp_address = '".$_POST["emp_address"]."',emp_tel = '".$_POST["emp_tel"]."',emp_id_card = '".$_POST["emp_id_card"]."',emp_status = '".$_POST["emp_status"]."',pos_id = '".$_POST["pos_id"]."' WHERE user_id = '".$id."'";
  $query_2 = mysqli_query($Connection,$sql_2);

  header("location:resume.php?update=pass");
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
            <h1 class="h2">แก้ไขข้อมูลส่วนตัวพนักงาน</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <button type="button" class="btn btn-secondary" onclick="window.location.href='resume.php'">ย้อนกลับ</button>
            </div>
          </div>
          <div class="row justify-content-md-center">
            <div class="col-6">
              <div class="card">
                <h5 class="card-header text-center">แก้ไขข้อมูลส่วนตัวพนักงาน</h5>
                <div class="card-body">
                  <form method="post">
                    <div class="mb-3">
                      <label class="form-label">รหัสพนักงาน</label>
                      <input type="text" class="form-control" name="emp_id" value="<?php echo $result['emp_id']; ?>" required/>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">ชื่อ-นามสกุล</label>
                      <input type="text" class="form-control" name="emp_name" value="<?php echo $result['emp_name']; ?>" required/>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">เพศ</label>
                      <select class="form-select" name="emp_gender">
                        <option value="ชาย" <?php if ($result["emp_gender"] == 'ชาย') {echo " selected";} ?>>ชาย</option>
                        <option value="หญิง" <?php if ($result["emp_gender"] == 'หญิง') {echo " selected";} ?>>หญิง</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">วัน/เดือน/ปีเกิด</label>
                      <input type="text" class="form-control" name="emp_date" value="<?php echo $result['emp_date']; ?>" required/>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">อายุ</label>
                      <input type="text" class="form-control" name="emp_age" value="<?php echo $result['emp_age']; ?>" required/>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">เชื้อชาติ</label>
                      <input type="text" class="form-control" name="emp_race" value="<?php echo $result['emp_race']; ?>" required/>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">สัญชาติ</label>
                      <input type="text" class="form-control" name="emp_nation" value="<?php echo $result['emp_nation']; ?>" required/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ศาสนา</label>
                        <select class="form-select" name="emp_religion" required>
                          <option value="พุทธ">พุทธ</option>
                          <option value="อิสลาม">อิสลาม</option>
                          <option value="คริสต์">คริสต์</option>
                          <option value="พราหมณ์-ฮินดู">พราหมณ์-ฮินดู</option>
                        </select>
                      </div>      
                      <div class="mb-3">
                        <label class="form-label">ที่อยู่</label>
                        <input type="text" class="form-control" name="emp_address" value="<?php echo $result['emp_address']; ?>" required/>
                      </div>
                    <div class="mb-3">
                      <label class="form-label">เบอร์โทรศัพท์</label>
                      <input type="text" class="form-control" name="emp_tel" value="<?php echo $result['emp_tel']; ?>" required/>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">รหัสบัตรประจำตัวประชาชน</label>
                      <input type="text" class="form-control" name="emp_id_card" value="<?php echo $result['emp_id_card']; ?>" required/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">สถานะภาพ</label>
                        <select class="form-select" name="emp_status">
                          <option value="โสด">โสด</option>
                          <option value="มีแฟนแล้ว">มีแฟนแล้ว</option>
                          <option value="แต่งงานแล้ว">แต่งงานแล้ว</option>
                          <option value="หม้าย">หม้าย</option>
                          <option value="หย่าร้าง">หย่าร้าง</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">ตำแหน่ง</label>
                        <select name="pos_id" class="form-control" id="">
                        <?php
                            $sql_status = $Connection->query("SELECT * FROM tb_position");
                            while($row = mysqli_fetch_array($sql_status)){
                        ?>
                            <option value="<?php echo $row['pos_id'] ?>"><?php echo $row['pos_name'] ?></option>
                        <?php
                            }
                        ?>
                        </select>             
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
