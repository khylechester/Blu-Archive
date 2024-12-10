<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   
   <style>
      /* Apply black background to the entire page */
      body {
         background-color: #000;
         color: black;
         font-family: Arial, sans-serif;
         margin: 0;
         padding: 0;
      }

      /* Style for the box container to center the content */
      .box-container {
         display: flex;
         flex-wrap: wrap;
         gap: 20px;
         padding: 20px;
         justify-content: center; /* Center the boxes horizontally */
         align-items: center; /* Center the boxes vertically */
      }

      /* Style for each user box */
      .box {
         border: 2px solid red; /* Red border for each user box */
         padding: 15px;
         width: 280px; /* Adjust the width of each box */
         box-sizing: border-box;
         border-radius: 8px;
         background-color: #000;
         color: red;
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      }

      .box p {
         margin: 10px 0;
         font-size: 14px;
      }

      .box p span {
         font-weight: bold;
      }

      .delete-btn {
         background-color: red;
         color: white;
         padding: 8px 15px;
         border-radius: 4px;
         text-decoration: none;
         display: inline-block;
         margin-top: 10px;
      }

      .delete-btn:hover {
         background-color: darkred;
         cursor: pointer;
      }
   </style>

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="users">

   <h1 class="title"> user accounts </h1>

   <div class="box-container">
      <?php
         $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
         while($fetch_users = mysqli_fetch_assoc($select_users)){
      ?>
      <div class="box">
         <p> Username : <span><?php echo $fetch_users['name']; ?></span> </p>
         <p> Email : <span><?php echo $fetch_users['email']; ?></span> </p>
         <p> User Type : <span style="color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'var(--orange)'; } ?>"><?php echo $fetch_users['user_type']; ?></span> </p>
         <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">delete user</a>
      </div>
      <?php
         };
      ?>
   </div>

</section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>