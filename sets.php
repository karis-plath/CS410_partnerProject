<?php
$terms = 0;
$oldTerms = 0;
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
    <form method="post" action="update_table.php">
        <div class= "deckName">
            <input id="deckName" type="text" class="deckName1" name="deckName" placeholder="Deck Name">
            <span id="deckNameError" class="error"></span>
        </div>
        <br>
        <input id="finish" type="submit" value="Finish">
        <button id="createTerm" type="button" class="createTerm">Create Term</button>
        <input type="hidden" name="termArray" id="termArrayIn">
        <input type="hidden" name="defArray" id="defArrayIn">
        <input type="hidden" name="deckName" id="deckNameInput">
    </form>
        <div id="Deck">
<?php  
    session_start();
    $deck = $_POST['deckName'];
    //change to whatever deck they decided to edit
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
        $selectTerms = "SELECT * FROM `" . $_SESSION["Username"] . "_" . $deck . "`";

        $createQuery = "CREATE TABLE IF NOT EXISTS " . $_SESSION["Username"] . "_" . $deck . " (ID int not null auto_increment, term varchar(50), definition varchar(255), primary key (ID))";

        // $result = $conn->query($selectTerms);
        // if ($result){
        //     while ($row = $result->fetch_assoc()){
        //         echo("<div class='termContainers' id='termContainer" . ++$terms . "'>");
        //         echo("<input id='term" . $row["ID"] . "' type='text' class='deckName' value='" . $row["term"] . "'>");
        //         echo("<input id='def" . $row["ID"] . "' type='text' class='defName' value='" . $row["definition"] . "'>");
        //         echo("<button id='deleteTerm" . $terms . "' class='deleteTerm' data-term-id='" . $terms . "'>Delete</button>");
        //         echo("</div>");
        //         $oldTerms = $oldTerms + 1;
        //     }
        // }

        $result = mysqli_query($conn, $createQuery);
        if ($result === false){
            echo "Error creating table: " . mysqli_error($conn);
        } else {
            $result = $conn->query($selectTerms);
            if ($result){
                while ($row = $result->fetch_assoc()){
                    echo("<div class='termContainers' id='termContainer" . ++$terms . "'>");
                    echo("<input id='term" . $row["ID"] . "' type='text' class='deckName' value='" . $row["term"] . "'>");
                    echo("<input id='def" . $row["ID"] . "' type='text' class='defName' value='" . $row["definition"] . "'>");
                    echo("<button id='deleteTerm" . $terms . "' class='deleteTerm' data-term-id='" . $terms . "'>Delete</button>");
                    echo("</div>");
                    $oldTerms = $oldTerms + 1;
                }
            }
        }
    }
    $conn->close();
?>
<script>
        const deletedIds = [];
        $(document).ready(function () {
            var terms = <?php echo json_encode($terms); ?>;
            var oldTerms = <?php echo json_encode($oldTerms); ?>;
            terms = oldTerms;
            $("#createTerm").click(function () {
                terms++;
                $("#Deck").append("<div class='termContainers' id='termContainer" + terms + "'>");
                $("#termContainer" + terms).append("<input id='newTerm" + terms + "' type='text' class='newTerm' placeholder='Term'>");
                $("#termContainer" + terms).append("<input id='newDefinition" + terms + "' type='text' class='newDef' placeholder='Definition'>");
                $("#termContainer" + terms).append("<button id='deleteTerm" + terms + "' class='deleteTerm' data-term-id='" + terms + "'>Delete</button>");
                $("#Deck").append("</div>");
            });

            $(document).on("click", ".deleteTerm", function () {
                var termId = $(this).data("term-id");
                $("#termContainer" + termId).remove();
                deletedIds.push(termId);
            });
            var termValues = [];
            var defValues = [];
            $("#finish").click(function (e) {
            var isEmpty = false;
            $("input.deckName").each(function () {
                var value = $(this).val().trim();
                if (value === '') {
                    isEmpty = true;
                    return false;
                }
                else{
                    termValues.push(value);
                }
            });
            $("input.newTerm").each(function () {
                var value = $(this).val().trim();
                if (value === '') {
                    isEmpty = true;
                    return false;
                }
                else{
                    termValues.push(value);
                }
            });
            $("input.defName").each(function () {
                var value = $(this).val().trim();
                if (value === '') {
                    isEmpty = true;
                    return false;
                }
                else{
                    defValues.push(value);
                }
            });
            $("input.newDef").each(function () {
                var value = $(this).val().trim();
                if (value === '') {
                    isEmpty = true;
                    return false;
                }
                else{
                    defValues.push(value);
                }
            });
            if (isEmpty) {
                alert("Please fill in all the text boxes before finishing.");
                e.preventDefault();
            }
            document.getElementById("termArrayIn").value = JSON.stringify(termValues);
            document.getElementById("defArrayIn").value = JSON.stringify(defValues);
            var deckName = $("#deckName").val().trim();
            document.getElementById("deckNameInput").value = deckName;
        });
    });
    </script>
</div>
</body>
</html>