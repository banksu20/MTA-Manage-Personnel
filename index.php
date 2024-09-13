<?php
require_once('connections/mysqli.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/icons/bootstrap-icons.css">
  <link rel="stylesheet" href="main.css">
</head>
<body class="default">
  <?php include 'includes/navbar.php';?>
  <div class="text-center">
  <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="img-page">
      <img src="images/mta.jpg"  alt="">
    </div>
</div>
</div>
  <div class="container-fluid">
    <div class="row justify-content-md-center">
      <div class="col-md-8 py-4">
        <?php
        if (isset($_POST['submit'])) {
          $num = 1;
          $sql = "SELECT * FROM tb_user WHERE ".$_POST['select']." LIKE '".$_POST['value']."%'";
          $query = mysqli_query($Connection,$sql);
          $check_data = mysqli_num_rows($query);
          if ($check_data == 0) {
            echo '<p class="text-center py-4"><span class="badge bg-danger" style="font-size: 20px;">ไม่พบข้อมูล</span></p>';
          }else{
            ?>
             <table class="table table-hover table-bordered mb-0" id="datatables"> <!-- table-sm -->
            <thead>
              <tr class="table-info">
                <th scope="col" width="65px">ลำดับที่</th>
                <th scope="col">ชื่อผู้ใช้</th>
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
                    <td><?php echo $num++; ?></td>
                    <td><?php echo $result['user_username']; ?></td>
                    <td><?php echo $result['user_name'];?></td>
                    <td><?php echo $result['user_surname'];?></td>
                    <td><?php echo $result['user_email']; ?></td>
                    <td><?php if ($result['user_level'] == "member") {echo "พนักงาน";}else{echo "ผู้ดูแลระบบ";} ?></td>
                    <td>
                    <!-- ปุ่มแก้ไข -->
                    <button type="button" class="btn btn-success btn-sm" onclick="window.location.href='../user_edit.php?id=<?php echo $result['user_id'];?>'"><i class="bi bi-pencil-square"></i></button>
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
                }
                ?>
              </tbody>
            </table>
            <?php
          }
        }
        ?>
      </div>
    </div>
  </div>
  
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  
  <?php mysqli_close($Connection);?>
</body>
</html>
