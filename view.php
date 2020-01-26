<?php

session_start();
$userName = $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="view.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>File Managment </title>
</head>

<body>
    <nav class=" navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="view.php">File Managment System </a>
            <form class="form-inline my-2 my-lg-0 text-secondary">
                <i class="material-icons">logout</i><a class="a text-secondary" href="logout.php">logout</a>
                <i class="material-icons">person_outline</i><a class="a text-secondary" href="">Admin </a>
            </form>
        </div>
    </nav>
    <div>
        <div class="container p-3">
            <div class="form-group float-left">
                <h4><i class="material-icons">folder_shared</i>File Manager</h4>
            </div>
            <div class="form-group float-right ">
                <button type="button" class="button btn-primary" name="create_folder" id="create_folder" onclick="openForm()">Create Folder </button>
                <button type="button" class="button btn-primary" name="upload" id="upload_file" onclick="upload()">Upload File </button>
                <button type="button" class="button btn-secondary" name="create_file" id="create_file" onclick="create()">Create File </button>
            </div>
        </div>

        <!--  -->
        <!--  -->

        <form action="create.php" method="POST">
            <div class="modal" tabindex="-1" role="dialog" id="myForm" style="display: none">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Create Folder</h5>
                            <button type="button" class="close" onclick="closeForm()" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" class="form-control" placeholder="Enter Folder Name" name="name" require> </div>
                        <div class="modal-footer">
                            <input type="submit" class=" btn-primary" value="Create Folders">
                            <button type="button" class=" btn-secondary" data-dismiss="modal" onclick="closeForm()">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form action="create_files.php" method="POST">
            <div class="modal" tabindex="-1" role="dialog" id="create" style="display: none">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Create File</h5>
                            <button type="button" class="close" onclick="closeForm3()" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" class="form-control" placeholder="Enter File Name" name="name" require> </div>
                        <div class="modal-footer">
                            <input type="submit" class=" btn-primary" value="Create Files">
                            <button type="button" class=" btn-secondary" data-dismiss="modal" onclick="closeForm3()">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="modal" tabindex="-1" role="dialog" id="upload" style="display: none">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Upload Files </h5>
                            <button type="button" class="close" data-dismiss="modal" onclick="closeForm2()" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="file" name="fileName" id="upload" class="form-control">
                            <div class="modal-footer">
                                <button type="submit" class=" btn-primary" name="uploadFile">Upload </button>
                                <button type="button" class=" btn-secondary" data-dismiss="modal" onclick="closeForm2()">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>

    </div>



    <?php
    if (isset($_GET['dir'])) {
        $path = $_GET['dir'];
    } else {
        $path =  'folder/' . $userName;
    }

    $_SESSION['path'] = $path;
    if (!file_exists($path)) {
        mkdir($path, 0777);
    }

    $myDirectory = scandir($path) or die("Unable to open file ");

    ?>
    <div class="bg-light">
        <div class="container bg-light">
            <table class=" table table-striped ">
                <thead>
                    <tr>
                        <th scope="col">Title/Name</th>
                        <th scope="col">File Type</th>
                        <th scope="col">Date Added</th>
                        <th scope="col">Manage</th>
                        <th scope="col">
                            <label class="containerCheck">
                                <input type="checkbox" disabled>
                                <span class="checkmark"></span>
                            </label>
                        </th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($myDirectory as $value) {
                        if ($value !== "." && $value !== "..") {
                            $file = $path . '/' . $value;

                            echo "
                            <tr>
                            <td>";
                            if (is_dir($file)) {
                                echo "<a href='view.php?dir=" . $path . '/' . $value . "'>$value</a> <p class='text-secondary'><i>" . $value . "</i><p></td>  
                            <td>";
                            } else {
                                echo '<a href="display.php?display=' . $path . '/' . $value . '" target="_blank">' . $value . '</a> <p class="text-secondary"><i>' . $value . '</i><p></td>  
                            <td>';
                            }

                            echo get_Type($path . '/' . $value);
                            echo "</td><td>";
                            echo get_Time($path . '/' . $value);
                            echo "</td><td>";
                            if (is_dir($file)) {
                                echo '<a href="delete_files.php?name=' . $path . '/' . $value . '" class="border-0 text-danger"><i class="ii material-icons">delete_forever</i></a>
                            <a href="view.php?dir=' . $path . '/' . $value .  '" class="border-0 text-success"><i class="ii material-icons">remove_red_eye</i></a>';
                            } else {
                                echo '<a href="delete_files.php?name=' . $path . '/' . $value . '" class="border-0 text-danger"><i class="ii material-icons">delete_forever</i></a>
                               <a  href="display.php?display=' . $path . '/' . $value . '" target="_blank"  class="border-0 text-success"><i class="ii material-icons">remove_red_eye</i></a> ';
                            }

                            echo "</td>
                            <td>
                            <label class='containerCheck'>
                                <input type='checkbox' > 
                                <span class='checkmark'></span>
                            </label> </td>
                            </tr>";
                        }
                    }
                    function get_Time($file)
                    {
                        return date("Y/m/d H:i A", filemtime($file));
                    }
                    function get_Type($file)
                    {
                        if (!is_dir($file) && pathinfo($file, PATHINFO_EXTENSION) == "txt" || pathinfo($file, PATHINFO_EXTENSION) == "pdf") {
                            $filepath = pathinfo($file, PATHINFO_EXTENSION);
                            return "TEXT" . $filepath;
                        } elseif (is_dir($file)) {
                            return "Folder";
                        } else {
                            $fType = filetype($file) . " " . pathinfo($file, PATHINFO_EXTENSION);
                            return "Image/ " . $fType;
                        }
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <footer id="sticky-footer" class="py-2 bg-dark ">
        <div class="container text-center text-white">
            Crafted at training with Sprintive
        </div>
    </footer>
</body>

</html>



<script>
    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }



    function upload() {
        document.getElementById("upload").style.display = "block";
    }

    function closeForm2() {
        document.getElementById("upload").style.display = "none";
    }

    function create() {
        document.getElementById("create").style.display = "block";

    }

    function closeForm3() {
        document.getElementById("create").style.display = "none";
    }
</script>