<html>
    <head>
        <link rel="stylesheet" href="Style_sheet.css">
        <title>Card</title>
    </head>

    <body>
        <!-- Term side -->
        <div class="front">
        </div>

        <!-- definition side -->
        <div class="back">
        <button class="correct">Got it right!</button>
        <button class="incorrect">Got it wrong.</button>
        </div>

        <!-- arrow + flip buttons -->
        <div class="arrows">
        <button class="previous"><-</button>
        <button class="flip">%</button>
        <button class="next">-></button>
        </div>
    </body>

    <script>
        const correctButton = document.querySelector('.correct');
        correctButton.addEventListener('click', () => {
        // TODO: increment score variable
        displayNextCard();  // Function to display the next card
        });
    </script>

    <?php
    $servername = "localhost";
    $username = "karis";
    $password = "pepper";
    $dbname = "cs410";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>

</html>