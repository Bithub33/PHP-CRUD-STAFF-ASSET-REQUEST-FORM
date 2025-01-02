<?php
    session_start();
    include "db_conn.php";
    
    $id = "";$date = "";$requestedBy = "";$reqfor="";$dept ="";$loc = "";$contact = "";
    
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $datetime = new DateTime("now", new DateTimeZone('UTC'));
        $datetime->setTimezone(new DateTimeZone('Africa/Accra'));
        $date = $datetime->format('Y-m-d H:i:s');

        function clean($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $username = clean($_POST['u_name']);$name = clean($_POST['name']);$pass = clean($_POST["pass"]);$role = clean($_POST["role"]);$user_id = clean($_POST["u_id"]);$level = clean(isset($_POST['level'])?$_POST['level']:'NO');

        $hashpass = md5($pass);

        /*$sql = "SELECT userid FROM employees WHERE userid = '$user_id'";

        $result = mysqli_query($conn,$sql);

        if(mysqli_num_rows($result) > 0)
        {

            echo "<script> localStorage.setItem('duplicate','true');
            alert('hjdhtj') </script>";

        }else{

        }*/

        $sql = "INSERT INTO employees (username,password, userid, name, role,level,date_created) 
                VALUES ('$username','$hashpass','$user_id','$name', '$role','$level','$date')";

        $result = $conn->query($sql);
        if($result){

            header('Location: home.php');
            exit;
        }
        
    }
?>