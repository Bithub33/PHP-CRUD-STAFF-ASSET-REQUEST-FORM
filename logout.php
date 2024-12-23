<?php
include "db_conn.php";
session_start();

session_unset();
session_destroy();
$conn->close();

header("Location: index.php");
exit();
?>