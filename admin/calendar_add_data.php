<?php
require_once('../connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}elseif ($_SESSION["user_level"] != "admin") {
  header("location:../index.php");
  exit();
}

$sql = "INSERT INTO tb_calendar (`cal_id`,`emp_id`, `start_date`, `end_date`, `times`, `approved_date`) VALUES ('".$_POST["cal_id"]."','".$_POST["emp_id"]."','".($_POST["start_date"])."','".$_POST["end_date"]."','".$_POST["times"]."','".$_POST["approved_date"]."')";
$query = mysqli_query($Connection,$sql);

header("location:calendar.php?add=pass");
exit();

mysqli_close($Connection);
?>
