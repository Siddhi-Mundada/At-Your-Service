<!DOCTYPE html>
                        <html>
                            <head>
                                <meta charset='utf-8'>
                                <link rel="stylesheet" type="text/css" href="csspages/boot-transit.css">
                                <link rel="stylesheet" type="text/css" href="csspages/userlogin.css">
                                <meta name='viewport' content='width=device-width, initial-scale=1'>
                                <title>Volunteer Profile</title>
                                <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' rel='stylesheet'>
                                <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
                                <style>body { 
    background-image: url("images/phpback/b15.jpg");
    background-repeat: no-repeat;
    background-size: cover;
}

.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: #000000;
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}</style>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript'></script>
    </head>
<?php
    include 'phppages/config.php';
    session_start();
    if (!isset($_SESSION['id']))
    {
        echo "<script>alert('Please login!'); window.location.href='vollogin.php';</script>";
    }else{
    $id=$_SESSION['id'];
    }
?>
    <body oncontextmenu='return false' class='snippet-body'>
        
    <nav class="navbar">
        <div class="logo"><img src="images/logo-black.png" height="105" width="135" ></div>
        <a href="#" class="toggle-button">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </a>
        <div class="navbar-items">
            <ul>
                <li><a href="volmenu.php" class="nav-links">Menu</a></li>
                <li><a href="med.html" class="nav-links">Medical Service</a></li>
                <li><a href="addmenu.html" class="nav-links">Add Service</a></li>
                <li><a href="vollogout.php" class="nav-links">Logout</a></li>
            </ul>
        </div>

    </nav>

    
    <div class="container rounded bg-white mt-5">
    <div class="row">
        <div class="col-md-4 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" src="images/phpback/profile.png" width="170">
               </div>
        </div>
        <div class="col-md-8">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <form method="post" action="phppages/volupdate.php">
                    <h6 class="text-right">Edit Profile</h6>
                </div>
                <?php

                    $sql = "SELECT * FROM vusers WHERE id=$id";
                    $result = $db-> query($sql);

                    if ($result-> num_rows>0) {
                    while ($row = $result -> fetch_assoc()) {

                ?>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name']?>" required >
                    </div>
                   
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="email" value="<?php echo $row['contact']?>" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="contact" value="<?php echo $row['contact']?>" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><input type="text" class="form-control" name="address" value="<?php echo $row['address']?>" required></div>
                    
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="city" value="<?php echo $row['city']?>" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="state" value="<?php echo $row['state']?>" required>
                    </div>
                </div>
                <div class="mt-5 text-right">
                    <input type="submit" name="submit" class="btn btn-primary profile-button" value="Save Changes">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php    
    }
        }
        else {
            echo "No result!";
        }
        $db-> close();
    ?>
</div>
</div>
<script src="javapages/boot-transit.js"></script>
<div class="dropup">
    <button class="dropbtn">Get To Know Us</button>
    <div class="dropup-content">
      <a href="aboutpage.html">About Us</a>
      <a href="volreg.html">Volunteer With Us</a>
      <a href="usersignup.html">Be Our special customers</a>
      <a href="contact.html">Contact Us</a>
    </div>
</div>

    <div class="dropup">
        <button class="dropbtn">Contact Us</button>
        <div class="dropup-content">
          <a href="#">Facebook</a>
          <a href="#">Instagram</a>
          <a href="#">Linked In</a>
        </div>
    </div>
    
</body>
</html>