# LushCore
<p>LushCore is an online plant shop offering a wide variety of beautiful plants and creative flowerpots. The shop features a diverse selection of plants to suit every taste and space.</p>

<h2>Technologies Used:</h2>
<ul>
  <li><strong>Website Development:</strong> Built using PHP.</li>
  <li><strong>Database:</strong> MySQL.</li>
  <li><strong>Local development server:</strong> XAMPP.</li>
</ul>

<h2>Key Features of the website:</h2>
<ul>
  <li><strong>User Authentication:</strong> Secure login with email ID and password.</li>
  <li><strong>Registration:</strong> Easy sign-up process requiring your name, email ID, address, and password.</li>
  <li><strong>Product Browsing:</strong> Browse the entire shop with filters to narrow down your search.</li>
  <li><strong>Detailed Product Views:</strong> View comprehensive details about individual items, including ratings and reviews from other users.</li>
  <li><strong>Shopping Cart:</strong> Add items to your cart, update quantities, and remove items as needed.</li>
  <li><strong>Order Placement:</strong> Seamlessly place orders for your selected items.</li>
  <li><strong>Order Management:</strong> View order details and cancel orders if necessary.</li>
  <li><strong>Review System:</strong> Review items you've ordered but haven't reviewed yet.</li>
</ul>

<h2>ER diagram of the project:</h2>
<image src = "https://github.com/uditisinha/LushCore/assets/123114215/73f2b63c-5b92-4caf-b4a0-86e018620b1a" />

<h2>Working demo of the project:</h2>
<video src="https://github.com/uditisinha/LushCore/assets/123114215/33aa1f10-20a9-4aac-ba79-1a1d7fc8b598" control height="320" width="240"/>
<h2>Details of every page:</h2>
<h3>Register</h3>
<p>User has to input their name, email, address and password for registering. The data inputted is cleaned and then inserted in the table 'users'. The primary key is the email. The data is inserted using the query "INSERT INTO users (name, email, address, password) VALUES ('$escaped_name', '$escaped_email', $escaped_address','$hashed_password')". If an already existing user tries to register again, they are notified that they have already registered.</p>
<h3>Login</h3>
<p>The user has to insert their email and password. The array (row) with email equal to the input email is fetched using 'mysqli_fetch_array()' and the password of that row is compared with the input password using the 'password_verify()' function. If these passwords match then the user is authenticated and session is started using 'session_start()', a variable 'email' is stored in the session using '$_SESSION['email'] = $email' and a variable 'loggedin' is set to True using '$_SESSION['loggedin'] = True'. If no row is found with the email inputted by user then they are notified that they have to register.</p>
<h3>Shop</h3>
<p>In the shop section all the items in the 'shop' table are displayed using a while loop that iterates over the result of 'SELECT * FROM shop'. The name, image, price and rating for each item is showed. There are also filters given based on item price, item type and item rating. According to the filters selected by user the items are displayed, with each filter restricting the SELECT condition. Example: "SELECT * FROM shop WHERE item_price < '$sort_price'", where sort_price is the user's filter selection for price.</p>
<h3>Item</h3>
<p>When user selects an item in the shop section, a dynamic url is created using the item_ID 'href = "item.php?id=<?php echo $row['item_ID']; ?>"'. In the item page, the details of the item is visible: image, name, item description, price and rating. All ratings and reviews by different users is displayed in the reviews section along with the date of review submission. This is done by selecting rows with item_ID, same as provided item_ID, in the 'reviews' table and iterating over the result of "SELECT * FROM reviews WHERE item_ID = '$item_ID'". If the logged in user has previously bought the item but hasn't reviewed the item they are shown the option to add a review. Once they add a rating and submit the review, the rating and review that they provided along with their email is stored in the reviews table (the email and item_ID are the composite keys). Then, the rating of the item is recomputed by finding all rows with that item_ID in the 'reviews' table, then summing the value of rating for all these rows and dividing by the number of rows to find the average rating of that item ("Rating: ".$row['item_rating']." / 5 "." (".$num_rows." reviews)"). This rating is then updated in the 'shop' table for that item (UPDATE shop SET item_rating = '$rating_avg' WHERE item_ID = '$item_ID'). There's an option to select quantity and add that item to cart. The 'cart' table contains email, item_ID, item quantity and total price of that item.</p>
<h3>Cart</h3>
<p>The rows in the 'cart' table with the user's email are displayed in the cart page. The user can update quantity for the any item(s) using "UPDATE cart SET item_quantity = '$quantity_update', total_price = '$total_price' WHERE item_ID = '$item_ID' AND email = '$email'" or remove it. The total price is displayed. When the user clicks on 'Place Order' button, the data in the 'cart' table for each item along with user's address, and delivery status are added in the 'order' table using "INSERT INTO orders (email, item_ID, item_quantity, total_price, address, delivery_status) VALUES ('$email', '$item_ID', '$item_quantity', '$total_price', '$address', 'DELIVERING')". An auto updating primary key field called 'order_ID' is also inserted in the 'orders' table. Each instance of the 'orders' table has a single item_ID.</p>
<h3>Orders</h3>
<p>All rows from the 'orders' table with the user's email are displayed if the order is not cancelled. User can cancel any order using the 'Cancel Order' button. The delivery_status in the 'orders' table will then be updated to 'CANCELLED' using "UPDATE orders SET delivery_status = 'CANCELLED' WHERE order_ID = '$order_ID' AND email = '$email'".</p>
<h3>Reviews</h3>
<p>All the items that the user has ordered but hasn't reviewed is displayed in this page using "SELECT DISTINCT o.item_ID, o.order_date, o.total_price FROM orders o LEFT JOIN reviews r ON o.item_ID = r.item_ID AND o.email = r.email WHERE o.email = '$email' AND r.item_ID IS NULL AND o.delivery_status = 'DELIVERING';". They can select any item in that page and the item page for that item will be opened, where they can give their review.</p>
<h3>Add items</h3>
<p>If the logged in user is the admin, then this page can be visited. The admin can add items in the 'shop' table from this page using "INSERT INTO shop(item_name, item_image, item_price, plant_type, item_desc) VALUES('$item_name', '$item_image', '$item_price', '$plant_type', '$item_desc');"</p>
<h3>Logout</h3>
<p>Upon clicking the logout button on the navigation bar, the user's sesion is destroyed using 'session_destroy()' and they are redirected to login page.</p>
