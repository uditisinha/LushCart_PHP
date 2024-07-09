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
                background-color: #0A192F;
            }
            .shop{
                text-align: center;
                color: #213502;
            }
            .itemsgrid{
                width: 100%;
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
            }
            .itemcard{
                margin: auto;
                border-radius: 10px;
                padding: 3vh;
                height: 55vh;
                margin-bottom: 20vh;
                width: 60%;
            }
            .itemprice{
                margin: auto;
            }
            .imagecard{
                border-radius: 10px;
                box-shadow: rgb(20, 20, 20) 0px 5px 15px;
                margin: auto;
                height: 70%;
                width: 100%;
                background-color: black;
            }
            .title{
                text-align: center;
                color: white;
                font-size: 4vh;
            }
            .itemname{
                font-size: 3vh;
                font-weight: bold;
                color: white;
            }
            .remove{
                text-align: center;
                border-radius: 10px;
                border-style: solid;
                border-width: 1.5px;
                border-color: white;
                width: 100%;
                background-color: #20525C;
                padding: 2vh;
                color: white;
                box-shadow: rgb(20, 20, 20) 0px 5px 15px;
            }
            .remove:hover{
                background-color: #0A192F;
            }
            .itemquantity{
                box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
                text-align: center;
                border-radius: 10px;
                background-color: white;
                border-style: solid;
                border-width: 2px;
                border-color: black;
                width: 30%;
            }
            .info{
                display: flex;
                color: #7EA310;
                font-weight: bold;
                margin: auto;
            }
            .quantity_update{
                background-color: #20525C;
                color: white;
                border-radius: 10px;
                box-shadow: rgb(20, 20, 20) 0px 5px 15px;
                border-style: solid;
                border-width: 1px;
                border-color: white;
            }
            .quantity_update:hover{
                background-color:#0A192F;
            }
            .place_order{
                padding: 2vh;
                display: flex;
                margin: auto;
                justify-content: center;
                background-color: #DFE667;
                color: black;
                box-shadow: rgb(20, 20, 20) 0px 5px 15px;
                margin-top: 5vh;
                margin-bottom: 10vh;
                border-radius: 10px;
                border-style: solid;
                width: 20%;
                border-width: 1px;
                border-color: black;
            }
            .place_order:hover{
                background-color: #7C812E;
            }
            .emptycart p{
                text-align: center;
                font-size: 3vh;
                color: white;
            }
        </style>

    </head>

    <body>
    <div class="title">
        <h2>My cart</h2>
    </div>

    <?php
    
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        $db = mysqli_connect("localhost", "root", "", "plantshop");
        $email = $_SESSION['email'];
        $query = "SELECT * FROM cart WHERE email = '$email'";
        $query7 = "SELECT * FROM users WHERE email = '$email';";
        $res = mysqli_query($db, $query7);
        $row3 = mysqli_fetch_array($res);
        $result = mysqli_query($db, $query);
        $num_rows = mysqli_num_rows($result); // Count the number of rows
    ?>

    <div class="itemsgrid">
        <?php
        if ($num_rows > 0) {
            while($row = mysqli_fetch_array($result)){
                $item_ID = $row['item_ID'];

                $query2 = "SELECT * FROM shop WHERE item_ID = '$item_ID'";
                $result2 = mysqli_query($db, $query2);
                $row2 = mysqli_fetch_array($result2);
                ?>

                <div class="itemcard">
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <img class="imagecard" src = "Images/<?php echo $row2['item_image']; ?>" salt="<?php echo $row2['item_name']; ?>">
                        <div class="itemname"><p><?php echo $row2['item_name'] ?></p></div>
                        <div class="info" style="justify-content: space-around;">
                            <p>Quantity:</p>
                            <input type="number" class="itemquantity" name="itemquantity" value="<?php echo $row['item_quantity']; ?>">
                            <input type="hidden" name="item_price" value="<?php echo $row2['item_price'] ?>">
                            <input type="submit" value="Update" class="quantity_update">
                            <input type="hidden" name="action" value="update_quantity">
                            <input type="hidden" name="item_ID" value="<?php echo $item_ID; ?>">
                        </div>
                        <div class="info">
                            <div class="itemprice"><p>Total: Rs. <?php echo $row2['item_price'] * $row['item_quantity']; ?></p></div>
                        </div>
                    </form>

                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="submit" name="remove_item" class="remove" value="Remove">
                        <input type="hidden" name="action" value="item_remove">
                        <input type="hidden" name="item_ID" value="<?php echo $item_ID; ?>">
                    </form>
                </div>
                <?php
            }
        ?>
    </div>
        <?php
        } 
        else {
            ?> 
            <div></div>
            <div class="emptycart">
                <p>Your cart is empty</p>
            </div>
            <?php
        }
        ?>

    <?php if ($num_rows > 0) { ?>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="submit" class="place_order" value="Place Order">
            <input type="hidden" name="address" value="<?php echo $row3['address'] ?>">
            <input type="hidden" name="action" value="order_place">
        </form>
    <?php } 
    
    }
    else{
        echo "<script>alert('Please log in to buy items')</script>";
        echo "<script>window.location = 'login.php'</script>";
    }?>
    
    </body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_SESSION['email'];
    if (isset($_POST['action']) ) {
        $action = $_POST['action'];

        if ($action == 'update_quantity') {
            $quantity_update = $_POST['itemquantity'];
            $item_ID = $_POST['item_ID'];
            $item_price = $_POST['item_price'];

            $total_price = (int)$item_price * (int)$quantity_update;

            if($quantity_update == 0){
                $query5 = "DELETE FROM cart WHERE item_ID = '$item_ID' and email = '$email'";
                echo "<script>alert('Deleted item.')</script>";
                mysqli_query($db, $query5);
            }
            
            else{
                $query3 = "UPDATE cart SET item_quantity = '$quantity_update', total_price = '$total_price' WHERE item_ID = '$item_ID' AND email = '$email'";
                mysqli_query($db, $query3);
                echo "<script>alert('Quantity updated.')</script>";
            }
            
            echo "<script>window.location = 'cart.php'</script>";
            exit;
        }
    
        if ($action == 'item_remove') {
            $item_ID = $_POST['item_ID'];
                
            $query4 = "DELETE FROM cart WHERE item_ID = '$item_ID' and email = '$email'";
            mysqli_query($db, $query4);
            
            echo "<script>alert('Item deleted.')</script>";
            echo "<script>window.location = 'cart.php'</script>";
            exit;
        }
        if ($action == 'order_place') {
            $query = "SELECT * FROM cart WHERE email = '$email'";
            $result = mysqli_query($db, $query);
            $address = $_POST['address'];
            while($row = mysqli_fetch_array($result)){
                $item_ID = $row['item_ID'];
                $item_quantity = $row['item_quantity'];
                $total_price = $row['total_price'];
                $query5 = "INSERT INTO orders (email, item_ID, item_quantity, total_price, address, delivery_status) VALUES ('$email', '$item_ID', '$item_quantity', '$total_price', '$address', 'DELIVERING')";
                mysqli_query($db, $query5);
            }
            
            $query6 = "DELETE FROM cart WHERE email = '$email'";
            mysqli_query($db, $query6);
            
            echo "<script>alert('Order Successful!')</script>";
            echo "<script>window.location = 'cart.php'</script>";
            exit;
        }
}
}
?>