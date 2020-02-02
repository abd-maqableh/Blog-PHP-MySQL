<?php

include "header.php";
require_once 'conn.php';
if (isset($_SESSION['user'])) {
    $user_id = $_SESSION["user_id"];
}
if (isset($_GET['artical_id'])) {
    $artical_id = $_GET['artical_id'];
} else {
    header("location:index.php");
}
?>

<?php
try {
    $query = $conn->prepare("SELECT  * FROM artical WHERE  id =  :artical_id");
    $query->bindParam(":artical_id", $artical_id);
    $query->execute();
    

   
    if ($query->rowCount()) {
        
        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {   
         
            $description = $data['description'];
            $img = $data['image'];
            $img2 = "uploads/" . $img;
            $created_at = $data['created_at'];
            $title = $data['title'];
            $artical_id = $data['id'];

            echo " <div class=\"section1\">
                     <img src=\" $img2\" alt=\"\" class=\"section1-img\">
                        </div>";
            echo " <div class=\"container\">";
            echo "<div class=\"under-section1\">";
            echo "<h1 class=\"head-line1\">$title</h1>";
            echo "<p>$created_at</p>";
            echo "<p> $description</p>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "No data was found in our records";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>

<div class="section3">
    <div class="container2">
        <h1>Comments</h1>
        

        <?php
        try {
            $query = $conn->prepare("SELECT comment.description comm, user.username u  FROM comment 
                                    LEFT JOIN user ON user.id = comment.user_id WHERE :artical_id = comment.artical_id");
            $query->bindParam(":artical_id", $artical_id);
            $query->execute();
            $number_of_comment=$query->rowCount();
            $comments = $query->fetchAll();
            echo "<p class=\"number-of-comments\">($number_of_comment)</p>";
            if (empty($comments)) {
                echo " <div class=\"alert alert-danger\" role=\"alert\">
                            No Comments for this article
                        </div>";
            }
            foreach ($comments as $comment) {
                echo  "<div class=\"paragraph\">   
                <p>" . $comment['u'] . "</p>";
                echo "<p>" . length_of_comment($comment['comm']) . "</p>";
                echo "</div>";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        ?>

        <?php
        function length_of_comment($str)
        {

            if (strlen($str) > 300) {
                return substr($str, 0, 300);
            } else {
                return $str;
            }
        }
        ?>


        <!-- --------------------------------section 3 ------------------------------------------>
        <div class="join-form">
            <h1>Join the discussion</h1>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <textarea class="form-control1" name="comment" placeholder="Your comment" cols="30" rows="10"></textarea>
                </div>

                <div>
                    <button type="submit" class="btn btn-success" name="add-comment">ADD COMMENT</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php


if (isset($_POST['add-comment']) && isset($_SESSION['user'])) {
    if ($_POST['comment'] != "") {
        try {
            $comment = $_POST['comment'];
            $store = $conn->prepare('INSERT INTO comment (description,user_id,artical_id) VALUES (:description ,:user_id,:artical_id)');
            $store->bindParam(":description", $comment);
            $store->bindParam(":user_id", $user_id);
            $store->bindParam(":artical_id",  $artical_id);
            if ($store->execute()) {
?>
                <script>
                    alert("comment add Successfully");
                    window.location.href = ('article.php');
                </script>
            <?php
            } else {


            ?>
                <script>
                    alert("Error");
                    window.location.href = ('article.php');
                </script>
<?php
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $conn = null;
        header('location:article.php');
    } else {
        echo " <div class=\"alert alert-danger\" role=\"alert\">
                    Please fill up the required field
                </div>";
    }
} elseif (isset($_POST['add-comment']) && !isset($_SESSION['user'])) {
    echo " <div class=\"alert alert-danger\" role=\"alert\">
                    Please Sign in or Register in the Website
                </div>";
}
?>
<div class="container2">
    <h1>Similar Artical</h1>
    <div class="img4">
        <?php
        try {
            $query = $conn->prepare("SELECT artical.id,artical.image,artical.title FROM artical ORDER BY RAND() LIMIT 4");
            $query->execute();

            if ($query->rowCount()) {
                
                while ($data = $query->fetch(PDO::FETCH_ASSOC)) {

                    $img = $data['image'];
                    $img2 = "uploads/" . $img;
                    $title = $data['title'];
                    $artical_id = $data['id'];
                    echo "<a href=\"article.php?artical_id=$artical_id\"> <img src=\"$img2 \" class =\" similar-artical \"> </a>";
                    // echo "<p style=\"font-size: 15px;\" class =\" similar-artical \"><b>$title</b></p>";
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

<br>
<br>
<br>

<?php
include "footer.php";
?>