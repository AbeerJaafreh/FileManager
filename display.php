<?php
$img=$_GET['display'];
// echo $img;
echo ' <img src="data:image/png;base64,'.base64_encode(file_get_contents($img)).'" />';

?>