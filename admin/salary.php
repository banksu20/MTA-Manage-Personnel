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


$sql = "SELECT tb_salary.* FROM tb_employee, tb_salary WHERE tb_employee.emp_id = tb_salary.emp_id;";
$query = mysqli_query($Connection,$sql);

$count = mysqli_num_rows($query);
$order = 1;


?>

<!-- รหัสข้อมูล (id)
รหัสข้อมูลสมาชิก(user_id)
เงินเดือนประจำ(s_regular)
เงินค่าล่วงเวลา(s_ot)
เงินค่าสวัสดิการ(s_welfare)
รวมเงิน(s_total) อย่าลืมทำแก้ฐานข้อมูลแล้วก็แก้โค้ด-->
<!doctype html>
<html lang="en">
<?php $menu = "salary";?>
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
      <div class="row">
        <?php include 'include/sidebarMenu.php'; ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">เงินเดือนพนักงาน</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
           
              <!-- เพิ่มข้อมูล -->
              <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add_data">เพิ่มข้อมูล</button>
              
              <div class="modal fade" id="add_data" tabindex="-1" aria-hidden="true">
                
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <form class="modal-content" method="post" action="salary_add_data.php">
                    <div class="modal-header">
                      <h5 class="modal-title">ข้อมูลเงินเดือน</h5>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label class="form-label">รหัสพนักงาน</label>
                        <select name="emp_id" class="form-control" id="">
                        <?php
                            $sql_status = $Connection->query("SELECT emp_id FROM tb_employee");
                            while($row = mysqli_fetch_array($sql_status)){
                        ?>
                            <option value="<?php echo $row['emp_id'] ?>"><?php echo $row['emp_id'] ?></option>
                        <?php
                            }
                        ?>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">เงินเดือน</label>
                        <input type="integer" class="form-control" name="sal_base"  required/>  
                      </div>
                      <div class="mb-3">
                        <label class="form-label">เงินล่วงเวลา</label>
                        <input type="integer" class="form-control" name="sal_ot"  required/>  
                      </div>
                      <div class="mb-3">
                        <label class="form-label">วัน/เดือน/ปี</label>
                        <input type="date" class="form-control" name="sal_date" required/>  
                      </div>
                      <div class="mb-3">
                        <label class="form-label">ครั้งที่ออกเงินเดือน</label>
                        <input type="text" class="form-control" name="times" required/>  
                      </div>
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                      <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
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
                <th scope="col">รหัสพนักงาน</th>
                <th scope="col">เงินเดือนประจำ</th>
                <th scope="col">เงินล่วงเวลา</th>
                <th scope="col">เงินเดือนสุทธิ</th>
                <th scope="col">วันที่ออกเงินเดือน</th>
                <th scope="col">จำนวนครั้งที่ออกเงินเดือน</th>
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
                  <td><?php echo $result['sal_base']; ?></td>                                                                                                                                           
                  <td><?php echo $result['sal_ot']; ?></td>
                  <td><?php echo $result['sal_total']; ?></td>           
                  <td><?php echo $result['sal_date']; ?></td>           
                  <td><?php echo $result['times']; ?></td>           
                  <td>
                    <!-- ปุ่มแก้ไข -->
                    <!-- ทำไฟล์ แก้ไข resume_edit-->
                    <button type="button" class="btn btn-success btn-sm" onclick="window.location.href='salary_edit.php?id=<?php echo $result['sal_id'];?>'"><i class="bi bi-pencil-square"></i></button>
                    <!-- ลบข้อมูล-->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_data<?php echo $result['sal_id']; ?>">
                      <i class="bi bi-trash"></i>
                    </button>
                    <div class="modal fade" id="delete_data<?php echo $result['sal_id']; ?>" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">ลบข้อมูล</h5>
                          </div>
                          <div class="modal-body">
                            กดยืนยันหากคุณต้องการลบผู้ใช้ <?php echo $result['sal_id']; ?>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button type="button" class="btn btn-primary" onclick="window.location.href='salary_delete.php?id=<?php echo $result['sal_id'];?>'">ยืนยัน</button>
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
