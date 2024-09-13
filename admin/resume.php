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


$sql = "SELECT * FROM tb_employee, tb_position WHERE tb_position.pos_id = tb_employee.pos_id ORDER BY emp_id ASC ";
$query = mysqli_query($Connection,$sql);
?>
<!doctype html>
<html lang="en">
  <?php $menu ="resume";?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/icons/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="../assets/DataTables/datatables.min.css"/>
    <link rel="stylesheet" href="assets/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js">
    <title><?php echo $title; ?></title>
    <link rel="icon" href="../images/mta.jpg">
  </head>
  <body class="default">
    <?php include 'include/header.php'; ?>
    <div class="container-fluid">
      <div class="row">
        <?php include 'include/sidebarMenu.php'; ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-2">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">ข้อมูลส่วนตัวพนักงาน</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <!-- เพิ่มข้อมูล -->
              <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add_data">เพิ่มข้อมูล</button>
              <div class="modal fade" id="add_data" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <!-- อย่าลืมมาเปลีั่ยนชื่อไฟล์ถ้า add ข้อมูลได้-->
                  <form class="modal-content" method="post" action="resume_add_data.php" enctype="multipart/form-data">
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
                    <div class="mb-3">
                          <label>แนบรูปถ่าย</label>
                          <input type="file" name="file" class="form-control streched-link" accept="image/gif, image/jpeg, image/png">
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                      <button type="submit" name="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            </div>
          </div>
          <?php echo $check_submit;?>
          <div class="card mt-3">
          <div class="card-body">
          <table class="table table-hover table-bordered mb-0 mt-3" id="datatables"> <!-- table-sm -->
            <thead>
              <tr class="table-primary">
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
                  <td><?php echo $result['pos_name']; ?></td> 
                  <td><img style="width:100px; height:100px;" src="<?php echo $result['file'];?>"></td> 
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
                $num++;
              }
                ?>
            </tbody>
          </table>
        </main>
      </div>
    </div>
  <script type="text/javascript" src="../assets/jquery/jquery-slim.min.js"></script>
  <script type="text/javascript" src="../assets/popper/popper.min.js"></script>
  <script type="text/javascript">
    $(document).ready( function () {
        $('#datatables').DataTable();
    } );
  </script>
  <script type="text/javascript" src="../assets/DataTables/datatables.min.js"></script>
  <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <?php mysqli_close($Connection); ?>
  </body>
</html>
