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
            .itemcard:hover{
                scale: 0.95;
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
                color: white;
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
                box-shadow: rgb(20, 20, 20) 0px 5px 15px;
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
                box-shadow: rgb(20, 20, 20) 0px 5px 15px;
            }
            .sort select:hover{
                scale: 0.95;
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
                box-shadow: rgb(20, 20, 20) 0px 5px 15px;
            }
            .filter_submit_button:hover{
                background-color: #7C812E;
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
        </style>

    </head>

    <body>
        <div class="title">
            <h2>Shop</h2>
        </div>

        <form method = "POST" class = "" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
        <div class="sort">
            <div class="sort_price">
                <label>Sort by price:</label>
                <select name = "sort_price">
                    <option disabled selected value> -- select an option -- </option>
                    <option value="700">< 700</option>
                    <option value="1000">< 1000</option>
                    <option value="1500">< 1500</option>
                    <option value="2000">< 2000</option>
                </select>
            </div>

            <div class="sort_rating">
                <label>Sort by rating:</label>
                <select name = "sort_rating">
                    <option disabled selected value> -- select an option -- </option>
                    <option value="4">> 4</option>
                    <option value="3">> 3</option>
                </select>
            </div>
            
            <div class="sort_type">
                <label>Sort by plant type:</label>
                <select name = "sort_type">
                    <option disabled selected value> -- select an option -- </option>
                    <option value="Air Purifying Plant">Air Purifying Plants</option>
                    <option value="Money Plant">Money Plants</option>
                    <option value="Lucky Plant">Lucky Plants</option>
                    <option value="Desk plant">Desk plants</option>
                </select>
            </div>
            
            <div class="filter_submit">
                <input type="hidden" name="action">
                <button type="submit" class="filter_submit_button">Filter</button>
            </div>
        </div>
        </form>

        <?php
        $db = mysqli_connect("localhost", "root", "", "plantshop");
        $query = "SELECT * FROM shop";
        $result = mysqli_query($db, $query);?>
    
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if (isset($_POST['action']) ) {
                    $var2 = 0;
                    $var = 0;
                    $var3 = 0;

                    if (isset($_POST['sort_price']) ) {
                        $sort_price = $_POST['sort_price'];
                        $var = 1;
                    }
                    if (isset($_POST['sort_type']) ) {
                        $sort_type = $_POST['sort_type'];
                        $var2 = 1;
                    }
                    if (isset($_POST['sort_rating']) ) {
                        $sort_rating = $_POST['sort_rating'];
                        $var3 = 1;
                    }

                    if($var == 1){
                        if($var2 == 1){
                            if($var3 == 1){
                                $query = "SELECT * FROM shop WHERE item_price < '$sort_price' AND item_rating > '$sort_rating' AND plant_type = '$sort_type'";
                            }
                            else{
                                $query = "SELECT * FROM shop WHERE item_price < '$sort_price' AND plant_type = '$sort_type'";
                            }
                        }
                        else if($var3 == 1){
                            $query = "SELECT * FROM shop WHERE item_price < '$sort_price' AND item_rating > '$sort_rating'";
                        }
                        else{
                            $query = "SELECT * FROM shop WHERE item_price < '$sort_price'";
                        }
                    }
                    
                    else if($var2 == 1){
                        if($var3 == 1){
                            $query = "SELECT * FROM shop WHERE item_rating > '$sort_rating' AND plant_type = '$sort_type'";
                        }
                        else{
                            $query = "SELECT * FROM shop WHERE plant_type = '$sort_type'";
                        }
                    }

                    else if($var3 == 1){
                        $query = "SELECT * FROM shop WHERE item_rating > '$sort_rating'";
                    }

                    else{
                        $query = "SELECT * FROM shop";
                    }
                    
                    $result = mysqli_query($db, $query);
                }
            }
        ?>

        <div class="itemsgrid">
        <?php
        while($row = mysqli_fetch_array($result)){

            ?>
            <a href = "item.php?id=<?php echo $row['item_ID']; ?>">
            <?php
                $item_ID = $row['item_ID'];
                $query2 = "SELECT * FROM reviews WHERE item_ID = '$item_ID'";
                $result2 = mysqli_query($db, $query2);
                $num_rows = mysqli_num_rows($result2)
            ?>
                <div class="itemcard">
                    <div class="imagecard">
                        <div class="typecard"><p><?php echo $row['plant_type']; ?></p></div>
                        <img src = "Images/<?php echo $row['item_image']; ?>" class = "images">
                    </div>

                    <div class="desc">
                        <p2>
                        <?php echo $row['item_name']?>
                        </p2><br>
                        <p1>
                            <?php echo "Price: Rs. ".$row['item_price']?>
                        </p1><br>    
                        <p1 style="color: #DFE667;">
                            <?php
                            if($row['item_rating'] != 0){
                                echo "Rating: ".$row['item_rating']." / 5 "." (".$num_rows." reviews)";
                            }
                            else{
                                echo "No reviews yet...";
                            }
                            ?>
                        </p1><br>    
                    </div>
                </div>
            </a>
        <?php 
        }
        ?>
        </div>
    
    </body>
</html>

