<?php
require_once('../connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}

$emp_id = $_POST['emp_id'];
$emp_name = $_POST['emp_name'];
$emp_sex = $_POST['emp_gender'];
$emp_date = $_POST['emp_date'];
$emp_age = $_POST['emp_age'];
$emp_race = $_POST['emp_race'];
$emp_nation = $_POST['emp_nation'];
$emp_rel = $_POST['emp_religion'];
$emp_add = $_POST['emp_address'];
$emp_tel = $_POST['emp_tel'];
$emp_id_card = $_POST['emp_id_card'];
$emp_status = $_POST['emp_status'];
$emp_pos = $_POST['pos_id'];
$file = $_FILES['file'];

$fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];
        $fileSize = $_FILES['file']['size'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg','jpeg','png','pdf');
        if(in_array($fileActualExt, $allowed)){
            if($fileError == 0){
                if($fileSize < 10000000000){
                    $fileNameNew = uniqid('',true).".".$fileActualExt;
                    $fileDestination = '../images/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    $sql = $Connection->query("INSERT INTO tb_employee VALUES ('','$emp_id','$emp_name','$emp_sex','$emp_date','$emp_age','$emp_race','$emp_nation','$emp_rel','$emp_add','$emp_tel','$emp_id_card','$emp_status','$emp_pos','$fileDestination')");                

                }else{
                    echo "Your file is too big!";
                }
            }else{
                echo "There was an Error uploading your file!";
            }
        }else{
            echo "You cannot upload file of this type!";
        }
      
header("location:resume.php?add=pass");
exit();

mysqli_close($Connection);
?>
