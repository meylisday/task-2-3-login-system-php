<?php
$old = umask(0); 
$img = str_replace(' ', '+', $_POST['img']);
$img = base64_decode($img);
$idroom = $_GET['id_room'];
mkdir("include/rooms/".$idroom, 0777, true) || chmod("include/rooms/".$idroom, 0777) || umask($old);
$dir = 'include/rooms/'.$idroom;
$file = 'img.png';
file_put_contents($dir . "/". $file,$img);
?>