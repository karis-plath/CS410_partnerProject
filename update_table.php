<?php
$servername = "localhost";
$username = "Myles"; 
$password = "password";
$dbname = "410flashcards";
$conn = new mysqli($servername, $username  , $password, $dbname);
 
if ($conn->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}
else{
    $termArray = json_decode($_POST["termArray"]);
    $defArray = json_decode($_POST["defArray"]); 
    $deckName = $_POST["deckName"]
    $dropTable = "DROP TABLE IF EXISTS " . $_SESSION["username"] . "_" . $deckName;
    $conn->query($dropTable);
    $createTable = "CREATE TABLE " . $_SESSION["user"] . "_" . $deckName . " 
    (ID int not null auto_increment, term varchar(50), definition varchar(255), primary key (ID))";
    for ($i = 0; $i < count($termArray); $i++) {
        $term = $termArray[$i];
        $definition = $defArray[$i];
        $insertQuery = "INSERT INTO " . $_SESSION["username"] . "_" . $deckName . " (term, definition) VALUES ('$term', '$definition')";
        $conn->query($insertQuery);
    }

    
}
?>