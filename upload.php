<?php


if (isset($_FILES['fileName'])) {
    $errors = array();
    $file_name = $_FILES['fileName']['name'];
    $file_size = $_FILES['fileName']['size'];
    $file_tmp = $_FILES['fileName']['tmp_name'];
    $file_type = $_FILES['fileName']['type'];
    // $file_ext=strtolower(end(explode('.',$_FILES['fileName']['name'])));

    // $extensions= array("jpeg","jpg","png");

    // if(in_array($file_ext,$extensions)=== false){
    //    $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    // }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, $file_name);
        echo "<SCRIPT type='text/javascript'> 
       alert('File Upload Successfully ');
       window.location.replace('view.php');
       </SCRIPT>";
    } else {
        print_r($errors);
    }
}
