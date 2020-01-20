<?php

$file_name = $_GET['name'];
echo $file_name;
$dir_path = $file_name . "/";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<title><?php $file_name ?></title>
</head>

<body>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Title/Name</th>
                <th scope="col">Manage</th>

            </tr>
        </thead>
        <tbody>
            <?php
            if (is_dir($dir_path)) {
                $subDir = opendir($dir_path) or die("Unable to open file ");
                {
                    if ($subDir) {
                        while (($file = readdir($subDir)) !== false) {
                            if ($file == '.' || $file == '..' || pathinfo($file, PATHINFO_EXTENSION) == "php" || pathinfo($file, PATHINFO_EXTENSION) == "xml") {
                                continue;
                            }
                            
                            echo "
                            <tr>
                            <td><a href='$file'>$file</a></td>";
                            if (!is_dir($file) && pathinfo($file, PATHINFO_EXTENSION) == "txt") {
                                echo "
                            <td>
                            <a href='delete_files.php?name=$file' class='border-0 text-danger'><i class='material-icons'>delete_forever</i></a>
                            <a href='$file' class='border-0 text-success'><i class='material-icons'>remove_red_eye</i></a> 
        
                            </td>
                            </tr>";
                            } elseif (is_dir($file)) {
                                echo "
                                <td>
                                <a href='delete_files.php?name=$file' class='border-0 text-danger'><i class='material-icons'>delete_forever</i></a>
                                <a href='view_folder.php?name=$file' target='_blank' class='border-0 text-success'><i class='material-icons'>remove_red_eye</i></a> 
        
                                </td>
                                </tr>";
                            } else {
                                echo "
                                <td>
                                <a href='delete_files.php?name=$file' class='border-0 text-danger'><i class='material-icons'>delete_forever</i></a>
                                <a href='$file' target='_blank' class='border-0 text-success'><i class='material-icons'>remove_red_eye</i></a> 
        
                                </td>
                                </tr>";
                            }
                        }
                    }
                }
            }

            ?>
        </tbody>
    </table>

</body>

</html>