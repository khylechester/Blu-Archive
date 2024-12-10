<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_contacts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messages</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

   <style>
      /* Styling for the messages section */
      .messages {
         padding: 20px;
         background-color: #000; /* Black background for the section */
         border-radius: 8px;
         color: #fff; /* White text for contrast */
      }

      .box-container {
         display: flex;
         flex-wrap: wrap;
         gap: 20px;
         justify-content: center;
         align-items: center;
         padding: 20px;
      }

      /* Styling for each message box */
      .box {
         background-color: #000; /* Light yellow background to highlight messages */
         padding: 20px;
         color: red; /* Dark text for better contrast */
         border-radius: 8px;
         border: 2px solid red; /* Golden border for emphasis */
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
         width: 300px; /* Fixed width for uniformity */
         margin-bottom: 20px;
      }

      .box p {
         margin: 10px 0;
         font-size: 14px;
      }

      .box p span {
         font-weight: bold;
         color: red; /* Darker text for span */
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

      /* Empty message text styling */
      .empty {
         text-align: center;
         color: #ff6347;
         font-size: 18px;
         font-weight: bold;
      }
   </style>

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="messages">

   <h1 class="title"> messages </h1>

   <div class="box-container">
   <?php
      $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
      if(mysqli_num_rows($select_message) > 0){
         while($fetch_message = mysqli_fetch_assoc($select_message)){
      
   ?>
   <div class="box">
      <p> name : <span><?php echo $fetch_message['name']; ?></span> </p>
      <p> number : <span><?php echo $fetch_message['number']; ?></span> </p>
      <p> email : <span><?php echo $fetch_message['email']; ?></span> </p>
      <p> message : <span><?php echo $fetch_message['message']; ?></span> </p>
      <a href="admin_contacts.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete message</a>
   </div>
   <?php
      };
   } else {
      echo '<p class="empty">you have no messages!</p>';
   }
   ?>
   </div>

</section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
