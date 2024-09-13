<!-- อย่าลืมทำให้เด้งหน้าโปรไฟล์-->
<?php
require_once('../connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}

if (isset($_GET["add"])) {
  if ($_GET["add"] == "pass") {
    $check_submit = check_submit_p2("บันทึกข้อมูลเรียบร้อยแล้ว");
  }
}
if (isset($_GET["update"])) {
  if ($_GET["update"] == "pass") {
    $check_submit = check_submit_p2("บันทึกข้อมูลเรียบร้อยแล้ว");
  }
}
if (isset($_GET["delete"])) {
  if ($_GET["delete"] == "pass") {
    $check_submit = check_submit_p2("ลบข้อมูลออกจากระบบเรียบร้อยแล้ว");
  }
}

$num = 1;

$sql = "SELECT * FROM tb_employee ORDER BY emp_id ASC";
$query = mysqli_query($Connection,$sql);
?>
<!doctype html>
<html lang="en">
  <?php $menu = "profile";?>
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
            <h1 class="h2">โปรไฟล์พนักงาน</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <form action="searchdata.php" class="form-group my-3" method="POST">
                    <div class="row">
                        <div class="col-6">
                            <input type="text" placeholder="กรอกข้อมูลที่ต้องการค้นหา" class="form-control" name="emp_data">
                        </div>
                        <div class="col-6">
                            <input type="submit" value="ค้นหาข้อมูล" class="btn btn-info">
                        </div>
                    </div>
                </form>
              <!-- เพิ่มข้อมูล -->
              <!--<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add_data">เพิ่มข้อมูล</button>-->
              <div class="modal fade" id="add_data" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <form class="modal-content" method="post" action="show_profile.php">
                    <!-- <div class="modal-header">
                      <h5 class="modal-title">เพิ่มข้อมูลส่วนตัวพนักงาน</h5>
                    </div> -->
                   <!-- <div class="modal-body">
                      <div class="mb-3">
                        <label class="form-label">ชื่อ</label>
                        <input type="text" class="form-control" name="user_name" required/>  
                      </div>
                      <div class="mb-3">
                        <label class="form-label">นามสกุล</label>
                        <input type="text" class="form-control" name="user_surname" required/>  
                      </div>
                      <div class="mb-3">
                        <label class="form-label">ชื่อเล่น</label>
                        <input type="text" class="form-control" name="mem_nickname" required/>  
                      </div>
                      <div class="mb-3">
                        <label class="form-label">เพศ</label>
                        <select class="form-select" name="mem_sex">
                          <option value="ชาย">ชาย</option>
                          <option value="หญิง">หญิง</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">วัน/เดือน/ปีเกิด</label>
                        <input type="text" class="form-control" name="mem_date" required/>
                      </div>                
                      <div class="mb-3">
                        <label class="form-label">อายุ</label>
                        <input type="text" class="form-control" name="mem_age" required/>
                      </div>                
                      <div class="mb-3">
                        <label class="form-label">สัญชาติ</label>
                        <input type="text" class="form-control" name="mem_nat" required/>
                      </div>                
                      <div class="mb-3">
                        <label class="form-label">ศาสนา</label>
                        <input type="text" class="form-control" name="mem_rel" required/>
                      </div>                                   
                      <div class="mb-3">
                        <label class="form-label">อีเมล์ (ไม่จำเป็นต้องกรอกข้อมูลช่องนี้)</label>
                        <input type="email" class="form-control" name="mem_email"/>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">ไลน์ ID</label>
                        <input type="text" class="form-control" name="mem_lineid"/>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">หมายเลขโทรศัพท์</label>
                        <input type="text" class="form-control" name="mem_tel"/>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">รหัสบัตรประจำตัวประชาชน</label>
                        <input type="text" class="form-control" name="mem_idcard"/>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">สถานะภาพ</label>
                        <select class="form-select" name="mem_status">
                          <option value="โสด">โสด</option>
                          <option value="มีแฟนแล้ว">มีแฟนแล้ว</option>
                          <option value="แต่งงานแล้ว">แต่งงานแล้ว</option>
                          <option value="หม้าย">หม้าย</option>
                          <option value="หย่าร้าง">หย่าร้าง</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">กรุ๊ปเลือด</label>
                        <select class="form-select" name="mem_bloodtype">
                          <option value="A">A</option>
                          <option value="B">B</option>
                          <option value="AB">AB</option>
                          <option value="O">O</option>                          
                        </select>
                      </div>                    
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                      <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                    </div> -->
                  </form>
                </div>
              </div>
            </div>
          </div>
          <?php echo $check_submit;?>
          <table class="table table-bordered table-hover"> <!-- table-sm -->
            <thead>
              <tr class="table-info">
                <th scope="col" width="65px">ลำดับที่</th>
                <th scope="col">รหัสพนักงาน</th>
                <th scope="col">ชื่อ</th>
                <th scope="col">ตัวเลือก</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($result = mysqli_fetch_array($query)) {
                ?>
                <tr>
                  <th scope="row"><?php echo $num++; ?></th>
                  <td><?php echo $result['emp_id']; ?></td>
                  <td><?php echo $result['emp_name']; ?></td>                                                                           
                  <td>
                    <!-- ปุ่มแก้ไข -->
                    <!-- ทำไฟล์ แก้ไข resume_edit-->
                    <button type="button" class="btn btn-warning btn-sm" onclick="window.location.href='show_profile.php?id=<?php echo $result['user_id'];?>'"><i class="bi bi-eye"></i></button>
                    <div class="modal fade" id="delete_data<?php echo $result['user_id']; ?>" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">ลบข้อมูล</h5>
                          </div>
                          <div class="modal-body">
                            กดยืนยันหากคุณต้องการลบผู้ใช้ <?php echo $result['user_id']; ?>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button type="button" class="btn btn-primary" onclick="window.location.href='resume_delete.php?id=<?php echo $result['user_id'];?>'">ยืนยัน</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </main>
      </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <?php mysqli_close($Connection); ?>
  </body>
</html>