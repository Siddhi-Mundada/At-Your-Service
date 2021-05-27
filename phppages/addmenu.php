<?php 
    require "config.php";
    require_once "session.php";
    $s = "SELECT name,email,contact, city, state FROM vusers";
    $r = mysqli_query($db, $s);

    if (mysqli_num_rows($r) > 0) {
    while($row = mysqli_fetch_assoc($r)) {
        $name = $row["name"];
        $email = $row["email"];
        $contact = $row["contact"];
        $city = $row["city"];
        $state = $row["state"];
    }
}

    if(isset($_POST['submit'])) {
        $service = trim($_POST['service']);

        $target_dir="../img/";
        $target_file=$target_dir.basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        
        $insertQuery=$db->prepare("INSERT INTO service (name,image,email,service,contact,city,state) VALUES (?,?,?,?,?,?,?)");

        $insertQuery->bind_param("sssssss", $name, $target_file, $email, $service, $contact, $city, $state);
        $result = $insertQuery->execute();
        if($result){
            echo'<script>alert("Service Added!"); 
            window.location.href = "../addmenu.html";
            </script>';
        }
        else{
            echo'<script>alert("Service Not Added! Retry!"); 
            window.location.href = "../addmenu.html";
            </script>';
        }
    }
?>

