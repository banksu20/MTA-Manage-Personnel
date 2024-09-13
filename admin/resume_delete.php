<?php
require_once('../connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}

$id = $_GET["id"];
$sql = "DELETE FROM tb_employee WHERE user_id = '".$id."' ";
$query = mysqli_query($Connection,$sql);

if (mysqli_affected_rows($Connection)) {
  header("location:resume.php?delete=pass");
  exit();
}

mysqli_close($Connection);
?>
