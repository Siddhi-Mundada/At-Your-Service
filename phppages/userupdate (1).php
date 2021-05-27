<?php
include("config.php");
include("session.php");
$id = $_SESSION['id'];
if (isset($_POST['submit'])) {
	$sql = "UPDATE users SET username='$_POST[username]', email='$_POST[email]', contact='$_POST[contact]' WHERE id=$id;";
	if (!mysqli_query($db, $sql)) {
    	die('Error: '.mysqli_error($db));
	}
	echo'<script>alert("Your details have been updated successfully!"); 
	window.location.href = "../userprofile.php";
	</script>';
}
if (isset($_POST['logout'])){
    session_destroy();
    echo'<script>alert("You are logged out successfully!"); 
    window.location.href = "../userlogin.php";
    </script>';
    exit();
}

mysqli_close($db);
?>