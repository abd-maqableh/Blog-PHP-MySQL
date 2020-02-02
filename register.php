<?php
require_once 'conn.php';
include "header.php";
?>


<body>
    <div class="container">
        <div class="he">
            <div class="grid ">
                <div class="first_side item">
                    <div class="container-first">
                        <div class="SginUp">
                            <h1>Sign Up </h1>
                            <p>Sginup with your simple detilas It will be cross chekced by the adminstration </p>
                        </div>
                        <div class="SginIn">
                            <h1>Sign In</h1>
                            <p>Sign in in your username and password</p>
                        </div>
                    </div>
                </div>
                <div class="second-side item">
                    <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> class="form">
                        <h5>username</h5>
                        <div class="group">
                            <input type="text" name="username" class="input" required placeholder="example.new"><span class="highlight"></span><span class="bar"></span>
                        </div>
                        <!-- E-mai -->
                        <h5>email</h5>
                        <div class="group">
                            <input type="email" name=" email" class="input" required placeholder="example@fx.com"><span class="highlight"></span><span class="bar"></span>
                        </div>
                        <!-- password -->
                        <h5>password</h5>
                        <div class="group">
                            <input type="password" name="password" class="input" required placeholder="***************"><span class="highlight"></span><span class="bar"></span>
                        </div>


                        <div style="margin:25px auto;">
                            <input type="checkbox" required>
                            <p style="display:inline;margin-left:13px;">I agree with the terms and conditon</p>
                        </div>

                        <!-- Sign in button -->
                        <button type="submit" class="btn btn-success" name="register">Sign up</button>
                        <p style="display: inline;margin-left:10px;">or <a href="login.php" style="margin-left: 8px ;color:black">Log in</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <?php

    if (isset($_POST['register'])) {
        if ($_POST['email'] != "" || $_POST['username'] != "" || $_POST['password'] != "") {
            try {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO `user` VALUES ('', '$username',  '$email', '$password')";
                $conn->exec($sql);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }

            $conn = null;
            $_SESSION['user'] =  $username;
            header('location:index.php');
        } else {
            echo "
				Please fill up the required field
			";
        }
    }
    include "footer.php";
    ?>