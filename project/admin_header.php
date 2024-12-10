<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">
   <div class="flex">
      <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="admin_page.php">Home</a>
         <a href="admin_products.php">Products</a>
         <a href="admin_orders.php">Orders</a>
         <a href="admin_users.php">Users</a>
         <a href="admin_contacts.php">Messages</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>Username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>Email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logout.php" class="delete-btn">logout</a>
         <div>New <a href="login.php"> Login </a>  |  <a href="register.php"> Register</a></div>
      </div>
   </div>
</header>

<!-- Internal CSS for navbar and account box -->
<style>
   /* Import Google Font */
   @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

   /* Navbar styling */
   header .navbar {
      background-color: black;   /* Black background for the navbar */
      padding: 10px 20px;
      display: flex;
      justify-content: space-around;
      align-items: center;
      border: 3px solid red;     /* Red border around the navbar */
      border-radius: 5px;        /* Optional: Rounded corners for the border */
      font-family: 'Roboto', sans-serif; /* Apply the Roboto font */
   }

   header .navbar a {
      color: red;                /* Red text for links */
      font-size: 16px;
      font-weight: 500;          /* Medium weight for the text */
      text-decoration: none;
      padding: 10px 20px;
      border-radius: 5px;
      transition: background-color 0.3s ease, color 0.3s ease;
   }

   /* Hover effect for navbar links */
   header .navbar a:hover {
      background-color: red;     /* Red background on hover */
      color: white !important;   /* Force text color to white on hover */
   }

   /* Active link styling */
   header .navbar a.active {
      color: black;              /* Active link will have black text */
      background-color: red;     /* Active link will have red background */
   }

   /* Styling the logo */
   .header .logo {
      font-family: 'Roboto', sans-serif; /* Ensure logo uses the same font */
      font-size: 24px;
      font-weight: 700; /* Bold logo text */
      color: white;
      text-decoration: none;
   }

   .header .logo span {
      color: red; /* Red color for the "Panel" part of the logo */
   }

   /* Account Box Styling */
   .account-box {
      background: linear-gradient(to right, red, black); /* Red to black gradient background */
      color: white;              /* White text color */
      padding: 20px;
      border: 2px solid red;     /* Red border around the account box */
      border-radius: 8px;        /* Rounded corners for the box */
      position: absolute;
      top: 50px;
      right: 20px;
      width: 250px;              /* Set width of the account box */
      font-family: 'Roboto', sans-serif; /* Roboto font for account box */
      text-align: left;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2); /* Optional: Add a subtle shadow */
   }

   .account-box p {
      font-size: 14px;
      margin: 10px 0;
   }

   .account-box span {
      color: yellow;  /* Change the text color for username and email to yellow */
      font-weight: bold;  /* Make username/email bold */
   }

   .account-box a.delete-btn {
      display: inline-block;
      background-color: black;  /* Black background for logout button */
      color: red;            /* Red text for logout button */
      padding: 8px 15px;
      margin-top: 15px;
      border-radius: 5px;
      text-decoration: none;
      font-weight: 500;
      transition: background-color 0.3s ease;
   }

   .account-box a.delete-btn:hover {
      background-color: darkred; /* Darker red on hover */
      color: white; /* Change text color to white when hovered */
   }

   /* Additional small links under logout */
   .account-box div {
      font-size: 12px;
      margin-top: 10px;
   }

   .account-box div a {
      color: yellow;  /* Yellow color for login/register links */
      text-decoration: none;
   }

   .account-box div a:hover {
      text-decoration: underline;  /* Underline on hover */
   }
</style>
