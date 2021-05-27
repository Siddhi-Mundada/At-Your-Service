<?php
	$db = mysqli_connect('localhost','root',"",'ays');
    if($db->connect_error){
        die("Connection Failed!".$db->connect_error);
    }
?>