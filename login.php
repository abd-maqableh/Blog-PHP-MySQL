<?php
include "header.php";
require_once 'conn.php';


?>


<body>
<div class="container-style">
    <div class="grid">
        <div class="first_side item">
            <div class="container-first">
                <div class="SginUp">
                    <h1>Sign Up </h1>
                    <p>Signup with your simple detilas It will be cross chekced by the adminstration </p>
                </div>
                <div class="SginIn">
                    <h1>Sign In</h1>
                    <p>Sign in in your username and password</p>
                </div>

            </div>

        </div>
        <div class="second-side item">
            <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> class="form-login" >
                <h5>username</h5>
                <div class="group">
                    <input type="text" name="username" class="input" required placeholder="example.new"><span class="highlight"></span><span class="bar"></span>
                </div>

                <!-- password -->
                <h5>password</h5>
                <div class="group">
                    <input type="password" name="password" class="input" required placeholder="***************"><span class="highlight"></span><span class="bar"></span>
                </div>

                <!-- Sign in button -->
                <div style="margin-top: 110px">
                    <button type="submit" class="btn btn-success" name="login">Log in</button>
                    <p style="display: inline;margin-left:10px;">or <a href="register.php" style="margin-left: 8px;color:black">Register</a></p>
                </div>


            </form>
        </div>
    </div>
</div>
<br>
<br>
<br>

  <?php 

      
      if(ISSET($_POST['login'])){
          if($_POST['username'] != "" || $_POST['password'] != ""){
              $username = $_POST['username'];
              $password = $_POST['password'];
              $sql = "SELECT * FROM `user` WHERE `username`=? AND `password`=? ";
              $query = $conn->prepare($sql);
              $query->execute(array($username,$password));
              $row = $query->rowCount();
              $fetch = $query->fetch();
              if($row > 0) {
                  $_SESSION['user'] = $fetch['username'];
                  $_SESSION['user_id'] = $fetch['id'];
                  echo "
                  <script>window.location = 'index.php'</script>
                  ";
              } else{
                  echo "
                  <script>alert('Invalid username or password')</script>
                  <script>window.location = 'index.php'</script>
                  ";
              }
          }else{
              echo "
                  <script>alert('Please complete the required field!')</script>
                  <script>window.location = 'index.php'</script>
              ";
          }
      }
      ?>
      <br>
      <br>
      <br>

      <?php
    include "footer.php";
  ?>