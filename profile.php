<?php 
    include("header.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            body{
                margin: 0;
                padding: 0;
                color: white;
                background-color: #0A192F;
            }
            .upload{
                display: flex;
                margin: auto;
                justify-content: center;
                margin-bottom: 3vh;
            }
            .upload label{
                margin-top: 1%;
                margin-right: 1vw;
            }
            .upload button{
                padding: 2vh;
                border-radius: 5px;
                background-color: #DFE667;
                color: black;
                width: 20%;
                border-style: solid;
                border-width: 1px;
                border-color: white;
            }

            .pricediv input{
                width: 80%;
                padding: 2vh;
                border-style: solid;
                border-width: 1px;
                border-color: white;
                display: flex;
                border-radius: 5px;
                margin: auto;
                justify-content: center;
                margin-bottom: 3vh;
            }
            .pricediv label{
                width: 85%;
                display: flex;
                margin: auto;
                margin-bottom: 1vh;
            }
            h1{
                text-align: center;
            }
            .typediv select{
                padding: 2vh;
                border-radius: 5px;
                border-style: solid;
                margin-top: 1vh;
                border-width: 1px;
                width: 100%;
                border-color: white;
            }

            .descriptiondiv textarea{
                padding: 2vh;
                border-radius: 5px;
                height: 20vh;
                width: 80%;
                border-style: solid;
                display: flex;
                margin: auto;
                justify-content: center;
                border-color: white;
                border-width: 1px;
            }
            .descriptiondiv label{
                display: flex;
                margin: auto;
                justify-content: center;
                margin-top: 3vh;
                margin-bottom: 1vh;
            }
            .namediv input{
                width: 80%;
                padding: 2vh;
                border-style: solid;
                border-width: 1px;
                border-color: white;
                display: flex;
                border-radius: 5px;
                margin: auto;
                justify-content: center;
                margin-bottom: 3vh;
            }
            .namediv label{
                width: 85%;
                display: flex;
                margin: auto;
                margin-bottom: 1vh;
            }
            .add_item{
                background-color: #DFE667;
                border-radius: 5px;
                padding: 2vh;
                color: black;
                width: 20%;
                display: flex;
                margin: auto;
                justify-content: center;
                margin-top: 5vh;
                border-style: solid;
                box-shadow: rgb(20, 20, 20) 0px 5px 5px;
                border-width: 1px;
                border-color: white;
            }
            .add_item:hover{
                box-shadow: none;
            }
            .footer{
                margin-top: 10vh;
                background-color: #213502;
                width: 100%;
                box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
                height: 30vh;
            }
            .upload_form{
                background-color: #172A46;
                width: 50%;
                padding: 5vh;
                margin: auto;
                margin-top: 5vh;
                border-radius: 5px;
                box-shadow: rgb(20, 20, 20) 0px 5px 15px;
                margin-bottom: 10vh;
            }
        </style>
    </head>

    <body>

    <?php
    $db = mysqli_connect("localhost", "root", "", "plantshop");
    $email = $_SESSION['email'];
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_array($result);

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    ?>
        <h1>Add Plant</h1>
    <form method = "POST" class = "upload_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

        <div class="namediv">
            <label>Name:</label>
            <input type="text" name = "name" value = "<?php echo $row['name'] ?>">
        </div>

        <div class="descriptiondiv">
            <label>Address</label>
            <textarea name = "item_desc" value = "<?php echo $row['address'] ?>"></textarea>
        </div>

        <button type="submit" class="add_item">Update Information</button>

    </form>
    </body>
    <?php }
    else{
        echo "<script>window.location = 'home.php'</script>";
    }
    ?>
</html>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
        $address = $_POST['item_desc'];
        $name = $_POST['name'];

        if($address == ''){
            $address = $row['address'];
        }
        if($name == ''){
            $name = $row['name'];
        }

        $query2 = "UPDATE users SET address = '$address', name = '$name' WHERE email = '$email'";
        $result2 = mysqli_query($db, $query2);
        
        echo "<script>alert('Profile updated!')</script>";
        echo "<script>window.location = 'profile.php'</script>";
    }

?>