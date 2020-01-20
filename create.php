<?php
$dir=$_POST['name'];
mkdir($dir,777);
echo "<SCRIPT type='text/javascript'> 
alert('Folder Created Successfully ');
window.location.replace('view.php');
</SCRIPT>";
?>