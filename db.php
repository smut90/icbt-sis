<?php
     $username = 'root';
     $password = 'test';
     $dbName = 'abc_sis_db';
     $connectionName = 'bitnami-mx-kdbnbjq:asia-south1:abc-sis-db-dev';
     $socketDir = '/cloudsql';

    $dsn = sprintf(
        'mysql:dbname=%s;unix_socket=%s/%s',
        $dbName,
        $socketDir,
        $connectionName
    );

    // Connect to the database.
    $conn = new PDO($dsn, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("DB Connection failed - " . $conn->connect_error);
    } else {
        echo 'DB connection successful';
    }
    //echo "Connected successfully";
?>
