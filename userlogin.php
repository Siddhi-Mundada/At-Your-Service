<?php
    require_once "phppages/config.php";
    require_once "phppages/session.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $errors = array();
        // validation
        if (empty($email)) {
            $errors['email'] = "Email required";
        }
        if (empty($password)) {
            $errors['password'] = "Password required";
        }


        if (count($errors)===0) {
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
            if($user===NULL){
                $errors['login_fail']= "Wrong credentials";
            }
            else{
                if(password_verify($password, $user['password'])) {
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['email'] = $user['email'];
                    // flash message
                    $_SESSION['message'] = "You are now logged in!";
                    $_SESSION['alert-class'] = "alert-success";
                    header('location: menu.php'); 
                    exit();
                } 
                else{
                    $errors['login_fail']= "Wrong credentials";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <link rel="stylesheet" type="text/css" href="csspages/userlogin.css">
        <link rel="stylesheet" type="text/css" href="csspages/boot-transit.css">
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>User Login</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet'>

        <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js'>
        </script>
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
                <li><a href="homepage.html" class="nav-links">Home</a></li>
                <li><a href="aboutpage.html" class="nav-links">About</a></li>
                <li><a href="vollog.php" class="nav-links">Volunteer Login</a></li>
                <li><a href="contact.html" class="nav-links">Contact Us</a></li>
            </ul>
        </div>

    </nav>

<div class="container d-flex justify-content-center align-items-center">
    <div class="card">
        <div class="row">
            <div class="col-md-6">
                <div class="text-center mt-5"> <img src="images/phpback/s3.png" width="300"> </div>
            </div>
            <div class="col-md-6">
                <div class="form">
                <form action="" method="post">
                    <h2>Login</h2>
                    <div class="inputbox mt-3"> <span>Email</span> <input type="text" placeholder="janewang@company.com" name="email" class="form-control"> </div>
                    <div class="inputbox mt-3"> <span>Password</span> <input type="password" placeholder="Password" name="password" class="form-control"> </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-right">
                            <input type="submit" name="submit" value="Login" class="btn btn-success register btn-block">
                        </div> 
                        <a href="usersignup.php" class="login">Register</a>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
  <script src="javapages/boot-transit.js"></script>
<?php include("footer.html"); ?>    
</body>
</html>