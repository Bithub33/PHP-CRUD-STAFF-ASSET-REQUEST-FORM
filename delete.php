<?php
include "db_conn.php";
if(isset($_GET['id']) && isset($_GET['db']))
{
    $ticketId = $_GET['id'];
    $db = $_GET['db'];

    $sql = "DELETE FROM $db WHERE Ticketid='$ticketId'";
    
    $conn->query($sql);
    header('Location: home.php');
    exit;
}
?>