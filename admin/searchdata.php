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
$emp_data = $_POST['emp_data'];

$sql = "SELECT * FROM tb_employee where emp_id like '%$emp_data%' or emp_name like '%$emp_data%' order by emp_name asc";
$query = mysqli_query($Connection,$sql);
?>
<!doctype html>
<html lang="en">
  <?php $menu ="resume";?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/dashboard.css">
    <title>ข้อมูลส่วนตัวพนักงาน</title>
  </head>
  <body>
    <?php include 'include/header.php'; ?>
    <div class="container-fluid">
      <div class="row">
        <?php include 'include/sidebarMenu.php'; ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-2">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">ข้อมูลส่วนตัวพนักงาน</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
            <form action="searchdata.php" class="form-group my-3" method="POST">
                    <div class="row">
                        <div class="col-6">
                            <input type="text" placeholder="กรอกข้อมูลที่ต้องการค้นหา" class="form-control" name="emp_data" required>
                        </div> 
                        <div class="col-6">
                            <input type="submit" value="ค้นหาข้อมูล" class="btn btn-info">
                        </div>
                    </div>
                </form>
                <?php if($count >0) {?>
              <!-- เพิ่มข้อมูล -->
              <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add_data">เพิ่มข้อมูล</button>
              <div class="modal fade" id="add_data" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <!-- อย่าลืมมาเปลีั่ยนชื่อไฟล์ถ้า add ข้อมูลได้-->
                  <form class="modal-content" method="post" action="resume_add_data.php">
                    <div class="modal-header">
                      <h5 class="modal-title">เพิ่มข้อมูลส่วนตัวพนักงาน</h5>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label class="form-label">รหัสพนักงาน</label>
                        <input type="text" class="form-control" name="emp_id" placeholder="EMP-001" required/>  
                      </div>
                      <div class="mb-3">
                        <label class="form-label">ชื่อ-นามสกุล</label>
                        <input type="text" class="form-control" name="emp_name" required/>  
                      </div>
                      <div class="mb-3">
                        <label class="form-label">เพศ</label>
                        <select class="form-select" name="emp_gender">
                          <option value="ชาย">ชาย</option>
                          <option value="หญิง">หญิง</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">วัน/เดือน/ปีเกิด</label>
                        <input type="date" class="form-control" name="emp_date" required/>
                      </div>                
                      <div class="mb-3">
                        <label class="form-label">อายุ</label>
                        <input type="text" class="form-control" name="emp_age" required/>
                      </div>                
                      <div class="mb-3">
                        <label class="form-label">เชื้อชาติ</label>
                        <input type="text" class="form-control" name="emp_race" required/>
                      </div>                
                      <div class="mb-3">
                        <label class="form-label">สัญชาติ</label>
                        <input type="text" class="form-control" name="emp_nation" required/>
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
                        <input type="text" class="form-control" name="emp_address"/>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">เบอร์โทรศัพท์</label>
                        <input type="text" class="form-control" name="emp_tel"/>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">รหัสบัตรประจำตัวประชาชน</label>
                        <input type="text" class="form-control" name="emp_id_card" required/>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">สถานะภาพ</label>
                        <select class="form-select" name="emp_status" required>
                          <option value="โสด">โสด</option>
                          <option value="มีแฟนแล้ว">มีแฟนแล้ว</option>
                          <option value="แต่งงานแล้ว">แต่งงานแล้ว</option>
                          <option value="หม้าย">หม้าย</option>
                          <option value="หย่าร้าง">หย่าร้าง</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">ตำแหน่ง</label>
                        <select class="form-select" name="emp_position" required>
                          <option value="ผู้บริหาร">ผู้บริหาร</option>
                          <option value="บัญชี">บัญชี</option>
                          <option value="เลขานุการ">เลขานุการ</option>
                          <option value="แม่บ้าน">แม่บ้าน</option> 
                          <option value="ช่างทั่วไป">ช่างทั่วไป</option>                            
                        </select>              
                    </div>
                    <div class="mb-3">
                          <label>แนบรูปถ่าย</label>
                          <input type="file" name="emp_img" class="form-control streched-link" accept="image/gif, image/jpeg, image/png">
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                      <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            </div>
          </div>
          <?php echo $check_submit;?>
          <table class="table table-bordered table-hover"> <!-- table-sm -->
            <thead>
              <tr class="table-info">
                <th scope="col" width="70px">ลำดับที่</th>
                <th scope="col" width="100px">รหัสพนักงาน</th>
                <th scope="col" width="150px">ชื่อพนักงาน</th>
                <th scope="col">เพศ</th>
                <th scope="col">วัน/เดือน/ปีเกิด</th>
                <th scope="col">อายุ</th>
                <th scope="col" width="80px">เชื้อชาติ</th>
                <th scope="col">สัญชาติ</th>
                <th scope="col">ศาสนา</th>
                <th scope="col" width="150px">ที่อยู่</th>
                <th scope="col"width="120px">เบอร์โทรศัพท์</th>
                <th scope="col">รหัสบัตรประจำตัวประชาชน</th>
                <th scope="col">สถานะภาพ</th>
                <th scope="col">ตำแหน่ง</th>
                <th scope="col">รูปภาพ</th>
                <th scope="col" width="90px">ตัวเลือก</th>
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
                  <td><?php echo $result['emp_gender']; ?></td>
                  <td><?php echo $result['emp_date']; ?></td>           
                  <td><?php echo $result['emp_age']; ?></td>
                  <td><?php echo $result['emp_race']; ?></td>
                  <td><?php echo $result['emp_nation']; ?></td> 
                  <td><?php echo $result['emp_religion']; ?></td> 
                  <td><?php echo $result['emp_address']; ?></td> 
                  <td><?php echo $result['emp_tel']; ?></td> 
                  <td><?php echo $result['emp_id_card']; ?></td> 
                  <td><?php echo $result['emp_status']; ?></td> 
                  <td><?php echo $result['emp_position']; ?></td> 
                  <td><img src="../images/<?php echo $result['emp_img'];?>"></td> 
                  <td>
                    <!-- ปุ่มแก้ไข -->
                    <button type="button" class="btn btn-success btn-sm" onclick="window.location.href='resume_edit.php?id=<?php echo $result['user_id'];?>'"><i class="bi bi-pencil-square"></i></button>
                    <!-- ลบข้อมูล-->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_data<?php echo $result['user_id']; ?>">
                      <i class="bi bi-trash"></i>
                    </button>
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
          <?php }else{?>
            <div class="alert alert-danger">
                <b>ไม่พบข้อมูลที่ค้นหา!!</b>
            </div> 
            <?php }?>
        </main>
      </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <?php mysqli_close($Connection); ?>
  </body>
</html>
