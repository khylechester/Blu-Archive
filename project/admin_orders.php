<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['update_order'])){

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
   $message[] = 'payment status has been updated!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

   <style>
      /* Styling for the orders section */
      .orders {
         padding: 20px;
         background-color: #111; /* Dark background */
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

      /* Styling for each order box */
      .box {
         background-color: red; /* Light yellow background to highlight orders */
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

      .box form {
         margin-top: 10px;
         display: flex;
         flex-direction: column;
         gap: 10px;
      }

      .box select {
         padding: 8px;
         border-radius: 4px;
         font-size: 14px;
         margin-top: 10px;
      }

      .box .option-btn {
         padding: 10px 15px;
         background-color: #4CAF50;
         color: white;
         border: none;
         border-radius: 4px;
         cursor: pointer;
         font-size: 14px;
      }

      .box .delete-btn {
         background-color: red;
         color: white;
         padding: 8px 15px;
         border-radius: 4px;
         text-decoration: none;
         margin-top: 10px;
         display: inline-block;
         cursor: pointer;
      }

      .box .delete-btn:hover {
         background-color: darkred;
      }

      /* Empty orders text */
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

<section class="orders">

   <h1 class="title">placed orders</h1>

   <div class="box-container">
      <?php
      $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
      if(mysqli_num_rows($select_orders) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
      <div class="box">
         <p> user id : <span><?php echo $fetch_orders['user_id']; ?></span> </p>
         <p> placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> name : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> number : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> address : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> total products : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> total price : <span>₱<?php echo $fetch_orders['total_price']; ?></span> </p>
         <p> payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <form action="" method="post">
            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
            <select name="update_payment">
               <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
               <option value="pending">pending</option>
               <option value="completed">completed</option>
            </select>
            <input type="submit" value="update" name="update_order" class="option-btn">
            <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('delete this order?');" class="delete-btn">delete</a>
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
   </div>

</section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
