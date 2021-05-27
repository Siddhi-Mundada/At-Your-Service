<?php
  require_once "phppages/config.php";
  require_once "phppages/session.php";

  if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    if (empty($username)) {
        $errors['username'] = "Name required";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email address is invalid";
    }
    if (empty($email)) {
        $errors['email'] = "Email required";
    }
    if (empty($contact)) {
        $errors['contact'] = "Contact number required";
    }
    if (empty($password)) {
        $errors['password'] = "Password required";
    }
    if($password !== $confirm_password) {
        $errors ['password'] = "The two passwords do not match";
    }

    if($query = $db->prepare("SELECT * FROM users WHERE email = ?" )){
        $error = '';
        $query->bind_param('s', $email);
        $query->execute();
        $query->store_result();
        if($query->num_rows > 0){
            $error = '<p class="error"> Email already exits!</p>';
        }
        else{
            if(strlen($password) < 8){
                $error = '<p class="error"> Length of password must be more than 8!</p>';
            }
        }
        if(empty($error)){
            $insertQuery = $db->prepare("INSERT INTO users(username, email, contact, password) VALUES (?,?,?,?)");
            $insertQuery->bind_param("ssss", $username, $email, $contact, $password_hash);
            $result = $insertQuery->execute();
            if($result){
                $_SESSION['message'] = "You can now SignIn!";
                $_SESSION['alert-class'] = "alert-success";
                header('location:userlogin.php');
                exit();
            }
            else{
                '<p class="error"> Something went wrong!</p>';
            }
        }
    }
    $query->close();
    $insertQuery->close();
    mysqli_close($db);
  }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <link rel="stylesheet" type="text/css" href="csspages/boot-transit.css">
        <link rel="stylesheet" type="text/css" href="csspages/userlogin.css">
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>User SignUp</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   
        <link href='' rel='stylesheet'>
        <style>body {
            background-image: url("images/phpback/b15.jpg");
            background-repeat: repeat;
            background-size: cover;
        }
.container {
    position: relative;
    margin-top: 1%;
    height: 130vh;
}

.card {
    width: 100%;
    padding: 30px
}

.form {
    padding: 15px
}

.form-control {
    height: 50px;
    background-color: #eee
}

.form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: #f50057;
    outline: 0;
    box-shadow: none;
    background-color: #eee
}

.inputbox {
    margin-bottom: 15px
}

.register {
    width: 200px;
    height: 51px;
    background-color: #000;
    border-color: #000
}
.home {
    width: 200px;
    height: 51px;
    color: #000;
    background-color: #fff;
    border-color: #000;
}

.home:hover .register:hover {
    width: 200px;
    height: 51px;
    background-color: #f50057;
    border-color: #f50057
}

.login {
    color: #000;
    text-decoration: none
}

.login:hover {
    color: #f50057;
    text-decoration: none
}

.form-check-input:checked {
    background-color: #000;
    border-color: #000001
}


@media only screen and (max-width:900px){
    .container{
        position: relative;
        margin-top: 30%;
    }
}

@media only screen and (max-width:620px){
    .container{
        position: relative;
        margin-top: 40%;
    }
}
</style>
<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>

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
                <li><a href="userlogin.php" class="nav-links">Customer Login</a></li>
                <li><a href="contact.html" class="nav-links">Contact Us</a></li>
            </ul>
        </div>

    </nav>
<div class="container d-flex justify-content-center align-items-center" >
    <div class="card">
        <div class="row">
            <div class="col-md-6">
                <div class="form">
                <form action="" method="post" onsubmit="return checkForm(this);">
                    <h2>Registration</h2>
                    <div class="inputbox mt-3"> 
                        <span>Name</span> 
                        <input type="text" placeholder="Jane Wang" name="username" class="form-control"> 
                    </div>
                    <div class="inputbox mt-3"> <span>Email</span> <input type="text" placeholder="janewang@company.com" name="email" class="form-control"> </div>
                    <div class="inputbox mt-3"> <span>Contact</span> <input type="text" placeholder="+1 455 445 4532" name="contact" class="form-control"> </div>
                    <div class="inputbox mt-3"> <span>Password</span> <input type="password" placeholder="Password" name="password" class="form-control"> </div>
                    <div class="inputbox mt-3"> 
                        <span>Re-type Password</span> 
                        <input type="password" placeholder="Password" name="confirm_password" class="form-control"> 
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-right">
                            <input class="btn btn-success register btn-block" type="submit" name="submit" value="Register" href="userlogin.php">
                        </div>

                    </div>
                    <div class="form-check mt-2"> 
                        <input name="terms" class="form-check-input" type="checkbox" id="flexCheckChecked" required> 
                        <label class="form-check-label" for="flexCheckChecked"> I agree to the terms and conditions of 
                            <a href="" class="login">Privacy & Policy</a> 
                        </label> 
                    </div>
                </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-center mt-5"> <img src="images/phpback/s8.png" width="400"> </div>
            </div>
        </div>
    </div>
</div>
<script src="javapages/boot-transit.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>        
        AOS.init({
        offset: 200,
        duration: 1200,

        });
    </script>

<script>
  function checkForm(form)
  {
    if(!form.terms.checked) {
      alert("Please indicate that you accept the Terms and Conditions");
      form.terms.focus();
      return false;
    }
    return true;
  }
</script>
<?php include("footer.html"); ?> 
        
</body>
</html>