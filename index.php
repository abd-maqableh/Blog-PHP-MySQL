<?php
include "header.php";
require_once 'conn.php';



?>
<div class="slider-show single-item">
  <?php

  try {

    $query = $conn->prepare("SELECT artical.id,artical.image,artical.title FROM artical WHERE artical.showslider = 1 ORDER BY RAND() LIMIT 3");
    $query->execute();

    if ($query->rowCount()) {
      while ($data = $query->fetch(PDO::FETCH_ASSOC)) {

        $img = $data['image'];
        $img2 = "uploads/" . $img;
        $title = $data['title'];
        $artical_id = $data['id'];
        echo "<div style=\"background-image: url($img2); \" class=\"slider-img\"> 
                  <a class=\" title\" href=\"article.php?artical_id=$artical_id \"> $title </a>
                </div>";
      }
    }
  } catch (Exception $e) {
    echo $e->getMessage();
  }
  ?>
</div>

<script>
  $('.single-item').slick({
    arrows: true,
    dots: true
  });
</script>

<!-- under header  -->
<div class="container under-header ">
  <div class=" under-header-c11">
    <div class="section1">
      <?php
      $limit = 3;
      if (isset($_GET['offset'])) {
        $limit += 3;
        echo $limit;
      }
      try {

        $query = $conn->prepare("SELECT artical.id, artical.description,artical.image,artical.title,category.name,artical.category_id FROM artical INNER JOIN category ON artical.category_id=category.id LIMIT  {$limit}");
        $query->execute();

        if ($query->rowCount()) {
          while ($data = $query->fetch(PDO::FETCH_ASSOC)) {

            $description = $data['description'];
            $des_slice = substr($description, 0, 300);
            $img = $data['image'];
            $img2 = "uploads/" . $img;
            $title = $data['title'];
            $category_name = $data['name'];
            $category_id = $data['category_id'];
            $artical_id = $data['id'];
            echo "<img src=\"$img2\" class=\"img2-c1\">";
            echo "<a class=\"devlopment\" href=\"section.php?categorey_id=$category_id \">$category_name</a>";
            echo "<h1 class=\"head-line1\">$title</h1>";
            echo "<p>$des_slice</p>";
            echo "<a href=\"article.php?artical_id= $artical_id\" id=\"myBtn\"> Read more>> </a>";
          }
        } else {
          echo "No data was found in our records";
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
      ?>
    </div>
  </div>

  <!-- under-header-c2 -->
  <div class="under-header-c2">
    <div class="under-header-c2-s1 ">
      <h3>sections</h3>
      <?php
      $query1 = 'SELECT id,name FROM category';
      $stm = $conn->prepare($query1);
      $stm->execute();

      if ($stm->rowCount()) {
        $cate = $stm->fetchAll();
        foreach ($cate as $cate) {
          $category_id = $cate['id'];
          $category_name = $cate['name'];
          $query = "SELECT count(*) FROM artical WHERE artical.category_id = {$category_id} ";
          $stm = $conn->prepare($query);
          $stm->execute();
          $number_of_artical = $stm->fetch();

          echo "<li><a class=\"below-nav\" href=\"section/$category_id\">$category_name</a> <samll>($number_of_artical[0]) </small></li>";
        }
      }

      ?>
    </div>


    <div class="under-header-c2-s2">
      <h3>popural artical</h3>
      <img src="./blog-images/5b67ee95d566e.jpeg" alt="deer">
      <h5>E-Commerce</h5>
      <p>6001 Views</p>

      <div class="img-opcity">
        <img src="./blog-images/5b39e6babeef6.jpg" alt="deer">
        <h5>Design Agencies</h5>
        <p>3580 Views</p>
      </div>

      <img src="./blog-images/5b6955226700d.png" alt="deer">
      <h5>Design Agencies</h5>
      <p>3580 Views</p>
    </div>
  </div>
</div>
<br>
<br>
<div style="margin-top: 120px;">
  <a href="index.php?offset=3" id="show_sec"> show more </a>
  <i class="fas fa-chevron-down" style=" color: rgb(51, 236, 51);"></i>
</div>
<br>
<br>
<!-- start the footer -->
<?php
include "footer.php";
?>