<?php

$servername = "mariadb";
$username = "user";
$password = "userpass";
$dbname = "stream";
try {

    $dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    $pdo = new PDO($dsn, $username, $password, $options);
    echo "Connected successfully to MariaDB with PDO!<br>";

    // Query to list databases
    $stmt = $pdo->query("INSERT INTO test (id) values (1);");

    echo "Databases:<br>";
    while ($row = $stmt->fetch()) {
        echo "- " . htmlspecialchars($row['Database']) . "<br>";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
