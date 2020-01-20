<?php
$preName=$_POST['name'];
$ext=".txt";
$file_name=$preName.$ext;
fopen($file_name,'w');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="edit_files.php" method="POST">
    Enter Text : <p><textarea name="edit" cols="100" rows="20"></textarea><p>
    <input type="hidden" name="file_name" value="<?php echo $file_name?>">
    <input type="submit" value="Save">
    
    </form>
</body>
</html>