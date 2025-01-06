<?php
session_start();

if(isset($_SESSION['query_users_res']))
{
    $result = $_SESSION['query_users_res'];

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=data.xls");

    echo "<table border='1'>
    <thead>
    <tr>
        <th>User ID</th>
        <th>Name</th>
        <th>User Role</th>
        <th>Date Created</th>

    </tr>
    </thead>
    <tbody>";

    foreach($result as $row){

        echo "<tr>
            <td>". $row["userid"] ." </td>
            <td>". $row["name"] ." </td>
            <td>". $row["role"] ." </td>
            <td>". $row["date_created"] ." </td>
            </tr>";
    }

    echo "</tbody>
    </table>";
    exit();
}
?>