<html>
    <head>
        <link rel="stylesheet" href="style_sheet.css">
        <title>Card</title>
    </head>

    <body>
    <div class="flip-container" onclick="flipCard(this)">
        <div class="flipper">
        <!-- Term side -->
        <div class="front">
            <p class="term">where term will be</p>
        </div>

        <!-- definition side -->
        <div class="back">
            <p class="definition">where definition will be</p>
            <button class="correct" onclick="scoring()">check</button>
            <button class="incorrect">x</button>
        </div>
</div>

        <!-- arrow + flip buttons -->
        <div class="arrows">
            <button name="n" class="previous"><-</button>
            <button class="next">-></button>
            <p class="score">where score will be</p>
        </div>
</div>

    </body>

    <?php
        // connecting to db
        $servername = "localhost";
        $username = "karis";
        $password = "pepper";
        $dbname = "cs410";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT term, definition FROM k_deck WHERE ID = 1";

        $i = 1;
        if (isset($_POST['n']))
        {
            $i++;
            $sql = "SELECT term, definition FROM k_deck WHERE ID =" . $i ."";
        }

        // getting the first row
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $term = $row['term'];
            $definition = $row['definition'];
        } else {
            echo "deck is empty";
        }
    ?>

    <script>
        var term = <?php echo json_encode($term); ?>;
        var definition = <?php echo json_encode($definition); ?>;

        // assigns paragraphs to variables
        const termParagraph = document.querySelector('.term');
        const defParagraph = document.querySelector('.definition');

        // displays the term on card
        termParagraph.textContent = term;
        defParagraph.textContent = definition;

        // scoring
        var score;
        var correct;
        var total = <?php echo json_encode(num_rows); ?>;
        function scoring(){
            correct += 1;
            score = correct/total;
        }
        

    </script>

</html>