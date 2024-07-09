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
        margin-bottom: 2vh;
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
        margin-top: 10vh;
        text-align: center;
        color: #213502;
        font-size: 5vh;
        line-height: 0;
    }

    .submit{
        width: 100%;
        color: white;
        height: 8vh;
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
<body>

<?php 
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    echo "<script>window.location = 'home.php'</script>";
}
else{
    $nameErr = $emailErr = $addressErr = $passwordErr = "";
    $name = $email = $address = $password = "";

    $db = mysqli_connect('localhost', 'root', '', 'plantShop');

    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST["name"])) {
            $nameErr = "Please enter this field.";
        }
        else{
            $name = test_input($_POST["name"]);
        }

        if(empty($_POST["email"])) {
            $emailErr = "Please enter this field.";
        }
        else{
            $email = test_input($_POST["email"]);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $emailErr = "Please enter a valid email.";
            }
        }
        
        if(empty($_POST["address"])) {
            $addressErr = "Please enter this field.";
        }
        else{
            $address = test_input($_POST["address"]);
        }


        if(empty($_POST["password"])) {
            $passwordErr = "Please enter this field.";
        }
        else{
            $password = test_input($_POST["password"]);
            if(!preg_match("/^[a-zA-Z]*$/", $password)){
                $passwordErr = "Please enter a valid password.";
            }
        }

    if($nameErr == "" && $emailErr == "" && $addressErr == "" && $passwordErr == ""){
        
        $escaped_name = mysqli_real_escape_string($db, $name);
        $escaped_email = mysqli_real_escape_string($db, $email);
        $escaped_address = mysqli_real_escape_string($db, $address);
        $escaped_password = mysqli_real_escape_string($db, $password);
        $hashed_password = password_hash($escaped_password, PASSWORD_DEFAULT);

        $sql = "SELECT * from users WHERE email='$email';";
        $res = mysqli_query($db, $sql);
        $exists = mysqli_num_rows($res); 

        if($exists == 0){
        $query = "INSERT INTO users (name, email, address, password)
        VALUES ('$escaped_name', '$escaped_email', '$escaped_address','$hashed_password')";

        $result = mysqli_query($db, $query);

        if($result && !empty($_POST['email'])){
            echo "<script>alert('Registration successful!')</script>";
            echo "<script>window.location = 'login.php'</script>";
            exit();
        }
        }

        else if(isset($_POST['email'])){
            echo "<script>alert('Email already registered!')</script>";
            echo "<script>window.location = 'home.php'</script>";
        }
    }

}
?>

    <div class = "container2">
        <div class="title">
            <h2>Sign Up</h2>
        </div>
        <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class = "form">
            <div class="maindiv">
                <div class="tag">Full name:</div>
                <input type = "text" class="inputfield" name = "name"></input>

                <div class="tag">Email:</div>
                <input type = "text" class="inputfield" name = "email"></input>

                <div class="tag">Address:</div>
                <textarea class="inputfield" name = "address"></textarea>

                <div class="tag">Password:</div>
                <input type = "password" class="inputfield" name = "password"></input>

                <button type = "submit" class="submit">Submit</button>
                <div class="redirect">
                    Don't have an account?
                    <a href = "http://localhost/plantShop/login.php">Log In</a>
                </div>
            </div>
        </form>
    </div>
    <?php
}
?>
</body>
</html>