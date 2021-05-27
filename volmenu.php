<?php
session_start();
if (!isset($_SESSION['id'])){
    echo "<script>alert('MissingValue!'); window.location.href='homepage.html';</script>";
}
else{
    $id = $_SESSION["id"];
}
?>
<!DOCTYPE html>
    <html>
        <head>
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <title>Menu Cards</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet'>
            <link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
            <link href='csspages/boot-transit.css' rel='stylesheet'>
            <link href='csspages/userlogin.css' rel='stylesheet'>

            <style> @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

 * {
     margin: 0;
     padding: 0;
     box-sizing: border-box;
     font-family: 'Poppins', sans-serif
 }

 body {
     min-height: 100vh;
     background: linear-gradient(to bottom, #000428, #004683)
 }

 .container {
     margin-top: 100px
 }

 .container .row .col-lg-4 {
     display: flex;
     justify-content: center
 }

 .card {
     position: relative;
     padding: 0;
     margin: 0 !important;
     border-radius: 20px;
     overflow: hidden;
     max-width: 360px;
     max-height: 400px;
     cursor: pointer;
     border: none;
     box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2)
 }

 .card .card-image {
     width: 100%;
     max-height: 340px
 }

 .card .card-image img {
     width: 100%;
     max-height: 340px;
     object-fit: cover
 }

 .card .card-content {
     position: absolute;
     bottom: -180px;
     color: #000;
     font-weight: bold;
     background: rgba(255, 255, 255, 0.2);
     backdrop-filter: blur(15px);
     min-height: 140px;
     width: 100%;
     transition: bottom .4s ease-in;
     box-shadow: 0 -10px 10px rgba(255, 255, 255, 0.1);
     border-top: 1px solid rgba(255, 255, 255, 0.2)
 }

 .card:hover .card-content {
     bottom: 0px
 }

 .card:hover .card-content h4,
 .card:hover .card-content h5 {
     transform: translateY(10px);
     opacity: 1
 }

 .card .card-content h4,
 .card .card-content h5 {
     font-size: 1.1rem;
     
     letter-spacing: 3px;
     text-align: center;
     transition: 0.8s;
     font-weight: 500;
     opacity: 0;
     transform: translateY(-40px);
     transition-delay: 0.2s
 }

 .card .card-content h5 {
     transition: 0.5s;
     font-weight: 200;
     font-size: 0.8rem;
     letter-spacing: 2px
 }

 .card .card-content .social-icons {
     list-style: none;
     padding: 0
 }

 .card .card-content .social-icons li {
     margin: 10px;
     transition: 0.5s;
     transition-delay: calc(0.15s * var(--i));
     transform: translateY(50px)
 }

 .card:hover .card-content .social-icons li {
     transform: translateY(20px)
 }

 .card .card-content .social-icons li a {
     color: #fff
 }

 .card .card-content .social-icons li a span {
     font-size: 1.3rem
 }

 @media(max-width: 991.5px) {
     .container {
         margin-top: 20px
     }

     .container .row .col-lg-4 {
         margin: 20px 0px
     }
 }</style>
    <script type='text/javascript' src=''></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript'></script>
</head>

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
                <li><a href="volprofile.php" class="nav-links">My Account</a></li>
                <li><a href="med.html" class="nav-links">Medical Service</a></li>
            </ul>
        </div>

    </nav>

<div class="container">
    <div class="row">
    <?php
        include 'phppages/config.php';   

        $stmt = $db->prepare("SELECT * FROM service WHERE id>=1");
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()):
    ?>
        <div class="col-lg-3 col-sm-6 col-md-4 mb-2">
            <div class="card">
                <div class="card-header p-2">
                    <h6 style="color: #696969"><?= $row['city']?>, <?= $row['state']?></h6>
                </div>
                <div class="card-image p-1" style="width: 100%; height: 17vw; object-fit: cover;"> <img src="<?=$row['image']?>"> </div>
                <div class="card-content d-flex flex-column align-items-center p-2">
                    <h4 style="text-transform: uppercase;" ><?= $row['name']?></h4>
                    <h5 style="text-transform: lowercase;"><?= $row['service']?></h5>
                    <br>
                     <h5 style="text-transform: lowercase;"><?= $row['email']?></h5>
                     <h5><?= $row['contact']?></h5> 
                </div>

            </div>

        </div> 
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>