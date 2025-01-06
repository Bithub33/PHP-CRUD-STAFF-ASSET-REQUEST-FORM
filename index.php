<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="favicon.png" type="image/png">
</head>
<body>
    
    <form action="login.php" class="form" id="form" method="post">
        <?php 
        if(isset($_GET["error"])) 
        { ?> <p class="eror"><?php echo $_GET["error"];?></p>
        <?php 
        }
        ?>
        <div class="logo">
          <img src="images/img1.png" alt="">
        </div>
        <label>Username</label><br>
        <input type="text" class="inp" oninput="this.value = this.value.toUpperCase();"
         name="username"><br>
        <label>Password</label><br>
        <input type="password" class="inps" id="inps" name="password"><br>
        <button class="btn btn-primary">Login</button>
    </form>
    
</body>
</html>