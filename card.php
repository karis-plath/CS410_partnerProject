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

        <!-- arrow + flip buttons -->
        <div class="arrows">
            <button class="previous"><-</button>
            <button class="flip" onclick="flipCard(document.querySelector('.flip-container'))">%</button>
            <button class="next">-></button>
        </div>
</div>
</div>
    </body>

    <?php
        $servername = "localhost";
        $username = "karis";
        $password = "pepper";
        $dbname = "cs410";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Assuming a table named 'flashcards' with columns 'term_id', 'term', and 'definition'
        $sql = "SELECT term, definition FROM k_deck WHERE ID = 1";
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
        const termParagraph = document.querySelector('.term');
        const definition = "<?php echo $definition; ?>";  // Assume $definition holds the definition

        // Initially display the term
        termParagraph.textContent = "<?php echo $term; ?>";  // Assume $term holds the term

        const flipButton = document.querySelector('.flip');
        const backDiv = document.querySelector('.back');
        const frontDiv = document.querySelector('.front');

        function flipCard(element) {
            element.classList.toggle('flip');
        }

        const termParagraph = document.querySelector('.term');
        const definition = "<?php echo $definition; ?>";  // Assume $definition holds the definition

        // Initially display the term
        termParagraph.textContent = "<?php echo $term; ?>";  // Assume $term holds the term

    </script>

</html>