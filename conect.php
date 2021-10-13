<?php
	//Подключение к БД
    $connection = mysqli_connect('localhost','root','root','sport');
    if (!$connection) {echo mysqli_connect_error();  exit();}
?>
