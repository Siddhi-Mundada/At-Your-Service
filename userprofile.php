<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="stylesheet" type="text/css" href="csspages/boot-transit.css">
        <link rel="stylesheet" type="text/css" href="csspages/userlogin.css">
        <title>User Profile</title>
        <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'>
        <link href='' rel='stylesheet'>
        <style>@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box
}

body {
    font-family: 'Poppins', sans-serif;
    background-image: url("images/phpback/b15.jpg");
    background-repeat: no-repeat;
    background-size: cover;
}

.wrapper {
    padding: 40px 60px;
    border: 1px solid #ddd;
    border-radius: 15px;
    margin: 10px auto;
    max-width: 600px;
    position: relative;
    top: 15%;
    left: 2%;

}

h4 {
    letter-spacing: -1px;
    font-weight: 400
}

.img {
    width: 70px;
    height: 70px;
    border-radius: 6px;
    object-fit: cover
}

#img-section p,
#deactivate p {
    font-size: 12px;
    color: #777;
    margin-bottom: 10px;
    text-align: justify
}

#img-section b,
#img-section button,
#deactivate b {
    font-size: 14px
}

label {
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 500;
    color: #777;
    padding-left: 3px
}

.form-control {
    border-radius: 10px
}

input[placeholder] {
    font-weight: 500
}

.form-control:focus {
    box-shadow: none;
    border: 1.5px solid #0779e4
}

select {
    display: block;
    width: 100%;
    border: 1px solid #ddd;
    border-radius: 10px;
    height: 40px;
    padding: 5px 10px
}

select:focus {
    outline: none
}

.button {
    background-color: #fff;
    color: #000
}

.button:hover {
    background-color: #0779e4;
    color: #fff
}

.btn-primary {
    background-color: #0779e4
}

.danger {
    background-color: #fff;
    color: #e20404;
    border: 1px solid #ddd
}

.danger:hover {
    background-color: #e20404;
    color: #fff
}

@media(max-width:576px) {
    .wrapper {
        padding: 25px 20px;
        margin: 50px;
        left: 0%;
    }

    #deactivate {
        line-height: 18px
    }
}</style>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript'></script>

</head>

<?php
    include 'phppages/config.php';
    session_start();
    if (!isset($_SESSION['id']))
    {
        echo "<script>alert('Please login!'); window.location.href='userlogin.php';</script>";
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
                <li><a href="menu.php" class="nav-links">Menu</a></li>
                <li><a href="med.html" class="nav-links">Medical Service</a></li>
            </ul>
        </div>

    </nav>

<div class="wrapper bg-white mt-sm-5">
    <h4 class="pb-4 border-bottom">My Profile</h4>
    <form method="post" action="phppages/userupdate.php">
<?php

    $sql = "SELECT id, username, email, contact FROM users WHERE id=$id";
    $result = $db-> query($sql);

    if ($result-> num_rows>0) {
        while ($row = $result -> fetch_assoc()) {

?>
    <div class="py-2">
        <div class="row py-2">
            <div class="col-md-12"> 
                <label for="firstname">Username</label> 
                <input type="text" class="bg-light form-control" name="username" value="<?php echo $row['username'] ?>" required> 
            </div>
        </div>
        <div class="row py-2">
            <div class="col-md-6"> 
                <label for="email">Email Address</label> 
                <input type="email" class="bg-light form-control" name="email" value="<?php echo $row['email'] ?>" required> 
            </div>

            <div class="col-md-6 pt-md-0 pt-3"> 
                <label for="phone">Contact</label> 
                <input type="tel" class="bg-light form-control" name="contact" value="<?php echo $row['contact'] ?>" required> 
            </div>
        </div>
        <div class="py-3 pb-4 border-bottom">
            <input type="submit" name="submit" class="btn btn-primary mr-3" value="Save Changes">
        </div>
        <div class="d-sm-flex align-items-center pt-3" id="deactivate">
            <div> <b>Want to Logout?</b>
            </div>
            <div class="ml-auto"> 
                <input type="submit" name="logout" class="btn danger" value="Logout">
                <!-- <a href="vollogout.php"><button class="btn danger">Logout</button></a> -->
            </div>

        </div>
    </div>
</form>
    <?php    
    }
        }
        else {
            echo "No result!";
        }
        $db-> close();
    ?>
</div>
<script src="javapages/boot-transit.js"></script>
<br>
<?php include("footer.html"); ?>        
</body>
</html>
