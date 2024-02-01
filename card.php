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
            <button class="correct">Got it right!</button>
            <button class="incorrect">Got it wrong.</button>
        </div>
</div>

        <!-- arrow + flip buttons -->
        <div class="arrows">
            <button name="n" class="previous"><-</button>
            <button class="next">-></button>
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

        $i = 1;
        if (isset($_POST['n']))
        {
            $i++;
        }

        // getting the first row

        $sql = "SELECT term, definition FROM k_deck WHERE ID = '$i'";
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
        // assigns paragraphs to variables
        const termParagraph = document.querySelector('.term');
        const defParagraph = document.querySelector('.definition');

        // displays the term on card
        termParagraph.textContent = "<?php echo $term; ?>";
        defParagraph.textContent = "<?php echo $definition; ?>";

    </script>

</html>