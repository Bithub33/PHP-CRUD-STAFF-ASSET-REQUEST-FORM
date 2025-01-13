<?php
session_start();

if(isset($_SESSION['query_res']) && isset($_SESSION['role']))
{
    $role = $_SESSION['role'];

    header("Content-Type: text/csv");
    header("Content-Disposition: attachment; filename=data.csv");

    if($role == 'INFRASTRUCTURE'){
        $result = $_SESSION['query_res'];
        $remove = "data_base";

        foreach($result as &$row){
            unset($row[$remove]);
        }
        
        //$result = array_values($result);
        $output = fopen("php://output", "w");
        fputcsv($output, ["Request Id","Requested By","Date of Request","Type","Imp Status","Implemented Date","Audited Status"]);

        foreach($result as  $row){
            fputcsv($output,$row);
        }

        fclose($output);
        exit();

    }else{

        $result = $_SESSION['query_res'];
        $remove = "data_base";
        $remove2 = "Type";

        foreach($result as &$row){
            unset($row[$remove]);
            unset($row[$remove2]);
        }
        
        //$result = array_values($result);
        $output = fopen("php://output", "w");
        fputcsv($output, ["Request Id","Requested By","Date of Request","Imp Status","Implemented Date","Audited Status"]);

        foreach($result as  $row){
            fputcsv($output,$row);
        }

        fclose($output);
        exit();

    }

}
?>