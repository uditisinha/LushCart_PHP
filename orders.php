<?php 
    include("header.php");
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body{
            background-color: #0A192F;
            color: white;
        }
        .orderdiv{
            width: 65%;
            margin: auto;
            height: 50%;
            display: grid;
            grid-template-columns: 1fr 3fr;
            background-color: #172A46;
            padding: 2vh;
            border-radius: 10px;
            margin-top: 5vh;
            box-shadow: rgb(20, 20, 20) 0px 5px 15px;
        }
        .submit{
            background-color: red;
            display: flex;
            justify-content: center;
            margin: auto;
            color: white;
            border-radius: 5px;
            width: 100%;
            padding: 1vh;
            border-style: solid;
            border-width: 1px;
            margin-top: 1vh;
            border-color: black;
            box-shadow: rgb(20, 20, 20) 0px 5px 5px;
        }
        .submit:hover{
            box-shadow: none;
        }
        .img{
            width: 100%;
            border-radius: 10px;
        }
        .images{
            width: 100%;
            border-radius: 5px;
        }
        .detailsdiv{
            margin-left: 5%;
            padding: 2vh;
        }
        .detailsdiv p{
            margin: 0;
            font-size: 3vh;
        }
        .detailsdiv h2{
            margin: 0;
            font-size: 4.5vh;
            margin-bottom: 1vh;
        }
        .imagediv{
            padding: 1vh;
        }
            .title{
                text-align: center;
                color: white;
                font-size: 4vh;
            }
            
            .emptycart p{
                text-align: center;
                font-size: 3vh;
                color: white;
            }
    </style>
</head>
<body>

<?php

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        $db = mysqli_connect("localhost", "root", "", "plantshop");
        $email = $_SESSION['email'];

        $query = "SELECT * FROM orders WHERE email = '$email' and delivery_status = 'DELIVERING'";
        $result = mysqli_query($db, $query);
        $num_rows = mysqli_num_rows($result)
        
        ?>
        
        <div class="title">
            <h2>Orders</h2>
        </div>

    <?php
    if($num_rows != 0){
        while($row = mysqli_fetch_array($result)){
        ?>
            <div class="orderdiv">
        <?php
            $item_ID = $row['item_ID'];
            $order_ID = $row['order_ID'];
            $query2 = "SELECT * FROM shop WHERE item_ID = '$item_ID'";
            $result2 = mysqli_query($db, $query2);
            $row2 = mysqli_fetch_array($result2);
        ?>
        <div class="imagediv">
            <div class="img">
                <img src = "Images/<?php echo $row2['item_image']; ?>" class = "images">
            </div>
            
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <button type="submit" class = "submit" name="cancel_order">Cancel Order</button>
            <input type="hidden" name="item_ID" value="<?php echo $item_ID; ?>">
            <input type="hidden" name="order_ID" value="<?php echo $order_ID; ?>">
        </form>
        </div>
        <div class="detailsdiv">
            <h2><?php echo $row2['item_name'] ?></h2>
            <p>Delivering to: <?php echo $row['address'] ?></p>
            <p>Order date: <?php echo $row['order_date'] ?></p>
            <p>Total quantity: <?php echo $row['item_quantity'] ?></p>
            <p>Total price: Rs. <?php echo $row['total_price'] ?></p>
        </div>
    </div>

    <?php
    }
    }
    else{
        ?> 
        <div></div>
        <div class="emptycart">
            <p>No orders yet.</p>
        </div>
        <?php
    }
}
else{
    echo "<script>alert('Please log in to buy items')</script>";
    echo "<script>window.location = 'login.php'</script>";
}
    ?>
    <br>
    <br><br>
</body>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cancel_order']) ) {
        $order_ID = $_POST['order_ID'];
        $query3 = "UPDATE orders SET delivery_status = 'CANCELLED' WHERE order_ID = '$order_ID' AND email = '$email'";
        mysqli_query($db, $query3);
        echo "<script>alert('Order cancelled.')</script>";
        echo "<script>window.location = 'orders.php'</script>";
    }
}
?>

</html>