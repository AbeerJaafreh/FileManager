<?php
session_start();
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
            <a class="navbar-brand" href="#">File Managment System </a>
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
    $path = getcwd();
    $myDirectory = opendir($path) or die("Unable to open file ");
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
                    while ($file = readdir($myDirectory)) {
                        if ($file == '.' || $file == '..' || pathinfo($file, PATHINFO_EXTENSION) == "php" || pathinfo($file, PATHINFO_EXTENSION) == "xml")
                            continue;
                        $fDate = date("Y/m/d H:i A", filemtime($file));
                        $path = pathinfo($file, PATHINFO_EXTENSION);
                        $fType = filetype($file) . " " . pathinfo($file, PATHINFO_EXTENSION);
                        echo "
                    <tr>
                    ";
                        if (!is_dir($file) && pathinfo($file, PATHINFO_EXTENSION) == "txt" || pathinfo($file, PATHINFO_EXTENSION) == "pdf") {
                            echo "
                            <td><a href='$file'>$file</a> <p class='text-secondary'><i> $file</i><p></td>  
                            <td>TEXT/$path</td>
                            <td>$fDate</td>
                            <td>
                            <a href='$file'  target='_blank' class='border-0 text-success' download><i class='ii material-icons'>remove_red_eye</i></a> 
                            <a href='delete_files.php?name=$file' class='border-0 text-danger'><i class='ii material-icons'>delete_forever</i></a>
                            </td>
                            <td>
                            <label class='containerCheck'>
                                <input type='checkbox' > 
                                <span class='checkmark'></span>
                            </label> 
                            </td>
                            </tr>";
                        } elseif (is_dir($file)) {
                            echo "
                            <td><i class=' material-icons text-secondary'>folder_open </i><a href='view_folder.php?name=$file' class='fo'> $file</a></td>  
                            <td>Folder</td>
                            <td>$fDate</td>
                            <td>
                            <a href='view_folder.php?name=$file' target='_blank' class='border-0 text-success'><i class='ii material-icons'>remove_red_eye</i></a> 
                            <a href='delete_files.php?name=$file' class='border-0 text-danger'><i class='ii material-icons'>delete_forever</i></a>
                            </td>
                            <td>
                            <label class='containerCheck'>
                                <input type='checkbox' > 
                                <span class='checkmark'></span>
                            </label> 
                            </td>
                            </tr>";
                        } else {
                            echo "
                            <td><a href='$file'>$file</a> <p class='text-secondary'><i> $file</i><p></td>  
                            <td>Image/$path</td>
                            <td>$fDate</td>
                            <td>                        
                            <a href='$file' target='_blank'  class='border-0 text-success' download><i class='ii material-icons'>remove_red_eye</i></a> 
                            <a href='delete_files.php?name=$file' class='border-0 text-danger'><i class='ii material-icons'>delete_forever</i></a>
                            <td>
                            <label class='containerCheck'>
                                <input type='checkbox' > 
                                <span class='checkmark'></span>
                            </label> 
                            </td>
                            </td>
                            </tr>";
                        }
                    }
                    closedir($myDirectory);

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