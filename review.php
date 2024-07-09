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
                display: grid;
                grid-template-columns: 1fr 1fr 1fr 1fr;
            }
            .itemcard{
                margin: auto;
                border-radius: 5px;
                padding: 3vh;
                height: 55vh;
                margin-bottom: 5vh;
                width: 75%;
                background-color: #172A46;
                border-style: solid;
                border-width: 1px;
                border-color: black;
                box-shadow: rgb(20, 20, 20) 0px 5px 15px;
            }
            .desc{
                overflow: hidden;
                overflow-y: scroll;
            }
            
            .desc::-webkit-scrollbar {
                width: 1.5vh;
            }

            .desc::-webkit-scrollbar-track {
                background-color: #a9a9a9;
                border-radius: 1vh; 
            }

            .desc::-webkit-scrollbar-thumb {
                background-color: #878787; 
                border-radius: 1vh; 
            }

            .desc::-webkit-scrollbar-thumb:hover {
                background-color: #cccccc; 
            }

            .imagecard img{
                height: 70%;
                width: 100%;
                border-radius: 10px;
                margin: auto;
                margin-bottom: 2vh;
            }
            .title{
                text-align: center;
                color: white;
                font-size: 4vh;
            }
            .itemcard p2{
                font-size: 3vh;
                color: white;
            }
            .itemcard p1{
                font-size: 2.5vh;
                color: #D3D3D3;
            }
            .itemcard input{
                width: 30%;
                border-style: solid;
                border-width: 2px;
                padding: 1vh;
                border-radius: 10px;
            }
            .submit{
                background-color: #20525C;
                color: white;
                border-style: solid;
                border-width: 1px;
            }

            a{
                text-decoration: none;
            }
            .footer{
                margin-top: 10vh;
                background-color: #213502;
                width: 100%;
                box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
                height: 30vh;
            }
            .sort{
                display: flex;
                justify-content:space-around;
                margin: auto;
                color: white;
                margin-bottom: 5vh;
            }
            .sort select{
                border-style: solid;
                border-width: 2px;
                border-color: #DFE667;
                color: black;
                padding: 2vh;
                border-radius: 5px;
            }
            .sort_price, .sort_rating, .sort_type{
                margin-left: 2vw;
                margin-right: 2vw;
            }
            .sort label{
                padding: 0;
                margin: 0;
                margin-bottom: 1vh;
            }
            .filter_submit_button{
                padding: 2vh;
                border-radius: 5px;
                border-style: solid;
                border-width: 2px;
                border-color: white;
                background-color: #DFE667;
                color: black;
                margin-right: 5vw;
            }
            .typecard{
                position: absolute;
                border-top-left-radius: 10px;
                border-bottom-right-radius: 10px;
                border-style: solid;
                border-width: 1px;
                border-color: white;
                background-color: #7EA310;
                height: 5%;
            }

            .typecard p{
                color: white;
                font-size: 2vh;
                margin: 0;
                padding: 1vh;
            }

            .itemcard:hover{
                scale: 0.95;
            }
        </style>

    </head>

    <body>
        <?php 
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        ?>
        <div class="title">
            <h2>Review</h2>
        </div>

        <?php
        $email = $_SESSION['email'];
        $db = mysqli_connect("localhost", "root", "", "plantshop");
        $query = "
            SELECT DISTINCT o.item_ID, o.order_date, o.total_price
            FROM orders o
            LEFT JOIN reviews r
            ON o.item_ID = r.item_ID AND o.email = r.email
            WHERE o.email = '$email'
            AND r.item_ID IS NULL
            AND o.delivery_status = 'DELIVERING';
        ";

        $result = mysqli_query($db, $query);
        $num_rows = mysqli_num_rows($result);
        
        ?>
    
        <div class="itemsgrid">
        <?php

        if($num_rows != 0){
        while($row = mysqli_fetch_array($result)){
            $item_ID = $row['item_ID'];
            $query2 = "SELECT * FROM shop WHERE item_ID = '$item_ID'";
            $result2 = mysqli_query($db, $query2);
            $row2 = mysqli_fetch_array($result2)
            ?>
            <a href = "item.php?id=<?php echo $row['item_ID']; ?>">
                <div class="itemcard">
                    <div class="imagecard">
                        <div class="typecard"><p><?php echo $row2['plant_type']; ?></p></div>
                        <img src = "Images/<?php echo $row2['item_image']; ?>" class = "images">
                    </div>

                    <div class="desc">
                        <p2>
                        <?php echo $row2['item_name']?>
                        </p2><br>
                        <p1>
                            <?php echo "Order date: ".$row['order_date']?>
                        </p1><br>
                        <p1>
                            <?php echo "Total price: Rs. ".$row['total_price']?>
                        </p1><br>
                    </div>
                </div>
            </a>

<?php
        }
    }
    else{
        ?> 
        <div style="width: 100vw;">
        <p style="color: white; text-align: center;">
        <?php
        echo "All items you have ordered but haven't given a review to are displayed here.";
        ?>
        </p>
        </div>
        <?php
    }
        ?>
        </div>

        <?php }
        
    else{
        echo "<script>alert('Please log in to buy items')</script>";
        echo "<script>window.location = 'login.php'</script>";
    }

    ?>
    
    </body>
</html>

