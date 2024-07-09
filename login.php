<!DOCTYPE html>
<html>
<head>
    <style>
    body{
        background-image: url('./Files/bg.webp');
        background-repeat: no-repeat;
        background-size: cover;
    }

    .inputfield{
        height: 8vh;
        border-radius: 10px;
        width: 100%;
        background-color: white;
        margin-bottom: 5vh;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }

    .maindiv{
        margin: auto;
        width: 30%;
    }

    .tag{
        color: #213502;
        font-size: 3vh;
        margin-bottom: 1vh;
    }

    .title{
        margin-top: 20vh;
        text-align: center;
        color: #213502;
        font-size: 5vh;
    }

    .submit{
        width: 100%;
        color: white;
        height: 8vh;
        margin: auto;
        background-color: #20525C;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        border-radius: 10px;
    }
    .redirect{
        display: flex;
        margin-left: 20%;
        padding: 1vh;
        font-size: 2.5vh;
        margin-bottom: 5vh;
    }
    .redirect a{
        margin-left: 1vw;
    }
    </style>
</head>
<?php

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    echo "<script>window.location = 'home.php'</script>";
}
else{

    $login = false;

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $email = $_POST['email'];
        $password = $_POST['password'];
        $db = mysqli_connect("localhost", "root", "", "plantShop");

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($db, $sql);
        $num = mysqli_num_rows($result);
        $res_arr = mysqli_fetch_array($result);

        if($num == 1 && password_verify($password, $res_arr['password'])){
            $login = true;
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $fname;

            echo "<script>alert('Login successful!')</script>";
            echo "<script>window.location = 'home.php'</script>";
        }

        else{
            echo "<script>alert('Invalid Credentials')</script>";
        }
    }
 ?>

<form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class = "form">

    <div class="title">
        <h2>Log In</h2>
    </div>

    <div class="maindiv">
        <div class="tag">Email:</div>
        <input name = "email" type="email" class="inputfield"></input>

        <div class="tag">Password:</div>
        <input name = "password" type="password" class="inputfield"></input>

        <button type = "submit" class="submit">Submit</button>

        <div class="redirect">
            Don't have an account?
            <a href = "http://localhost/plantShop/register.php">Sign Up</a>
        </div>
    </div>

</form>
<?php
}
?>
</body>
</html>