
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
        $sql = "SELECT * FROM vusers WHERE email=?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
            if($user===NULL){
                $errors['login_fail']= "Wrong credentials";
            }
            else{
                if(password_verify($password, $user['password'])){
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['email'] = $user['email'];
                    // flash message
                    $_SESSION['message'] = "You are now logged in!";
                    $_SESSION['alert-class'] = "alert-success";
                    header('location: addmenu.html'); 
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
<meta name='viewport' content='width=device-width, initial-scale=1'>
<title>Login Form</title>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet'>
<link href='csspages/boot-transit.css' rel='stylesheet'>
<link href='csspages/userlogin.css' rel='stylesheet'>
<style>@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif
}

body {
    background-image: url("images/phpback/b15.jpg");
    background-repeat: no-repeat;
    background-size: 100% 100%;   
    min-height: 100vh
}

.wrapper {
    max-width: 850px;
    background-color: #fff;
    border-radius: 10px;
    position: relative;
    display: flex;
    margin: 50px auto;
    box-shadow: 0 8px 20px 0px #1f1f1f1a;
    overflow: hidden
}

.wrapper .form-left {
    background: #000;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    padding: 20px 40px;
    position: relative;
    width: 100%;
    color: #fff;
}

.wrapper h2 {
    font-weight: 700;
    font-size: 25px;
    padding: 5px 0 0;
    margin-bottom: 34px;
    pointer-events: none
}

.wrapper .form-left p {
    font-size: 0.9rem;
    font-weight: 300;
    line-height: 1.5;
    pointer-events: none
}

.wrapper .form-left .text {
    margin: 20px 0 25px
}

.wrapper .form-left p span {
    font-weight: 700
}

.wrapper .form-left input {
    padding: 15px;
    background: #fff;
    border-top-left-radius: 5px;
    border-bottom-right-radius: 5px;
    width: 180px;
    border: none;
    margin: 15px 0 50px 0px;
    cursor: pointer;
    color: #333;
    font-weight: 700;
    font-size: 0.9rem;
    appearance: unset;
    outline: none
}

.wrapper .form-left input:hover {
    background-color: #f2f2f2
}

.wrapper .form-right {
    padding: 20px 40px;
    position: relative;
    width: 100%
}

.wrapper .form-right h2 {
    color: #000000
}

.wrapper .form-right label {
    font-weight: 600;
    font-size: 15px;
    color: #666;
    display: block;
    margin-bottom: 8px
}

.wrapper .form-right .input-field {
    width: 100%;
    padding: 10px 15px;
    border: 1px solid #e5e5e5;
    border-top-left-radius: 5px;
    border-bottom-right-radius: 5px;
    outline: none;
    color: #333
}

.wrapper .form-right .input-field:focus {
    border: 3px solid #31a031
}

.wrapper .option {
    display: block;
    position: relative;
    padding-left: 30px;
    margin-bottom: 12px;
    font-size: 0.95rem;
    font-weight: 900;
    cursor: pointer;
    user-select: none
}

.wrapper .option input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0
}

.wrapper .checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 18px;
    width: 18px;
    background-color: #fff;
    border: 2px solid #ddd;
    border-radius: 2px
}

.wrapper .option:hover input~.checkmark {
    background-color: #f1f1f1
}

.wrapper .option input:checked~.checkmark {
    border: 2px solid #e5e5e5;
    background-color: #fff;
    transition: 300ms ease-in-out all
}

.wrapper .checkmark:after {
    content: "\2713";
    position: absolute;
    display: none;
    color: #000000;
    font-size: 1rem
}

.wrapper .option input:checked~.checkmark:after {
    display: block
}

.wrapper .option .checkmark:after {
    left: 2px;
    top: -4px;
    width: 5px;
    height: 10px
}

.wrapper .register {
    padding: 12px;
    background: #000000;
    border-top-left-radius: 5px;
    border-bottom-right-radius: 5px;
    width: 130px;
    border: none;
    margin: 6px 0 50px 0px;
    cursor: pointer;
    color: #fff;
    font-weight: 700;
    font-size: 15px
}

.wrapper .register:hover {
    background-color: #3785bde0
}

.wrapper a {
    text-decoration: none
}

@media (max-width: 860.5px) {
    .wrapper {
        margin: 50px 5px
    }
}

@media (max-width: 767.5px) {
    .wrapper {
        flex-direction: column;
        margin: 30px 20px
    }

    .wrapper .form-left {
        border-bottom-left-radius: 0px
    }
}

@media (max-width: 575px) {
    .wrapper {
        margin: 30px 15px
    }

    .wrapper .form-left {
        padding: 25px
    }

    .wrapper .form-right {
        padding: 25px
    }
}
</style>
<script type='text/javascript' src=''></script>
<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'></script>
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
                <li><a href="volreg.php" class="nav-links">Volunteer Registration</a></li>
                <li><a href="userlogin.php" class="nav-links">Customer Login</a></li>
                <li><a href="contact.html" class="nav-links">Contact Us</a></li>
            </ul>
        </div>

    </nav>

    <div class="wrapper" style="border: 1px solid grey";>
    <div class="form-left">
        <div class="col-md-6">
            <div class="text-center mt-5"> 
                <img src="images/phpback/s14.png" width="400"> 
            </div>
        </div>
    </div>

    <form class="form-right" action="" method="post">
        <h2 class="text-uppercase">Login form</h2>
        <div class="row">
            
    <div class="mb-3"> <label>Email</label> <input type="email" class="input-field" name="email" placeholder="Your Mail..."> </div>
     <div class="mb-3"> <label>Password</label> <input type="password" class="input-field" name="password" placeholder="Your Password..."> </div>
        <div class="form-field" > 
            <input type="submit" name="submit" value="Login" class="register"> 
        </div>
    </form>
</div>
</div>
<?php include("footer.html"); ?> 
<script src="javapages/boot-transit.js"></script>

     
</body>
</html>