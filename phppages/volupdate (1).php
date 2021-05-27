<?php
include("config.php");
include("session.php");
$id = $_SESSION['id'];
if (isset($_POST['submit'])) {
$sql = "UPDATE vusers SET name='$_POST[name]', email='$_POST[email]', contact='$_POST[contact]', address='$_POST[address]', city='$_POST[city]', state= '$_POST[state]' WHERE id=$id;";
if (!mysqli_query($db, $sql)) {
    die('Error: '.mysqli_error($db));
}

echo'<script>alert("Your details have been updated successfully!"); 
window.location.href = "../volprofile.php";
</script>';
}
if (isset($_POST['logout'])){
    session_destroy();
    echo'<script>alert("You are logged out successfully!"); 
    window.location.href = "../vollogin.php";
    </script>';
    exit();
}
mysqli_close($db);
?>