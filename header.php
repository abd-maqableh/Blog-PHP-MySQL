<?php
session_start();
require_once 'conn.php';
if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>blog</title>
  <link rel="icon" href="blog-images/sprintive-logo.png" type="image/png" sizes="16x16">

  <link rel="stylesheet" href="style/all.min.css">
  <link rel="stylesheet" href="style/register.css">
  <link rel="stylesheet" href="style/login.css">
  <link rel="stylesheet" href="style/article.css">
  <link rel="stylesheet" href="style/section.css">
  <link rel="stylesheet" href="style/post.css">
  <link rel="stylesheet" href="style/slick.css">
  <link rel="stylesheet" href="style/slick-theme.css">

  <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script type="text/javascript" src="script/sctipt.js  "></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="script/jquery.js "></script>
  <script type="text/javascript" src="script/slick.min.js  "></script>
 
 

</head>

<body>

  <div class="container">
    <!-- start the header -->
    <!-- Header -->
    <div class="header">
      <div class="logo">
        <h1><b><?php if (isset($_SESSION['user'])) {
                  echo "Welcome " .  $user;
                } else {
                  echo "Blog";
                } ?></b> </h1>
      </div>
      <ul class="nav">
        <li><i class="fas fa-search"></i></li>
        <?php
        if (isset($_SESSION['user'])) {
          echo "<li><a href=\"logout.php\">Logout</a></li>
                       <li><a href=\"post.php\" type=\"button\" name=\"button\" class=\"btn btn-primary\">Get started</a></li>";
        } else {
          echo "<li><a href=\"login.php\">Sign In</a></li>
                        <li><a href=\"register.php\">Become a member </a></li>";
        }
        ?>


      </ul>
      <div class="clear"></div>
    </div>
  </div> <!-- end the header -->

  <hr class="hor-line">
  <!-- below the nav bar -->

  <div class="container">
    <!-- start the link -->
    <ul class="below-hr-line1">
      <li> <a class="below-nav active" href="index.php">HOME</a> </li>
      <li><a class="below-nav" href="section.php?categorey_id=1">ARCHITECTURE</a></li>
      <li><a class="below-nav" href="section.php?categorey_id=2">ART & ILLUSTAATION</a></li>
      <li><a class="below-nav" href="section.php?categorey_id=3">BUSINESS & CORPORATE</a></li>
      <li><a class="below-nav" href="section.php?categorey_id=4">CULTURE & EDUCATION</a></li>
      <li> <a class="below-nav" href="section.php?categorey_id=5">E-COMMERCE</a></li>
      <li><a class="below-nav" href="section.php?categorey_id=6">DESIGN AGENCIES</a></li>
    </ul> <!-- end below the nav bar class="below-nav" -->

    <!-- slider -->

  </div><!-- end the link -->