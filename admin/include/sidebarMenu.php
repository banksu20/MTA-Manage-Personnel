<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-3">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="bi bi-house-door"></i> แดชบอร์ด
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($menu=="profile_admin"){echo "active";} ?>" href="profile_admin_show.php">
          <i class="bi bi-person-square"></i> ข้อมูลส่วนตัวผู้ดูแลระบบ
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($menu=="profile"){echo "active";} ?>" href="profile_show.php">
          <i class="bi bi-person-square"></i> โปรไฟล์พนักงาน
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link <?php if($menu=="user"){echo "active";} ?>" href="user.php">
          <i class="bi bi-person-square "></i> ข้อมูลผู้ใช้งาน
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($menu=="resume"){echo "active";} ?>" href="resume.php">
          <i class="bi bi-person-square"></i> ข้อมูลส่วนตัวพนักงาน
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($menu=="salary"){echo "active";} ?>" href="salary.php">
          <i class="bi bi-calculator"></i> ตารางเงินเดือน
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($menu=="calendar"){echo "active";} ?>" href="calendar.php">
          <i class="bi bi-calendar-event"></i> บันทึกลาหยุดพนักงาน
        </a>
      </li>
    </ul>
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>Home Page</span>
      <i class="bi bi-gear-wide-connected"></i>
    </h6>
    <ul class="nav flex-column mb-2">
      <li class="nav-item">
        <a class="nav-link" href="../index.php">
          <i class="bi bi-box-arrow-left"></i> ออกจากระบบหลังบ้าน
        </a>
      </li>
    </ul>
  </div>
</nav>
