<?php
session_start();

if(isset($_SESSION['query_res']) && isset($_SESSION['role']))
{
    $result = $_SESSION['query_res'];
    $role = $_SESSION['role'];

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=data.xls");

    if($role == 'infrastructure'){

        echo "<table border='1'>
        <thead>
        <tr>
            <th>Request ID</th>
            <th>Requested By</th>
            <th>Date of Request</th>
            <th>Type</th>
            <th>Status</th>
            <th>Implemented Date</th>
            <th>Audited Status</th>

        </tr>
        </thead>
        <tbody>";

        foreach($result as $row){

            echo "<tr>
                <td>". $row["Ticketid"] ." </td>
                <td>". $row["Requestedby"] ." </td>
                <td>". $row["Date"] ." </td>
                <td>". $row["Type"] ." </td>
                <td>". $row["Status"] ." </td>
                <td>". $row["ImpDate"] ." </td>
                <td>". $row["Audited"] ." </td>
                </tr>";
        }
    
        echo "</tbody>
        </table>";
        exit();

    }else{


        echo "<table border='1'>
        <thead>
        <tr>
            <th>Request ID</th>
            <th>Requested By</th>
            <th>Date of Request</th>
            <th>Status</th>
            <th>Implemented Date</th>
            <th>Audited Status</th>

        </tr>
        </thead>
        <tbody>";

        foreach($result as $row){

            echo "<tr>
                <td>". $row["Ticketid"] ." </td>
                <td>". $row["Requestedby"] ." </td>
                <td>". $row["Date"] ." </td>
                <td>". $row["Status"] ." </td>
                <td>". $row["ImpDate"] ." </td>
                <td>". $row["Audited"] ." </td>
                </tr>";
        }
    
        echo "</tbody>
        </table>";
        exit();


    }

}
?>