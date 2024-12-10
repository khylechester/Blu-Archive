<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>about us</h3>
   <p> <a href="home.php">HOME</a> / ABOUT </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/3books.jpg" alt="">
      </div>

      <div class="content">
         <h3>PROMISE</h3>
         <p>At <span>BLU ARCHIVE</span>, we promise to provide a curated, engaging, and honest space for all book lovers. Whether you’re searching for your next great read, exploring in-depth reviews, or connecting with fellow readers, we are committed to delivering high-quality, thoughtful content that enhances your reading journey. We strive to keep our recommendations fresh, our discussions welcoming, and our reviews insightful—ensuring that every visit leaves you inspired and excited about the world of books."
This promise conveys a dedication to quality, engagement, and honesty, which will help build trust and attract loyal users.
</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">client's reviews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/pic1.jpg" alt="">
         <p>This site is a treasure trove for book enthusiasts. The layout is clean and easy to navigate, and the reviews are both insightful and well-written. It's the perfect place to find your next favorite book, with a diverse range of genres and thoughtful critiques. I especially appreciate the author interviews and community discussions!.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Lolo Jobert</h3>
      </div>

      <div class="box">
         <img src="images/pic2.jpg" alt="">
         <p>I can’t recommend this site enough! It’s a one-stop destination for everything from book reviews to author recommendations. The reviews are detailed and honest, and they’ve helped me discover books I wouldn’t have found on my own. It’s also great to see a community of passionate readers sharing their opinions and experiences..</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Leina sadboi</h3>
      </div>

      <div class="box">
         <img src="images/pic3.jpg" alt="">
         <p>If you're looking for book recommendations, this site is a goldmine. The reviews are thorough and well-balanced, covering everything from plot details to character development. Plus, the site features books from all genres, making it easy to find something new, whether you're into thrillers, romance, or science fiction.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Marijo</h3>
      </div>

      <div class="box">
         <img src="images/pic4.jpg" alt="">
         <p>As someone who loves reading, I find this site to be an invaluable resource. The reviews are honest and detailed, helping you make informed decisions about what to read next. I also appreciate the clean design and easy navigation. Whether you're a casual reader or a book aficionado, this site has something for everyone</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Icream dila</h3>
      </div>

      <div class="box">
         <img src="images/pic5.jpg" alt="">
         <p>I absolutely love this site! The reviews are always insightful and engaging, providing a deep dive into both the stories and the writing styles. It’s clear the team behind this site truly loves books, and that passion shines through in every post. It’s become my go-to place for discovering new books and connecting with fellow readers..</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Boy ngiti</h3>
      </div>

      <div class="box">
         <img src="images/pic6.jpg" alt="">
         <p>This site has created an amazing community of readers who share their thoughts, opinions, and recommendations. The reviews are thorough and often highlight both the strengths and weaknesses of each book, which I really appreciate. The discussions in the comment sections are also a fun way to connect with other book lovers.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Kayli</h3>
      </div>

   </div>

</section>

<section class="authors">

   <h1 class="title">FAMOUS artist</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/author-1.jpg" alt="">
         <div class="share">
            <a href="https://en.wikipedia.org/wiki/William_Shakespeare" class="fa-brands fa-wikipedia-w"></i></a>
     
         </div>
         <h3>William Shakespeare</h3>
      </div>

      <div class="box">
         <img src="images/author-2.jpg" alt="">
         <div class="share">
            <a href="https://en.wikipedia.org/wiki/Victor_Hugo" class="fa-brands fa-wikipedia-w"></a>
    
         </div>
         <h3>Victor Hugo</h3>
      </div>

      <div class="box">
         <img src="images/author-3.jpg" alt="">
         <div class="share">
            <a href="https://en.wikipedia.org/wiki/Friedrich_Nietzsche" class="fa-brands fa-wikipedia-w"></a>
  
         </div>
         <h3>Friedrich Nietzsche</h3>
      </div>

      <div class="box">
         <img src="images/author-4.jpg" alt="">
         <div class="share">
            <a href="https://en.wikipedia.org/wiki/Marcel_Proust" class="fa-brands fa-wikipedia-w"></a>
   
         </div>
         <h3>Marcel Proust</h3>
      </div>

      <div class="box">
         <img src="images/author-5.jpg" alt="">
         <div class="share">
            <a href="https://en.wikipedia.org/wiki/Nathaniel_Hawthorne" class="fa-brands fa-wikipedia-w"></a>
       
         </div>
         <h3>Nathaniel Hawthorne</h3>
      </div>

      <div class="box">
         <img src="images/author-6.jpg" alt="">
         <div class="share">
            <a href="https://en.wikipedia.org/wiki/Harper_Lee" class="fa-brands fa-wikipedia-w"></a>
         
         </div>
         <h3>Harper Lee</h3>
      </div>

   </div>

</section>







<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>