<?php
$terms = 0;
?>
<!DOCTYPE html>
<html>
 
<head>
<meta charset="UTF-8">
<meta name="author" content="Myles, Karis, Nick">
<!-- <link rel="stylesheet" href="Style_sheet.css"> -->
<title>410Flashcards</title>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <form method="post" action="">
        <div class= "deckName">
            <input id="deckName" type="text" class="deckName" name="deckName" placeholder="Deck Name">
            <span id="deckNameError" class="error"></span>
        </div>
        <br>
        <input id="finish" type="submit" value="Finish">
        <button id="createTerm" type="button" class="createTerm" value = "Create Term">
    </form>
        <div id="Deck">
            
        </div>
    <script>
        var xhr;
        var timer;
        /* function checkDeckNameAvailability() {
            clearTimeout(timer);
            timer = setTimeout(function (){
                var deckName = document.getElementById("deckName").value;

                if (deckName.trim() !== '') {
                    if (xhr && xhr.readyState !== 4) {
                        xhr.abort();
                    }
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "", true);
                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            document.getElementById("deckNameError").innerHTML = xhr.responseText;
                        }
                    };

                    xhr.send("deckName=" + encodeURIComponent(deckName));
                } else {
                    document.getElementById("deckNameError").innerHTML = '';
                }
            }, 300);
        } */

        //document.getElementById("deckName").addEventListener("input", checkDeckNameAvailability);
        $(document).ready(function () {
            $("#createTerm").click(function () {
                $("#Deck").append("<input type='text' class='deckName' placeholder='Term'>");
                $("#Deck").append("<input type='text' class='deckName' placeholder='Definition'>");
                $("#Deck").append("<br>");
            });
        });
    </script>
<?php  
    session_start();
    $terms = 0;
    $deck = "deck"; //change to whatever deck they decided to edit
    if (isset($_POST["deckName"])){
        $servername = "localhost";
        $username = "Myles";
        $password = "password";
        $dbname = "410flashcards";
        $conn = new mysqli($servername, $username  , $password, $dbname);
 
        if ($conn->connect_errno > 0) {
            die('Unable to connect to database [' . $db->connect_error . ']');
        }
        else{
            if(isset($_SESSION["username"])){
                $name = $_POST["deckName"];
                $checkDeck = "SHOW TABLES LIKE '" . $_SESSION["username"] . "_" . $name . "'";
                $result = $conn->query($checkDeck);
                if ($result->num_rows > 0 && $name != $deck){
                    echo("<p class='error'>Error: Deckname already Exists</p>");
                }
            }
        }
        $conn->close();

    }
    //if (isset($_POST["createTerm"])){
        //echo("<div id='Deck'>");
        //echo("<input id='newTerm" . $terms . " type='text' class='deckName' placeholder='Term'>");
        //echo("<input id='newDefinition" . $terms . " type='text' class='deckName' placeholder='Definition'>");
        //echo("</div>");
        //$terms = $terms + 1;
    //}
    if (isset($_POST["finish"])){
        
    }
    $servername = "localhost";
    $username = "Myles"; 
    $password = "password";
    $dbname = "410flashcards";
    $conn = new mysqli($servername, $username  , $password, $dbname);
 
    if ($conn->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    }
    else{
        $selectTerms = "SELECT * FROM `" . $_SESSION["username"] . "_" . $deck . "`";
        $result = $conn->query($selectTerms);
        if ($result){
            echo("<div id='Deck'>");
            while ($row = $result->fetch_assoc()){
                echo("<input id='term" . $row["ID"] . " type='text' class='deckName' value='" . $row["term"] . "'>");
                echo("<input id='def" . $row["ID"] . " type='text' class='deckName' value='" . $row["definition"] . "'>");
                echo("<input id='deleteTerm' type='submit' class='deleteTerm' value = 'Delete'>");
                echo("<br>");
            }
            echo("</div>");
        }
    }
    $conn->close();
?>
</body>
</html>