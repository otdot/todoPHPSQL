<?php
    $dbhost = "db";
    $dbname = "tododb";
    $dbuser = "root";
    $dbpass = "lionPass";

    $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    // if ($connection->connect_error) {
    //     echo "connection unsuccesful";
    // }else {
    //     echo "connected succesfully";
    // }
?>