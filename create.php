<?php
session_start();
$userName = $_SESSION['username'];
$path=$_SESSION['path'];
// echo $path;
$dir=$_POST['name'];

mkdir($path.'/'.$dir,777);
$newURL= $path.'/'.$dir;
// echo $path;
// header('location: view.php?='.$newURL);

echo "<SCRIPT type='text/javascript'> 
alert('Folder Created Successfully ');
window.location.replace('view.php?='.$newURL);
</SCRIPT>";
header('location:view.php');
?>
