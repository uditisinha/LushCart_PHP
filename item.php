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
                margin: 0;
                padding: 0;
            }

            .infodiv{
                margin: auto;
                margin-top: 5vh;
                width: 80%;
                display: grid;
                grid-template-columns: 1fr 3fr;
            }

            img{
                border-radius: 10px;
                box-shadow: rgb(20, 20, 20) 0px 5px 15px;
            }

            .itemdesc{
                margin-left: 3vw;
            }
            .imagecard{
                width: 100%;
            }
            .price{
                margin-top: 1vh;
                text-align: center;
            }
            .quantity{
                width: 30%;
                border-radius: 10px;
                border-style: solid;
                border-width: 2px;
                border-color: black;
                padding: 1vh;
            }
            .item_quantity_child{
                margin-top: 2vh;
                display: flex;
                justify-content: center;
            }
            .submit{
                width: 100%;
                padding: 2vh;
                border-radius: 10px;
                background-color: #DFE667;
                color: black;
                border-style: solid;
                border-width: 1.5px;
                border-color: black;
                margin-top: 1vh;
                box-shadow: rgb(20, 20, 20) 0px 5px 15px;
            }
            .submit:hover{
                background-color: #7C812E;
            }
            label{
                margin-top: 1vh;
                margin-right: 1vw;
            }
            .item_name{
                color: white;
                font-weight: bold;
                font-size: 3.5vh;
            }
            .item_name h2{
                margin-bottom: 0;
                padding-bottom: 0;
            }
            .description{
                font-size: 3vh;
            }
            .reviews{
                width: 80%;
                margin: auto;
            }
            .user_review{
                border-radius: 5px;
                background-color: #172A46;
                padding: 3vh;
                margin-bottom: 2vh;
            }
            .user_review h3, h4{
                margin: 0;
                padding: 0;
            }
            .user_review h4{
                color: #DFE667;
            }
            .footer{
                margin-top: 10vh;
                background-color: #213502;
                width: 100%;
                box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
                height: 30vh;
            }
            .review_form{
                margin-bottom: 2vh;
            }
            .write{
                padding: 2vh;
                border-style: solid;
                border-width: 2px;
                border-color: white;
                border-radius: 5px;
                width: 90%;
            }
            .post_review{
                padding: 2.5vh;
                border-radius: 5px;
                background-color: #DFE667;
                border-style: solid;
                border-width: 1px;
                border-color: black;
            }
            .post_review:hover{
                background-color: #7C812E;
            }
            .numbers{
                padding: 1vh;
                border-radius: 5px;
                margin-bottom: 2vh;
            }
            .review_form{
                background-color: #172A46;
                padding: 3vh;
                border-radius: 5px;
            }
            .rating_desc{
                color: #DFE667;
            }
            .flexname{
                display: flex;
            }
            .flexname p{
                padding: 0;
                margin: 0;
                margin-left: auto;
                color: darkgray;
            }
        </style>
    </head>

<?php 
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    
    $email = $_SESSION['email'];
      $db = mysqli_connect("localhost", "root", "", "plantshop");
      $item_ID = isset($_GET['id']) ? $_GET['id'] : null;
      
      $query4 = "SELECT * FROM shop WHERE item_ID = '$item_ID'";
      $result = mysqli_query($db, $query4);
      $row = mysqli_fetch_array($result);

      
      $query5 = "SELECT * FROM reviews WHERE item_ID = '$item_ID'";
      $result2 = mysqli_query($db, $query5);
      $num_rows = mysqli_num_rows($result2);
      $rating_avg = 0; 

      $query9 = "SELECT * FROM reviews WHERE email = '$email' AND item_ID = '$item_ID'";
      $result3 = mysqli_query($db, $query9);
      $num_rows3 = mysqli_num_rows($result3);

      $query6 = "SELECT * FROM orders WHERE email = '$email' AND item_ID = '$item_ID'";
      $result4 = mysqli_query($db, $query6);
      $num_rows2 = mysqli_num_rows($result4);
      
      while($row2 = mysqli_fetch_array($result2)) {
        $rating_avg = ($row2['rating'] + $rating_avg);
      }
      if($num_rows != 0){
        $rating_avg = $rating_avg/$num_rows;
      }

      $query7 = "UPDATE shop SET item_rating = '$rating_avg' WHERE item_ID = '$item_ID'";
      mysqli_query($db, $query7);

      ?>
      
    <body>
        <div class="infodiv">
            <div class="imgdiv">
                <img class="imagecard" src = "Images/<?php echo $row['item_image']; ?>" alt="<?php echo $row['item_name']; ?>">
                <div class="price">Price: Rs. <?php echo $row['item_price'] ?></div>

                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class = "item_quantity">
                    <div class="item_quantity_child">
                    <label>Quantity: </label><input type="number" name="quantity" class = "quantity" value="1" class="quantity">
                    <input type="hidden" name="item_price" value="<?php echo $row['item_price']; ?>">
                    <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                    <input type="hidden" name="action" value="quantity_submit">
                    </div>
                    <input type="submit" value="Add" class="submit">
                </form>
            </div>

            <div class="itemdesc">
                <div class="item_name">
                    <h2><?php echo $row['item_name'] ?></h2>
                </div>
                <?php if($rating_avg != 0){?>
                    <p class = "rating_desc">Rating: <?php echo $rating_avg; ?> / 5</p>
                <?php } 
                else{
                    ?>
                    <p class = "rating_desc">No rating yet...</p>
                    <?php
                }
                ?>
                <div class="description">
                    <p><?php echo $row['item_desc'] ?></p>
                </div>
            </div>
        </div>
        
        <hr style="
          margin: 0;
          padding: 0;
          box-sizing: border-box;
          height: 2px;
          background-color: white;
          width: 80%;
          margin: auto; margin-top: 10vh;">

        <div class="reviews">
            <div class="reviews_topic">
                <h1>Reviews</h1>
            </div>
            <?php
                if($num_rows3 == 0 and $num_rows2 != 0){ 
                    ?>
                    <form method = "POST" class = "review_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                        <label>Rating:</label>
                        <select name="numbers" id="numbers" class="numbers">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select><br>
                        <div class="review_write">
                            <input class = "write" name="write" placeholder = "Write a review...">
                            <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                            <button type="submit" class = "post_review">send</button>
                            <input type="hidden" name="action" value="submit_review">
                        </div>
                    </form>
                <?php
                } 
                if($num_rows == 0){
                ?>

                <p>No reviews yet...</p>

                <?php
                }
                else{
                    $query5 = "SELECT * FROM reviews WHERE item_ID = '$item_ID'";
                    $result2 = mysqli_query($db, $query5);
                    $num_rows = mysqli_num_rows($result2);
                while($row2 = mysqli_fetch_array($result2)) {
                    $email_ = $row2['email'];
                    $query8 = "SELECT * FROM users WHERE email = '$email_'";
                    $result5 = mysqli_query($db, $query8);
                    $row3 = mysqli_fetch_array($result5);
                        ?>
                        <div class="user_review">
                            <div class="flexname">
                                <h3><?php echo $row3['name'] ?></h3>
                                <p><?php echo $row2['review_time'] ?></p>
                            </div>
                            <h4>Rating: <?php echo $row2['rating'] ?> / 5</h4>
                            <p><?php echo $row2['rating_desc'] ?></p>
                        </div>
                <?php
                }
                }
            ?>

        </div>
        </body>

        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $item_ID = isset($_POST['id']) ? $_POST['id'] : null;
            if (isset($_POST['action']) ) {
                $action = $_POST['action'];
      
                if ($action == 'quantity_submit') {            
                    $quantity = $_POST['quantity'];
                    $item_price = $_POST['item_price'];
                    $total_price = (int)$item_price * (int)$quantity;
                    $email = $_SESSION['email'];

                    $query1 = "SELECT * FROM cart WHERE email = '$email' AND item_ID = '$item_ID'";
                    $res1 = mysqli_query($db, $query1);
                    $num = mysqli_num_rows($res1);

                    if($num == 1){
                        if($quantity == 0){
                            $query10 = "DELETE FROM cart WHERE item_ID = '$item_ID' AND email = ['$email']";
                            mysqli_query($db, $query10);
                            echo "<script>alert('Deleted item from cart.')</script>";
                        }
                        $query3 = "UPDATE cart SET item_quantity = '$quantity', total_price = '$total_price' WHERE item_ID = '$item_ID'";
                        mysqli_query($db, $query3);
                        echo "<script>alert('Updated item quantity.')</script>";
                        echo "<script>window.location = 'item.php?id=$item_ID'</script>";
                    }
                    else if($quantity != 0){
                        $query2 = "INSERT INTO cart(email, item_ID, item_quantity, total_price) VALUES('$email', '$item_ID', '$quantity','$total_price')";
                        $res2 = mysqli_query($db, $query2);

                        if ($res2) {
                            echo "<script>alert('Added to cart')</script>";
                            echo "<script>window.location = 'item.php?id=$item_ID'</script>";
                        } else {
                            echo "<script>alert('Could not add to cart.')</script>";
                            echo "<script>window.location = 'item.php?id=$item_ID'</script>";
                        }
                    }
                }
                if($action == 'submit_review'){
                    $review_desc = $_POST['write'];
                    $rating = $_POST['numbers'];
                    $email = $_SESSION['email'];

                    $query3 = "INSERT INTO reviews(item_ID, email, rating, rating_desc) VALUES('$item_ID', '$email', '$rating', '$review_desc')";
                    mysqli_query($db, $query3);
                    echo "<script>alert('Review added!')</script>";
                    echo "<script>window.location = 'item.php?id=$item_ID'</script>";
                }   
            }
        }
    } else {
        echo "<script>alert('Please log in to buy items')</script>";
        echo "<script>window.location = 'login.php'</script>";
    }
?>

</html>