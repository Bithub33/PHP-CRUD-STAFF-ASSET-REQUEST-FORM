<?php
    session_start();
    header("Cache-Control: no-store,no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");
    header("Expires: 0");
    include "db_conn.php";
    
    $id = "";$username = "";$name = "";$userid="";$pass ="";$admin = "";$role = "";$level="";


    if($_SERVER['REQUEST_METHOD'] == "GET")
    {
        if(isset($_GET['id']) && isset($_GET['role']))
        {
            $id = $_GET['id'];
            $table = $_GET['role'];
            $pg = $_GET['page'];
            
            $sql = "SELECT * FROM employees WHERE userid='$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();

            if($row)
            {
                $username = $row['username'];
                $name = $row['name'];
                $userid = $row['userid'];
                $pass = $row['password'];
                $admin = $row['level'];
                $role = $row['role'];
                $level = $row['level'];

            }

        }
    }else{

        function clean($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }


        do{

            $username=clean($_POST['u_name']);$name=clean($_POST['name']);$id=clean($_POST['id']);$pass=clean($_POST['pass']);$level=clean(isset($_POST['level'])?$_POST['level']:'NO');$userid=clean($_POST['u_id']);$pass_old=clean($_POST['pass_old']);

            if($pass_old === $pass){

                $sql = "UPDATE employees SET username='$username', name='$name',userid='$userid', level='$level' WHERE userid='$id'";

                $result = $conn->query($sql);
                if($result)
                {
                    header("Location: home.php?page=$pg");
                    exit;
                }
            
            }else{

                $hashpass = md5($pass);

                $sql = "UPDATE employees SET username='$username', name='$name',userid='$userid',password='$hashpass', level='$level' WHERE userid='$id'";

                $result = $conn->query($sql);
                if($result)
                {
                    header("Location: home.php?page=$pg");
                    exit;
                }

            }
            
            
        }while (false);
    }
    
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="layout.css">
    <link rel="stylesheet" href="css/all.min.css"/>
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="icon" href="favicon.png" type="image/png">
    <title>View</title>
</head>
<body>
<nav class="navbar">
    <div class="tit">
        <h4>Melcom</h4>
    </div>
</nav>
<div class="ma" style="padding: 30px;">
<a style="margin: 50px; font-size: 18px;" href="home.php?page=<?php echo $pg ?>"><i class="fa-solid fa-arrow-left-long"></i>  Back</a>

<div id="re" class="cont">
<div class="data">
<form method="post" id="forms_user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" class="reqq">

<div class="content">
    <div id="imp" class="staff-det">
        <h4>Personal Details</h4>   
        <div class="opt">

            <input type="hidden" name="id" value="<?php echo $id?>">
            <input type="hidden" name="pass_old" value="<?php echo $pass?>">
            <div class="column mb-3">
                <label for="u_name" class="">Username*</label>
                <div class="">
                    <input type="text" name="u_name" id="u_name" value="<?php echo $username?>" class="form-control" 
                    oninput="this.value = this.value.toUpperCase();" required>
                    <span id="err" style="color: red; display: none">Field cannot be empty</span>
                    
                </div>
                
            </div>
            <div class="column mb-3">
                <label for="name" class="">Name*</label>
                <div class="">
                    <input type="text" name="name" id="name" value="<?php echo $name?>" class="form-control" oninput="this.value = this.value.toUpperCase();" required>
                    <span id="err" style="color: red; display: none">Field cannot be empty</span>
                </div>
                
            </div>
            
        </div>

        <div class="opt">
            <div class="column mb-3">
                <label for="dep" class="">User Id (Staff Id)*</label>
                <div class="">
                    <input type="text" name="u_id" id="u_id" value="<?php echo $id?>" class="form-control" oninput="this.value = this.value.toUpperCase();" required>
                    <span id="err" style="color: red; display: none">Field cannot be empty</span>
                </div>
                
            </div>
            <div class="column mb-3">
                <label for="req" class="">Role</label>
                <div class="">
                    <input type="text" name="role" id="role" value="<?php echo $role?>" class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
                    
                </div>
                
            </div>
        </div>

        <div class="opt">

            <div class="column mb-3">
                <label for="u_name" class="">Password*</label>
                <div class="">
                    <input type="password" name="pass" id="pass" value="<?php echo $pass?>" class="form-control" minlength="8" placeholder="Password length should be at least 8" required>
                    <span id="error" style="color: red; display: none">Passwords do not match</span>
                    
                </div>
                
            </div>
            
        </div>

        <?php
        if($level === 'YES'){
            ?>
            <div class="con">
                <div class="list">
                    <div class="items_user">
                        <input type="checkbox" name="level" value="YES" class="check_user" checked>
                        <h4>Admin</h4>
                    </div>
                </div>
            </div>
            <?php
        }else{
            ?>
            <div class="con">
                <div class="list">
                    <div class="items_user">
                        <input type="checkbox" name="level" value="YES" class="check_user">
                        <h4>Admin</h4>
                    </div>
                
                </div>
            </div>
            <?php
        }
        ?>

    </div>
    
    <div class="row mb-3">
        <div class="col-sm-3 d-grid mt-5">
            <button  type="submit" class="btn btn-primary">
                Update
            </button>
        </div>
        
    </div>
    
</div>

<div id="space">

</div>

</div>

</div>

</div>
<script src="js/bootstrap.min.js"></script>
<script src="imp_view.js"></script>
    
</body>
</html>