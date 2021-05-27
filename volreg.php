<?php
    require_once "phppages/config.php";
    require_once "phppages/session.php";

    if (isset($_POST['login'])) {
        header('location: vollog.php'); 
        exit();
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $contact = trim($_POST['contact']);
        $address = trim($_POST['address']);
        $city = trim($_POST['city']);
        $state = trim($_POST['state']);
        $password = trim($_POST['password']);
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

    if (empty($name)) {
        $errors['name'] = "Name required";
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
    if (empty($address)) {
        $errors['contact'] = "Address required";
    }
    if (empty($contact)) {
        $errors['city'] = "City Name required";
    }
    if (empty($contact)) {
        $errors['state'] = "State Name required";
    }
    if (empty($password)) {
        $errors['password'] = "Password required";
    }

    if($query = $db->prepare("SELECT * FROM vusers WHERE email = ?" )){
        $error = '';
        $query->bind_param('s', $email);
        $query->execute();
        $query->store_result();
        if($query->num_rows > 0){
            $error = '<p class="error"> Email already exits!</p>';
        }
        else{
            if(strlen($password) < 8){
                $error = '<p class="error"> Lenght of password must be more than 8!</p>';
            }
        }
        if(empty($error)){
            $insertQuery = $db->prepare("INSERT INTO vusers(name, email, contact, address, city, state, password) VALUES (?,?,?,?,?,?,?)");
            $insertQuery->bind_param("sssssss", $name, $email, $contact, $address, $city, $state, $password_hash);
            $result = $insertQuery->execute();
            if($result){
                $_SESSION['message'] = "You can now Serve!";
                $_SESSION['alert-class'] = "alert-success";
                header('location: vollog.php');
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
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link rel="stylesheet" type="text/css" href="csspages/boot-transit.css">
<link rel="stylesheet" type="text/css" href="csspages/userlogin.css">
<title>Registration Form</title>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet'>
<style>@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif
}

body {
    background-image: url("images/phpback/b15.jpg");
    background-repeat: repeat;
    background-size: 100% 100%;
}

.wrapper {
    max-width: 850px;   
    background-color: #fff;
    border-radius: 10px;
    position: relative;
    display: flex;
    margin: 50px auto;
    box-shadow: 0 8px 20px 0px #1f1f1f1a;
    overflow: hidden;
    position: relative;
    
}

.wrapper .form-left {
    background:  #000;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    padding: 20px 40px;
    position: relative;
    width: 100%;
    color: #fff
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
    border: 1px solid #31a031
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
                <li><a href="vollog.php" class="nav-links">Volunteer Login</a></li>
                <li><a href="userlogin.php" class="nav-links">Customer Login</a></li>
                <li><a href="contact.html" class="nav-links">Contact Us</a></li>
            </ul>
        </div>

    </nav>       
    <div data-aos="fade-in">
        <div class="wrapper" style="border: 1px solid grey";>
            <div class="form-left">
                <h2 class="text-uppercase">Terms and Condition</h2>
                <p> Hi Volunteer!!. We are glad you decided to volunteer with us.<br>But we request you to please go through our guildlines mentioned below. </p>
                <p class="text"> <li>You should be patient with all the needy patients</li><li>The main concern which everyone has now-a-days is cleanliness. So, as per our guidlines you have to upload some images of your cooking area to endure you keep it clean.<li>The customer will call you and place his/her order.</li><br><br>Further updates wil be updated. </p>
                <div class="form-field"> 
                    <form action="" method="post">
                        <input name="login" type="submit" class="account" value="Have an Account?">
                    </form>
                </div>
            </div>
            <form class="form-right" action="" method="post" onsubmit="return checkForm(this);">
                <h2 class="text-uppercase">Registration form</h2>
                <div class="row">
                    <div class="mb-3"> 
                        <label>Name</label> 
                        <input type="text" name="name" class="input-field" placeholder="Name..."> 
                    </div>
                    <div class="mb-3">
                        <label>Email</label> 
                        <input type="email" class="input-field" name="email" placeholder="Mail..."> 
                    </div>
                    <div class="mb-3"> 
                        <label>Contact</label> 
                        <input type="tel" class="input-field" name="contact" placeholder="Mobile No..."> 
                    </div>
                    <div class="mb-3"> 
                        <label>Street Name / Landmark / Pincode</label> 
                        <input type="text" class="input-field" name="address" placeholder="Address..."> 
                    </div>
                    <div class="col-sm-6 mb-3"> 
                        <label>City</label> 
                        <input type="text" name="city" class="input-field" placeholder="City..."> 
                    </div>  
                    <div class="col-sm-6 mb-3"> 
                        <label>State</label> 
                        <input type="text" name="state" class="input-field" placeholder="State..."> 
                    </div>  
                    <div class="mb-3">
                        <label>Password</label> 
                        <input type="password" name="password" class="input-field" placeholder="Password..."> 
                    </div>
                    <div class="form-check mt-2"> 
                        <input name="terms" class="form-check-input" type="checkbox" id="flexCheckChecked" required> 
                        <label class="form-check-label" for="flexCheckChecked"> I agree to the terms and conditions of Privacy & Policy
                        </label> 
                        
                    </div>
                    <div class="form-field"> 
                        <input type="submit" value="Join Us!" class="register" name="submit"> 
                    </div>

                                        <div class="form-check mt-2"> 

                    </div>


                </div>
            </form>
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