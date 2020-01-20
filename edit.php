<?php
$file_name=$_GET['name'];
$file_read=fopen($file_name,"r");
$content=fread($file_read,filesize($file_name));
fclose($file_read);


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
        <textarea name="edit" cols="100" rows="20"><?php echo $content; ?></textarea>
        <p>
        <input type="hidden" name="file_name" value="<?php echo $file_name; ?>">
        <input type="submit" value="Save">

    </form>
</body>

</html>