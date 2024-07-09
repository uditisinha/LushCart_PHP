<?php include("header.php"); ?>
<!-- 
<!DOCTYPE html>
<html>

    <body>

        <div class = "heading">
        <h1>Ruma's Balcony</h1>
        <p1>fresh and life giving</p1>
        </div>

        <div class = "home_rectangle">
        <div class = "container">

            <div class = "left-div">
            </div>

            <div class = "right-div">
                <h4 style = "font-weight: bold">Hello and welcome to Ruma's Plant Paradise, 
                a place where mom's green thumb comes to life!</h4>
                <br>
                <h5>This website is a tribute to her passion for plants and her remarkable talent for turning her love of gardening into a breathtaking collection of flora.</h5>
                <h5>We invite you to join us on a journey through the pages of our website and discover the joy and wonder of my mom's plant paradise.</h5>
            </div>

        </div>
        </div>

        <br>

        <div class = "card2">

            <div class = "left-card2">
                <h1 style = "text-align: center; margin-left: 25px;">Gallery</h1>
                <br>
                <h5>We're proud to offer a wide variety of plants that have been carefully cultivated with love and attention to detail.</h5>
                <h5>Our gallery is constantly evolving, so be sure to check back often to see what new and exciting plants we've added.</h5>
                
                <form method = "POST" action = "plants.php">

                <button type = "submit" class = "btn btn-danger"
                style = "display: block; margin: 5% auto; margin-left: 40%;">Redirect to Gallery</submit>

                </form>
           
            </div>

            <div class = "right-div">
            </div>

        </div>  


        <div class = "card3">

            <div class = "left-div">
            </div>

            <div class = "right-card">
            <h1 style = "margin-right: 8%;">Decor</h1>
                <br>
                <h5>Explore our collection of plant decor items on our decor page.</h5>
                <h5>From beautiful flower pots to unique holders, you'll find everything you need to add a touch of green to your space.</h5>
                <h5>Browse through our collection and get inspired to create your own indoor garden.</h5>
                
                <form method = "POST" action = "decor.php">

                <button type = "submit" class="btn btn-dark"
                style = "display: block; margin: 5% auto; margin-left: 35%;">Redirect to Decor</submit>

                </form>
            </div>

        </div> 
        
        <div class = "card4">

            <div class = "left-card4">

            <h1 style = "text-align: center; margin-left: 25px;">Explore</h1>
                <br>
                <h5>Explore the world of plants with our informative plant guide.</h5>
                <h5>From succulents to ferns, we've compiled a wealth of information to help you discover new plants to add to your home.</h5>
                <h5>Our guide is sure to provide you with inspiration and knowledge</h5>
                
                <form method = "POST" action = "explore.php">

                <button type = "submit" class = "btn btn-primary"
                style = "display: block; margin: 5% auto; margin-left: 47%;">Explore</submit>

                </form>
           
            </div>

            <div class = "right-div">
            </div>

        </div> 

        <div class = "card5">

            <div class = "left-card5">
                <h2>Sign up</h2>
                <h7>Make a free account and get access to more knowledge!</h7>

                <form method = "POST" action = "register.php"> 
                <button type="submit" class="btn btn-secondary"
                style = "margin-top: 5%; margin-bottom: 5%;">Register</button>
                </form>
            </div>

            <div class = "right-card5">
                <h2>Sign in</h2>
                <h7>Sign in to get access to information about different plants that you can grow!</h7>
                
                <form method = "POST" action = "login.php"> 
                <button type="submit" class="btn btn-secondary"
                style = "margin-top: 5%; margin-bottom: 5%;">Login</button>
                </form>

            </div>

        </div> 

    </body>

</html> -->

<!DOCTYPE html>
<html>
    <head>
        <style>
            body{
                margin: 0;
                padding: 0;
                background-color: #0A192F;
            }
            .maininfo{
                border-radius: 10px;
                width: 90%;
                margin: auto;
                margin-top: 10vh;
                margin-bottom: 10vh;
            }
            .maininfo p{
                color: white;
                width: 95%;
                margin: auto;
                text-align: center;
                font-size: 3.5vh;
                padding: 3vh;
            }

            .shopcard{
                background-color: #DFE667;
                border-radius: 10px;
                height: 40vh;
                width: 40%;
                margin-left: auto;
                margin-right: 5%;
                margin-bottom: 5vh;
                box-shadow: rgb(20, 20, 20) 0px 5px 15px;
            }
            
            .chatcard{
                background-color: #20525C;
                border-radius: 10px;
                height: 35vh;
                box-shadow: rgb(20, 20, 20) 0px 5px 15px;
                width: 40%;
                margin-right: auto;
                margin-left: 5%;
                margin-bottom: 5vh;
            }

            .infocard{
                background-color: #7EA310;
                border-radius: 10px;
                height: 35vh;
                margin-right: 5%;
                width: 40%;
                box-shadow: rgb(20, 20, 20) 0px 5px 15px;
                margin-left: auto;
                margin-bottom: 5vh;
            }
            .loginsignup{
                margin-top: 10vh;
                display: grid;
                grid-template-columns: 1fr 1fr;
                margin-bottom: 15vh;
                justify-content: space-around;
            }
            .logindiv{
                margin: auto;
                background-color: #DFE667;
                border-radius: 10px;
                width: 40%;
                height: 40vh;
                box-shadow: rgb(20, 20, 20) 0px 5px 15px;
            }
            .registerdiv{
                margin: auto;
                background-color: #DFE667;
                border-radius: 10px;
                box-shadow: rgb(20, 20, 20) 0px 5px 15px;
                width: 40%;
                height: 40vh;
            }
            .footer{
                margin-top: 10vh;
                background-color: #213502;
                width: 100%;
                box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
                height: 30vh;
            }
            .linediv{
                background-color: #54C2CC;
                height: 40vh;
                width: 5px;
                margin-left: 25%;
            }
            .linediv2{
                background-color: #54C2CC;
                height: 40vh;
                width: 5px;
                margin-right: 25%;
            }
            .seconddiv{
                display: flex;
            }
            .shopcard p{
                font-size: 3vh;
                width: 95%;
                margin: auto;
                color: black;
                text-align: center;
            }
            .chatcard p{
                font-size: 3vh;
                width: 95%;
                margin: auto;
                color: white;
                text-align: center;
            }
            .shopcard{
                padding: 2vh;
            }
            .shopcard h2{
                color: black;
                margin: 0;
                margin-top: 5%;
                padding: 1vh;
                text-align: center;
            }
            .infocard{
                padding: 2vh;
            }
            .infocard h2{
                color: black;
                margin: 0;
                margin-top: 5%;
                padding: 1vh;
                text-align: center;
            }
            .infocard p{
                font-size: 3vh;
                width: 95%;
                margin: auto;
                color: black;
                text-align: center;
            }
            .chatcard{
                padding: 2vh;
            }
            .chatcard h2{
                color: white;
                margin: 0;
                margin-top: 5%;
                padding: 1vh;
                text-align: center;
            }
            a{
                text-decoration: none;
            }
            .logindiv img{
                width: 5vw;
                display: flex;
                margin: auto;
                justify-content: center;
            }
            .logindiv p{
                font-size: 4vh;
                font-weight: bold;
                color: black;
                text-align: center;
            }
            .registerdiv img{
                width: 5vw;
                display: flex;
                margin: auto;
                justify-content: center;
            }
            .registerdiv p{
                font-size: 4vh;
                font-weight: bold;
                color: black;
                text-align: center;
            }
            .shopcard:hover{
                scale: 0.95;
            }
            .infocard:hover{
                scale: 0.95;
            }
            .chatcard:hover{
                scale: 0.95;
            }
            .logindiv:hover{
                scale: 0.95;
            }
            .registerdiv:hover{
                scale: 0.95;
            }
        </style>
    </head>
    <body>
        <div class="maininfo"><p>
            Welcome to our online plant store, your one-stop destination for bringing the freshness and beauty of nature into your home, office, or any space that needs a touch of greenery. Our extensive collection features a wide variety of plants meticulously selected to cater to all your green thumb needs. Whether you're looking to purify the air in your living space, add a touch of luck and prosperity to your home, or simply brighten up your office desk, we have the perfect plant for you. </p>
        </div>
        <a href = "http://localhost/plantShop/shop.php">
        <div class="seconddiv">
            <div class="linediv">

            </div>
            <div class="shopcard">
                <h2>Our shop</h2>
                <p>
                    At our store, we believe in the power of plants to transform spaces and uplift spirits. Our plants are not only aesthetically pleasing but also come with detailed care instructions to ensure they thrive and flourish in their new homes. With our commitment to quality and customer satisfaction, you can trust that every plant you purchase from us will arrive in perfect condition, ready to enhance your surroundings.
                </p>
            </div>
        </div>
        </a>
        <a href = "http://localhost/plantShop/review.php">
        <div class="seconddiv">
            <div class="chatcard">
            <h2>Review your orders</h2>
                <p>We invite you to review the items you ordered. Your feedback is incredibly valuable to us and plays a crucial role in helping us improve our products and services. Each review you provide not only helps us understand your experience better but also assists other customers in making informed decisions.
                </p>
            </div>
            <div class="linediv2">

            </div>
        </div>
        </a>
        <a href = "http://localhost/plantShop/orders.php">
        <div class="seconddiv">
            <div class="linediv3">

            </div>
            <div class="infocard">
            <h2>Check your order details</h2>
                <p>
                    Take a moment to thoroughly review all the details of your order. Ensuring that everything is accurate and as expected is crucial for a smooth and satisfying shopping experience. Here, you can check the status of each item, verify quantities, and confirm delivery information.
                </p>
            </div>
        </div>
        </a>

        <div class="loginsignup">
            <a href = "http://localhost/plantShop/login.php">
            <div class="logindiv">
            <br><br>
            <br>
                <img src = "Files\152532.png">
                <p>Log In</p>
            </div>
            </a>

            <a href = "http://localhost/plantShop/register.php">
            <div class="registerdiv">
            <br><br>
            <br>
                <img src = "Files\register.png">
                <p>Sign Up</p>
            </div>
            </a>
        </div>
    </body>
</html>