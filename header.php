<?php
    session_start();
    $loggedin = false;
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
    {
        $loggedin = true;
        $loggedin_user_email = $_SESSION['email'];
        $uname = $_SESSION['name'];
    }
    else{   
        $loggedin = false;
    }

    setcookie('name', 'uditi', time() - 86400);
?>

<!DOCTYPE html>
<html>
  <head>
    <style>
        .navbar{
          display: flex;
          margin-top: 5vh;
          margin-bottom: 3vh;
          margin-left: 2vw;
          margin-right: 2vw;
          font-size: 2.5vh;
        }
        .navbar a{
          text-decoration: none;
          margin: 10px;
          color: white;
          font-weight: bold;
        }
        .navbar a:hover{
          color: gray;
        }
        .rightnav{
          margin-left: auto;
          display: flex;
        }
        .navhr{
          margin: 0;
          padding: 0;
          box-sizing: border-box;
          height: 3px;
          background-color: white;
          width: 80%;
          margin: auto;
        }
      </style>
  </head>

  <body>
    <div class="navbar">
      <a href="http://localhost/plantShop/home.php">Home</a>
      <a href="http://localhost/plantShop/shop.php">Shop</a>

      <?php if($loggedin){ ?>
        <a href="http://localhost/plantShop/cart.php">Cart</a>
        <a href="http://localhost/plantShop/review.php">Review</a>
      <?php } ?>
      
      <div class="rightnav">
      <?php if($loggedin){ ?>
        <a href="http://localhost/plantShop/orders.php">Orders</a>
        <a href="http://localhost/plantShop/profile.php">Profile</a>
        <a href="http://localhost/plantShop/logout.php">Logout</a>
      <?php } else { ?>
        <a href="http://localhost/plantShop/login.php">Login</a>
      <?php } ?>
      </div>
    </div>
    <hr class = "navhr">
  </body>
</html>
