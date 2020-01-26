<?php
$curDir = $_GET['name'];
// echo $curDir;
if (!is_dir($curDir)) {
    try {
        unlink($curDir);
        echo "<SCRIPT type='text/javascript'> 
        alert('File Deleted successfully');
        </SCRIPT>";
        // $pathArr = explode('/', $curDir);
        // end($pathArr);
        // $newPath = implode('/', $pathArr);
        header('location:view.php');
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    try {
        deleteDirectory($curDir);
        // rmdir($curDir);
        echo "<SCRIPT type='text/javascript'> 
        alert(' Folder Deleted successfully');
        </SCRIPT>";
        header('location:view.php');
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function deleteDirectory($Path) {
    if (is_dir($Path)) {
        $folders = scandir($Path);
        foreach ($folders as $folder) {
            if ($folder != "." && $folder !="..") {
                if (filetype($Path . DIRECTORY_SEPARATOR . $folder) == "dir") {
                    deleteDirectory($Path . DIRECTORY_SEPARATOR . $folder);
                } else {
                    unlink($Path . DIRECTORY_SEPARATOR . $folder);
                }
            }
        }
    reset($folders);
    rmdir($Path);
    }
}
?>