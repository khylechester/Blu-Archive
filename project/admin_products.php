<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = $_POST['price'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'product name already added';
   }else{
      $add_product_query = mysqli_query($conn, "INSERT INTO `products`(name, price, image) VALUES('$name', '$price', '$image')") or die('query failed');

      if($add_product_query){
         if($image_size > 2000000){
            $message[] = 'image size is too large';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'product added successfully!';
         }
      }else{
         $message[] = 'product could not be added!';
      }
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_products.php');
}

if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];

   mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price' WHERE id = '$update_p_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image file size is too large';
      }else{
         mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/'.$update_old_image);
      }
   }

   header('location:admin_products.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

   <!-- Internal CSS for Show and Update Product Sections -->
   <style>
      /* Red borders for inputs and buttons in Add and Update Product Forms */
      .add-products input[type="text"], 
      .add-products input[type="number"], 
      .add-products input[type="file"], 
      .add-products input[type="submit"],
      .add-products input[type="reset"],
      .edit-product-form input[type="text"], 
      .edit-product-form input[type="number"], 
      .edit-product-form input[type="file"],
      .edit-product-form input[type="submit"],
      .edit-product-form input[type="reset"] {
         border: 2px solid red; /* Red border for all these fields */
         border-radius: 8px; /* Optional: rounded corners */
      }

      /* Change border color on hover */
      .add-products input[type="text"]:hover, 
      .add-products input[type="number"]:hover, 
      .add-products input[type="file"]:hover, 
      .add-products input[type="submit"]:hover, 
      .add-products input[type="reset"]:hover, 
      .edit-product-form input[type="text"]:hover, 
      .edit-product-form input[type="number"]:hover, 
      .edit-product-form input[type="file"]:hover, 
      .edit-product-form input[type="submit"]:hover, 
      .edit-product-form input[type="reset"]:hover {
         border-color: #ff5733; /* Darker red on hover */
      }

      /* Show products section with black background */
      .show-products {
         background-color: #000; /* Black background */
         padding: 20px;
         color: #fff; /* White text */
      }

      /* Red border for product display boxes */
      .show-products .box {
         border: 2px solid red; /* Red border around each product */
         border-radius: 8px; /* Optional: rounded corners */
         padding: 10px; /* Added padding for spacing */
         margin-bottom: 20px; /* Space between products */
         background-color: #333; /* Dark background for product boxes */
      }

      /* Red border for product name and price */
      .show-products .name, 
      .show-products .price {
         padding: 10px;
         background-color: #222; /* Darker background for name/price */
         border: 2px solid red;
         border-radius: 8px;
      }

      /* Red border for "update" and "delete" buttons */
      .show-products .option-btn, 
      .show-products .delete-btn {
         border: 2px solid red; /* Red border for buttons */
         border-radius: 5px;
         padding: 5px 15px;
         text-decoration: none;
      }

      /* Red border for "update" and "delete" buttons on hover */
      .show-products .option-btn:hover, 
      .show-products .delete-btn:hover {
         background-color: red;
         color: #fff;
         border-color: darkred;
      }
      .add-products {
         padding: 20px;
         color: #fff; /* White text */
         border-radius: 8px;
         border: 2px solid red; /* Red border around the update form */
      }

      .show-products {
         padding: 20px;
         color: #fff; /* White text */
         border-radius: 8px;
         border: 2px solid red; /* Red border around the update form */
      }

      /* Update product section with black background */
      .edit-product-form {
         background-color: #000; /* Black background for the form */
         padding: 20px;
         color: #fff; /* White text */
         border-radius: 8px;
         border: 2px solid red; /* Red border around the update form */
      }

      /* Style for the update input fields */
      .edit-product-form input[type="text"],
      .edit-product-form input[type="number"],
      .edit-product-form input[type="file"] {
         background-color: #222; /* Dark background for inputs */
         color: #fff; /* White text in inputs */
         padding: 10px;
         border: 2px solid red; /* Red border for inputs */
         border-radius: 8px;
         width: 100%; /* Make the inputs full-width */
         margin-bottom: 10px;
      }

      /* Button styles for update form */
      .edit-product-form input[type="submit"], 
      .edit-product-form input[type="reset"] {
         border: 2px solid red;
         background-color: black;
         color: white;
         padding: 10px;
         border-radius: 8px;
         cursor: pointer;
      }

      /* Buttons hover effect */
      .edit-product-form input[type="submit"]:hover, 
      .edit-product-form input[type="reset"]:hover {
         background-color: red;
         color: white;
         border-color: darkred;
      }
   </style>
</head>
<body>
   
<?php include 'admin_header.php'; ?>

<!-- product CRUD section starts  -->

<section class="add-products">

   <h1 class="title">shop products</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <h3>add product</h3>
      <input type="text" name="name" class="box" placeholder="Enter product name" required>
      <input type="number" min="0" name="price" class="box" placeholder="Enter product price ₱" required>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <input type="submit" value="add product" name="add_product" class="btn">
   </form>

</section>

<!-- product CRUD section ends -->

<!-- show products  -->

<section class="show-products">

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="box">
         <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <div class="price">₱<?php echo $fetch_products['price']; ?></div>
         <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">update</a>
         <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

</section>

<section class="edit-product-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <section class="edit-product-form">

   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
      <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="enter product name">
      <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="enter product price">
      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="update" name="update_product" class="btn">
      <input type="reset" value="cancel" id="close-update" class="option-btn">
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>
</section>

</section>

<script src="js/admin_script.js"></script>

</body>
</html>
