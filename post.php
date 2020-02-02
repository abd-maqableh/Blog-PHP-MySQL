<?php
require_once 'conn.php';
include "header.php";
$user_id = $_SESSION["user_id"];
?>

<div class="join-form container">
    <h1>what are you think</h1>
    <form enctype="multipart/form-data" action="" method="post">
        <div>
            <input name="title" type="text" class="title" placeholder="write title of article " />
        </div>
        <div>
            <h4>article Content</h4>
            <textarea name="description" class="form-control1" cols="30" rows="10"></textarea>
        </div>


        <div>
            <h4 style="margin-top: 25px;">Upload Image</h4>
            <input type="file" name="image" class="file">
        </div>
        <div class="select">
            <h4 style="margin-top: 25px;">Select Categorey</h4>
            <select name="category_id">
                <option value="">select category...</option>
                <option value="1">architecture</option>
                <option value="2">Art& illustration </option>
                <option value="3">business & corporate</option>
                <option value="4">culture & education</option>
                <option value="5">E-commerce</option>
                <option value="6">design agencies</option>
            </select>
        </div>
        <div >
            <input type="checkbox"  name="showslider"  value="1">
            <span >Show in The Slider</span>
        </div>
        <div>
            <div>
                <button type="submit" class="button1" name="publish">Publish</button>
            </div>
    </form>
</div>
</div>

<br>
<br>
<br>

<?php

if (isset($_POST['publish'])) {

    if ($_POST['description'] != "" ||  $_POST['category_id'] != "") {
        try {
            $description = $_POST['description'];
            $category_id = $_POST['category_id'];
            $showslider =$_POST['showslider'];
            $title = $_POST['title'];
            $img = $_FILES['image']['name'];
            $tmp_dir = $_FILES['image']['tmp_name'];
            $img_size = $_FILES['image']['size'];
            $path_img = "uploads/";

            $imgExt = strtolower(pathinfo($img, PATHINFO_EXTENSION));

            $pic = rand(1000, 1000000) . "." . $imgExt;

            move_uploaded_file($tmp_dir, $path_img . $pic);
            $store = $conn->prepare('INSERT INTO artical(description,image,user_id,category_id,title,showslider) VALUES (:description ,:image,:user_id,:category_id,:title,:showslider)');
            $store->bindParam(":description", $description);
            $store->bindParam(":image", $pic);
            $store->bindParam(":user_id", $user_id);
            $store->bindParam(":category_id", $category_id);
            $store->bindParam(":title", $title);
            $store->bindParam(":showslider",$showslider);
            if ($store->execute()) {
?>
                <script>
                    alert("new record successul");
                    window.location.href = ('index.php');
                </script>
            <?php
            } else {
            ?>
                <script>
                    alert("Error");
                    window.location.href = ('index.php');
                </script>
<?php
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $conn = null;
        header('location:index.php');
    } else {
        echo " <div class=\"alert alert-danger\" role=\"alert\">
                    Please fill up the required field
                </div>";
    }
}

?>
<br>
<br>
<br>
<?php
include "footer.php";
?>