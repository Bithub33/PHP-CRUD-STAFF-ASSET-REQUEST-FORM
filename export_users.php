<?php
session_start();

if(isset($_SESSION['query_users_res']))
{
    $result = $_SESSION['query_users_res'];

    header("Content-Type: text/csv");
    header("Content-Disposition: attachment; filename=data.csv");

    $output = fopen("php://output", "w");
    fputcsv($output, ["User ID", "Name", "User Role", "Date Created"]);

    foreach($result as  $row){
        fputcsv($output,$row);
    }

    fclose($output);
    exit();
}
?>