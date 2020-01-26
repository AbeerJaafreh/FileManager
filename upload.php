<?php
session_start();
$userName = $_SESSION['username'];
$path=$_SESSION['path'];
// echo $path;
if (isset($_FILES['fileName'])) {
    $errors = array();
    $file_name = $_FILES['fileName']['name'];
    $file_size = $_FILES['fileName']['size'];
    $file_tmp = $_FILES['fileName']['tmp_name'];
    $file_type = $_FILES['fileName']['type'];
  
    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, $path.'/'.$file_name);
        echo "<SCRIPT type='text/javascript'> 
       alert('File Upload Successfully ');
       </SCRIPT>";
       header('location:view.php'.'/'.$path);
    } else {
        print_r($errors);
    }
}
