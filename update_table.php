<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username = "admin"; 
$password = "admin"; 
$dbname = "410flashcards";
$conn = new mysqli($servername, $username  , $password, $dbname);
if ($conn->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}
else{
    $termArray = json_decode($_POST["termArray"]);
    $defArray = json_decode($_POST["defArray"]); 
    $deckName = $_POST["deckName"];
    $dropTable = "DROP TABLE IF EXISTS " . $_SESSION["Username"] . "_" . $deckName;
    $conn->query($dropTable);
    $createTable = "CREATE TABLE " . $_SESSION["Username"] . "_" . $deckName . " (ID int not null auto_increment, term varchar(50), definition varchar(255), primary key (ID))";
    $result = $conn->query($createTable);
    if (!$result) {
        die("Query failed: " . $conn->error);
    }
    print_r($result);
    for ($i = 0; $i < count($termArray); $i++) {
        $term = $termArray[$i];
        $definition = $defArray[$i];
        $insertQuery = "INSERT INTO " . $_SESSION["Username"] . "_" . $deckName . " (term, definition) VALUES ('$term', '$definition')";
        $conn->query($insertQuery);
    }
    echo '<script>alert("Inserted Values");</script>';
    header('Location: decks.php');
}
?>