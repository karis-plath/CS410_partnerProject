<?php
    // connecting to db
    $servername = "localhost";
    $username = "admin";
    $password = "admin";
    $dbname = "410flashcards";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
// Retrieve the next row based on the currentRow parameter
    $currentRow = $_GET['currentRow'];
    $sql = "SELECT term, definition FROM " . $_SESSION["Username"] . "_" .$_POST['deckName'] . " LIMIT 1 OFFSET " . ($currentRow - 1);
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    echo json_encode($row);
?>