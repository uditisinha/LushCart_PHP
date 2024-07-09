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

            .price_type{
                padding: 2vh;
                display: flex;
                margin: auto;
                justify-content: center;
            }

            .pricediv input{
                padding: 2vh;
                border-radius: 5px;
                width: 80%;
                border-style: solid;
                margin-top: 1vh;
                border-width: 1px;
                border-color: white;
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
                height: 40vh;
                width: 90%;
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
        if($_SESSION['email'] == 'uditi.sinha@somaiya.edu'){
    ?>
        <h1>Add Plant</h1>
    <form method = "POST" class = "upload_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <div class="upload">
            <label>Upload Image: </label>
            <input type="file" name="image" accept="image/*" class="upload">
        </div>
        
        <div class="namediv">
            <label>Name of plant:</label>
            <input type="text" name = "name">
        </div>

        <div class="price_type">
            <div class="pricediv">
                <label>Price of plant:</label>
                <input type="text" name = "price">
            </div>
            <div class="typediv">
                <label>Type of plant:</label>                
                <select name="type" id="type" class="type">
                    <option value="Air Purifying Plant">Air Purifying Plants</option>
                    <option value="Money Plant">Money Plants</option>
                    <option value="Lucky Plant">Lucky Plants</option>
                    <option value="Desk plant">Desk plants</option>
                </select>
            </div>
        </div>

        <div class="descriptiondiv">
            <label>Description</label>
            <textarea name = "item_desc"></textarea>
        </div>

        <button type="submit" class="add_item">Add item</button>

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
    $item_image = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = 'Images/'.$item_image;      
    $item_name = $_POST['name'];
    $item_price = $_POST['price'];
    $plant_type = $_POST['type'];
    $item_desc = $_POST['item_desc'];

    $db = mysqli_connect("localhost", "root", "", "plantshop");

    $query = "INSERT INTO shop(item_name, item_image, item_price, plant_type, item_desc) VALUES('$item_name', '$item_image', '$item_price', '$plant_type', '$item_desc');";
    $err = mysqli_query($db, $query);

    if ($err && move_uploaded_file($tempname, $folder)){
        echo "<script>alert('Item added!')</script>";
    }
    else{
        echo "<script>alert('Error adding item')</script>";
    }
}
?>