<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username = "Myles"; 
$password = "password";
$dbname = "410flashcards";
$conn = new mysqli($servername, $username  , $password, $dbname);
if ($conn->connect_errno > 0) {
    echo("<p>hello</p>");
    die('Unable to connect to database [' . $db->connect_error . ']');
}
else{
    $termArray = json_decode($_POST["termArray"]);
    $defArray = json_decode($_POST["defArray"]); 
    $deckName = $_POST["deckName"];
    echo("<p>hello</p>");
    echo("<script>console.log(" . $deckName . ")</script>");
    $dropTable = "DROP TABLE IF EXISTS myles_" . $deckName;
    $conn->query($dropTable);
    $createTable = "CREATE TABLE myles_" . $deckName . " (ID int not null auto_increment, term varchar(50), definition varchar(255), primary key (ID))";
    $result = $conn->query($createTable);
    if (!$result) {
        die("Query failed: " . $conn->error);
    }
    print_r($result);
    for ($i = 0; $i < count($termArray); $i++) {
        $term = $termArray[$i];
        $definition = $defArray[$i];
        $insertQuery = "INSERT INTO myles_" . $deckName . " (term, definition) VALUES ('$term', '$definition')";
        $conn->query($insertQuery);
    }
    echo '<script>alert("Inserted Values");</script>';
    
}
?>