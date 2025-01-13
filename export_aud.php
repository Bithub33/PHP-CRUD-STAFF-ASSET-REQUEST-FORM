<?php
session_start();

if(isset($_SESSION['query_res']))
{
    $result = $_SESSION['query_res'];

    header("Content-Type: text/csv");
    header("Content-Disposition: attachment; filename=data.csv");

    $output = fopen("php://output", "w");
    fputcsv($output, ["Request Id","Requested By", "Date of Request", "Implemented By", "Request Type","Audit Status", "Date Implemented", "Date Audited"]);

    foreach($result as  $row){
        fputcsv($output,$row);
    }

    fclose($output);
    exit();
}
?>