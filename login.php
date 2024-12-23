<?php
session_start();
include "db_conn.php";
if(isset($_POST["username"]) && isset($_POST["password"]))
{
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST["username"]);
    $pass = validate($_POST["password"]);

    if(empty($uname))
    {
        header("Location: index.php?error= User Name is required");
    }else if(empty($_POST)){
        header("Location: index.php?error= Password is required");
    }else
    {
        $sql = "SELECT * FROM employees WHERE username='$uname' AND password='$pass'";

        $result = mysqli_query($conn,$sql);

        if(mysqli_num_rows($result) === 1)
        {
            $row = mysqli_fetch_assoc($result);
            if($row['username'] === $uname && $row['password'] === $pass){
                $_SESSION['username'] = $row['username'];
                $_SESSION['userid'] = $row['userid'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['role'] = $row['role'];
                header("Location: home.php");
                exit();
            }
            else
            {
                header("Location: index.php?error=Incorect username or password");
                exit();
            }
        }
        else
            {
                header("Location: index.php?error=Incorect username or password");
                exit();
            }
    }
}
else
{
    
    header("Location: index.php");
    exit();
}


?>