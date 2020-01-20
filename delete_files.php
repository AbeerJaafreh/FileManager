<?php

$file = $_GET['name'];

if (!is_dir($file)) {
    unlink($file);
    echo "<SCRIPT type='text/javascript'> 
    alert('File Deleted successfully');
    window.location.replace('view.php');
    </SCRIPT>";
} else {
    rmdir($file);
    echo "<SCRIPT type='text/javascript'> 
    alert(' Folder Deleted successfully');
    window.location.replace('view.php');
    </SCRIPT>";
}
