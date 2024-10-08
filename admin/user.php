<?php
require_once('../connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}elseif ($_SESSION["user_level"] != "admin") {
  header("location:../index.php");
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

$sql = "SELECT * FROM tb_user ORDER BY user_level DESC";
$query = mysqli_query($Connection,$sql);
?>
<!doctype html>
<html lang="en">
<?php $menu="user";?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/icons/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="../assets/DataTables/datatables.min.css"/>
    <link rel="stylesheet" href="assets/dashboard.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title><?php echo $title; ?></title>
    <link rel="icon" href="../images/mta.jpg">
  </head>
  <body class="default">
    <?php include 'include/header.php'; ?>
    <div class="container-fluid">
      <div class="row justify-content-md-center">
        <?php include 'include/sidebarMenu.php'; ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            
            <h3>ข้อมูลผู้ใช้งาน <span class="badge badge-info"><i class="bi bi-file-earmark-person"></i></span></h3>
            
            <div class="btn-toolbar mb-2 mb-md-0">
              <!-- เพิ่มข้อมูล -->
              
              <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add_data">เพิ่มข้อมูล</button>
              
              <div class="modal fade" id="add_data" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <form class="modal-content" method="post" action="user_add_data.php">
                    <div class="modal-header">
                      <h5 class="modal-title">เพิ่มข้อมูลผู้ใช้งาน</h5>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label class="form-label">ชื่อผู้ใช้</label>
                        <input type="text" class="form-control" name="user_username" required/>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">รหัสผ่าน</label>
                        <input type="password" class="form-control" name="user_password" required/>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">ชื่อ</label>
                        <input type="text" class="form-control" name="user_name" required/>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">นามสกุล</label>
                        <input type="text" class="form-control" name="user_surname" required/>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">อีเมล (ไม่จำเป็นต้องกรอกข้อมูลช่องนี้)</label>
                        <input type="email" class="form-control" name="user_email"/>
                      </div>
                      <div>
                        <label class="form-label">ระดับผู้ใช้</label>
                        <select class="form-select" name="user_level">
                          <option value="admin">ผู้ดูแลระบบ</option>
                        </select>
                      </div>
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
          <?php echo $check_submit;?>
          <div class="card mt-3">
          <div class="card-body">
          <table class="table table-hover table-bordered mb-0 mt-3" id="datatables"> <!-- table-sm -->
            <thead>
              <tr class="table-primary">
                <th scope="col" width="65px">ลำดับที่</th>
                <th scope="col">ชื่อผู้ใช้</th>
                <th scope="col" width="130px">รหัสผ่าน</th>
                <th scope="col">ขื่อ</th>
                <th scope="col">นามสกุล</th>
                <th scope="col">อีเมล</th>
                <th scope="col">ระดับผู้ใช้</th>
                <th scope="col" width="90px">ตัวเลือก</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($result = mysqli_fetch_array($query)) {
                ?>
                <tr>
                  <th scope="row"><?php echo $num++; ?></th>
                  <td><?php echo $result['user_username']; ?></td>
                  <td>
                    <!-- เปลี่ยนรหัสผ่าน -->
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit_password<?php echo $result['user_id']; ?>">
                      เปลี่ยนรหัสผ่าน
                    </button>
                    <div class="modal fade" id="edit_password<?php echo $result['user_id']; ?>" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <form class="modal-content" method="post" action="user_edit_password.php">
                          <div class="modal-header">
                            <h5 class="modal-title">เปลี่ยนรหัสผ่านผู้ใช้ ID : <?php echo $result['user_id']; ?></h5>
                          </div>
                          <div class="modal-body">
                            <div>
                              <label class="form-label">รหัสผ่านใหม่</label>
                              <input type="password" class="form-control" name="user_password" required/>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                          </div>
                          <input type="hidden" name="id" value="<?php echo $result['user_id']; ?>"/>
                        </form>
                      </div>
                    </div>
                  </td>
                  <td><?php echo $result['user_name']; ?></td>
                  <td><?php echo $result['user_surname']; ?></td>
                  <td><?php echo $result['user_email']; ?></td>
                  <td><?php if ($result['user_level'] == "admin") {echo "ผู้ดูแลระบบ";}?></td>
                  <td>
                    <!-- ปุ่มแก้ไข -->
                    <button type="button" class="btn btn-success btn-sm" onclick="window.location.href='user_edit.php?id=<?php echo $result['user_id'];?>'"><i class="bi bi-pencil-square"></i></button>
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
                            กดยืนยันหากคุณต้องการลบผู้ใช้ <?php echo $result['user_username']; ?>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button type="button" class="btn btn-primary" onclick="window.location.href='user_delete.php?id=<?php echo $result['user_id'];?>'">ยืนยัน</button>
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
