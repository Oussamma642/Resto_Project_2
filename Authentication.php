<?php

session_start();


if (isset($_POST['btn']))
{ 
  if (isset($_POST['email']) && isset($_POST['pswd']))
    {
        include_once 'Dashbord-Menu/Classes/UserClasses/clsLogin.php';
        clsLogin::Login();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Login Page</title>

    <style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        /*background-image: url("./img/pageAuth.jpg");*/
        background-repeat: no-repeat;
        background-size: cover;
        font-family: Arial, sans-serif;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-box {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 15px;
        padding: 30px;
        width: 400px;
        position: relative;
        backdrop-filter: blur(7px);
        -webkit-backdrop-filter: blur(7px);
        border: 1px solid rgba(255, 255, 255, 0.18);
        bottom: 50px;
        margin-top: 100px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);

    }

    h2 {
        text-align: center;
        color: rgb(52, 6, 255);
        font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS",
            sans-serif;
    }

    .input-group {
        margin: 15px 0;
    }

    .input-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 20px;
    }

    .remember-me {
        display: flex;
        align-items: center;
    }

    .remember-me input {
        margin-right: 10px;
    }

    button {
        width: 100%;
        padding: 10px;
        background: rgb(52, 6, 255);
        color: rgb(255, 255, 255);
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin: 5px;
    }

    button:hover {
        background: rgb(7, 4, 55);
    }

    .footer {
        text-align: center;
        margin-top: 15px;
    }

    .footer a {
        color: #330cf7;
        text-decoration: none;
    }
    </style>

</head>

<body>
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <div class="login-box">
                    <h2>Login</h2>
                    <form method="post">
                        <div class="input-group">
                            <input type="text" name="email" placeholder="Email" required />
                        </div>

                        <div class="input-group">
                            <input type="password" name="pswd" placeholder="Password" required />
                        </div>

                        <div class="remember-me">
                            <input type="checkbox" id="remember" />
                            <label for="remember">Remember me</label>
                        </div>

                        <button type="submit" name="btn">Login</button>

                        <div class="footer">
                            <p>Don't have an account? <a href="#">Register</a></p>
                            <p><a href="#">Forgot Password?</a></p>
                        </div>
                    </form>
                    <div>
                        <h6 class='alert alert-danger'>
                            <?=(isset($_SESSION['MessageCnx']))? $_SESSION['MessageCnx'] : ''?></h6>
                    </div>
                </div>
                <div>
                </div>
            </div>
</body>

</html>