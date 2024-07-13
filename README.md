# LushCore
<p>LushCore is an online plant shop offering a wide variety of beautiful plants and creative flowerpots. The shop features a diverse selection of plants to suit every taste and space.</p>

<h2>Technologies Used</h2>
<ul>
  <li><strong>Website Development:</strong> Built using PHP.</li>
  <li><strong>Database:</strong> MySQL.</li>
  <li><strong>Local development server:</strong> XAMPP.</li>
</ul>

<h2>Key Features</h2>
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
<video src="https://github.com/uditisinha/LushCore/assets/123114215/33aa1f10-20a9-4aac-ba79-1a1d7fc8b598"/>

<h2>Details of every page:</h2>
<h3>Register</h3>
<p>User has to input their name, email, address and password for registering. The data inputted is cleaned and then inserted in the table 'users'. The primary key is the email. The data is inserted using the query "INSERT INTO users (name, email, address, password) VALUES ('$escaped_name', '$escaped_email', $escaped_address','$hashed_password')". If an already existing user tries to register again, they are notified that they have already registered.</p>
<h3>Login</h3>
<p>The user has to insert their email and password. The array (row) with email equal to the input email is fetched using 'mysqli_fetch_array()' and the password of that row is compared with the input password using the 'password_verify()' function. If these passwords match then the user is authenticated and session is started using 'session_start()' and a variable 'email' is stored in the session using '$_SESSION['email'] = $email' and a variable 'loggedin' is set to True using '$_SESSION['loggedin'] = True'. If no row is found with the email inputted by user then they are notified that they have to register.</p>
<h3>Shop</h3>
<h3>Cart</h3>
<h3>Item</h3>
<h3>Orders</h3>
<h3>Reviews</h3>
<h3>Add items</h3>
<h3>Logout</h3>
