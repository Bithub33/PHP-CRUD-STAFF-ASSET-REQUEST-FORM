<?php
session_start();

if(isset($_SESSION['query_res']))
{
    $result = $$_SESSION['query_res'];

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Description: attachment: filename=data.xls");

    echo "<table border='1'>
    <thead>
    <tr>
        <th>Request ID</th>
        <th>Requested By</th>
        <th>Date of Request</th>
        <th>Implement Status</th>
        <th>Implemented By</th>
        <th>Date Implemented</th>
        <th>Audit Status</th>
        <th>Audited By</th>
        <th>Date Audited</th>
        <th>Request Type</th>
        <th>Action</th>

    </tr>
    </thead>
    <tbody>";

    foreach($result as $row){

        echo "<tr>
            <td>". $row["Ticketid"] ." </td>
            <td>". $row["Requestedby"] ." </td>
            <td>". $row["Date"] ." </td>
            <td>". $row["Status"] ." </td>
            <td>". $row["Implementedby"] ." </td>
            <td>". $row["ImpDate"] ." </td>
            <td>". $row["Audited"] ." </td>
            <td>". $row["Auditedby"] ." </td>
            <td>". $row["AudDate"] ." </td>
            <td>". strtoupper($row["data_base"]) ." </td>
            </tr>";
    }

    echo "</tbody>
    </table>";
    exit();
}
?>