<?php
require_once('../connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}

$sal_id = $_POST['sal_id'];
$emp_id = $_POST['emp_id'];
$sal_base = $_POST['sal_base'];
$sal_ot = $_POST['sal_ot'];
$sal_total = $_POST['sal_total'];
$sal_date = $_POST['sal_date'];
$times = $_POST['times'];



$sal_total = $sal_base+$sal_ot;


$sql = "INSERT INTO `tb_salary`(`sal_id`, `emp_id`, `sal_base`, `sal_ot`, `sal_total`, `sal_date`, `times`) VALUES ('$sal_id','$emp_id','$sal_base','$sal_ot','$sal_total','$sal_date','$times')";
$query = mysqli_query($Connection,$sql);

header("location:salary.php?add=pass");
exit();

mysqli_close($Connection);
?>
