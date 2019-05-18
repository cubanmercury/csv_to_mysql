<?php 
    /* Database connection file */
    $servername = "<host>";
    $username = "<username>";
    $password = "<password>";
    $db = "<db_name>";

    $conn = mysqli_connect($servername, $username, $password, $db);

    if (!$conn){
        die("connection Failed: " . mysql_error());
    }