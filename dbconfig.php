<?php
include_once 'function.php';
// Database configuration
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "database";

// Create database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["import"])) {
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($_FILES["file"]["tmp_name"], "r");

        
        while (($line = fgetcsv($file, 10000, ",")) !== FALSE) {

                $uid = $line[0];
                $firstName = $line[1];
                $lastName = $line[2];
                $birthDay = $line[3];
                $dateChange = $line[4];
                $description = $line[5];
                $vers = time();

                $result = $conn->query("INSERT INTO users (uid, firstName, lastName, birthDay, dateChange, description, version) 
                                VALUES ('".$uid."', '".$firstName."', '".$lastName."', '".$birthDay."', '".$dateChange."', '".$description."', '".$vers."') ON DUPLICATE KEY UPDATE dateChange = '".$dateChange."', version = '".$vers."'");
                printf("Затронутые строки (INSERT): %d\n", $conn->affected_rows);
 
    
                $conn->query("DELETE FROM users WHERE version < $vers");
                 printf("Затронутые строки (DELETE): %d\n", $conn->affected_rows);

                  if (! empty($result)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
                

        }
    }
}
