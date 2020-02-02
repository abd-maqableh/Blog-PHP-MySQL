<?php
include "header.php";
include "conn.php";
if (isset($_GET['categorey_id'])) {
    $categorey_id = $_GET['categorey_id'];
} else {
    header("location:index.php");
}
?>

<?php
try {
    $query = $conn->prepare("SELECT name FROM category WHERE   id=:category_id");
    $query->bindParam(":category_id", $categorey_id);
    $query->execute();
    $categorey_name = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($categorey_name as $categorey_name) {
        echo "<div class=\"container \">";
        echo "<h1 style=\"margin-top: 38px;text-transform:capitalize;\">" . $categorey_name["name"] . "</h1>";
        echo "</div>";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>

<div class="container2 row2 ">
    <div class=" col-md-8">
        <div class="under-header-c1-s1">

            <?php
         
            try {
            $query = $conn->prepare("SELECT artical.image,artical.title,artical.id FROM artical WHERE category_id = :category_id LIMIT 4");
                $query->bindParam(":category_id", $categorey_id);
                $query->execute();
                $artical = $query->fetchAll();
                if (empty($artical)) {
                    echo "<div class=\"alert alert-warning\" role=\"alert\">
                              Coming Soon.......
                        </div>";
                } else {
                    foreach ($artical as $artical) {
                        $artical_image = $artical['image'];
                        $img = "uploads/".$artical_image;
                        $artical_title = $artical['title'];
                        $artical_id = $artical['id'];
                        echo  "<a href=\"article.php?artical_id= $artical_id\" id=\"myBtn\"> <img src=\"$img \" style=\" width: 100%;\" > </a> ";
                        echo "<p><b>$artical_title</b></p>";
                    }
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            ?>
        </div>
    </div>



    <div class="col-md-4">
        <div class="under-header-c2-s1 ">
            <h3>sections</h3>
            <?php
      $query1 = 'SELECT id,name FROM category ';
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

            <img src="./blog-images/2881480.jpg" alt="deer">
            <h5>Design Agencies</h5>
            <p>3580 Views</p>
        </div>
    </div>
</div>
<br>
<br>
<br>
<br>
<?php
include "footer.php";
?>