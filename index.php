<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="styles.css">
    <style>
    body {
        background-image: url("https://www.mmumullana.org/wp-content/uploads/2019/05/placement-bg.jpg");
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f0f0f0;
    }

    .login-container {
        color: rgb(237, 215, 215);
        background-color: #1a11117a;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 465px;
        text-align: center;
    }

    h2 {
        margin-bottom: 20px;
        color: #333;
    }

    .input-container {
        color: rgb(79, 67, 61);
        margin-bottom: 20px;
        text-align: left;
    }

    label {
        font-size: 14px;
        color: #333;
    }

    input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        box-sizing: border-box;
    }

    .btn {
        width: 100%;
        padding: 12px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #45a049;
    }

    .error-message {
        color: red;
        font-size: 14px;
        display: none; 
    }

    .error-message.active {
        display: block;
    }
    h2{
        color: white;
    }

    </style>
</head>
<body>
    <div class="login-container">
        <header>
            <img src="image.png">
        </header>
        <h2>Login</h2>
        <form action="index1.php" method="POST">
            <div class="input-container">
                <label for="username"><h2>Username</h2></label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="input-container">
                <label for="password"><h2>Password</h2></label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div>
                <input type="submit" class="btn" value="Login" name="btnlogin">
            </div>
        </form>
        <p class="error-message">Invalid username or password</p>
    </div>
</body>
</html>

<?php
include("connect.php");
if(isset($_POST['btnlogin'])){
    $username=mysqli_real_escape_string($database, $_POST['username']);
    $password=mysqli_real_escape_string($database, $_POST['password']);
    if(empty($username)){
        array_push($errors,"username is required");
    }
    if(empty($password)){
        array_push($errors,"password is required");
    }

    if(count($errors)==0){
        $password=md5($password);
        $query=="select*from users where username='$username' and password='$password'";
        $result=mysqli_query($database, $query);
        if(mysqli_num_rows($result)==1){
            $_SESSION['username']=$username;
            $_SESSION['success']="You are now logged un";
            header('location: index1.php');

        }else{
            array_push($errors,"wrong username/password combination");
        }
    }

}

?>


