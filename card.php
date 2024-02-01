<html>
    <head>
        <link rel="stylesheet" href="style_sheet.css">
        <title>Card</title>
        <?php include("menu.php") ?>
    </head>

    <body>
    <div class="flip-container" ">
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
            <button class="prev"><-</button>
            <button class="next">-></button>
            <p class="score">Score:</p>
        </div>
    </div>

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

    // get total rows
    $sql = "SELECT * FROM k_deck";
    $result = $conn->query($sql);
    $total = mysqli_num_rows($result); 

    // Retrieve the first row initially
    $sql = "SELECT term, definition FROM k_deck WHERE ID = 1";
    $result = $conn->query($sql);
    $total = mysqli_num_rows($result); 
    $row = $result->fetch_assoc();
    $term = $row['term'];
    $definition = $row['definition'];
    ?>

    <script>
    var currentRow = 1; // Track the current row

    // Fetch and display the initial row content
    var term = <?php echo json_encode($term); ?>;
    var definition = <?php echo json_encode($definition); ?>;
    const termParagraph = document.querySelector('.term');
    const defParagraph = document.querySelector('.definition');
    termParagraph.textContent = term;
    defParagraph.textContent = definition;

    // Handle button clicks to fetch subsequent rows
    document.querySelector('.next').addEventListener('click', function() {
    fetch('fetch.php?currentRow=' + currentRow)
        .then(response => response.json())
        .then(data => {
        if (data) {
            term = data.term;
            definition = data.definition;
            termParagraph.textContent = term;
            defParagraph.textContent = definition;
            currentRow++;
        } else {
            alert("No more rows in the database");
        }
        });
    });

    document.querySelector('.prev').addEventListener('click', function() {
    fetch('fetch.php?currentRow=' + currentRow)
        .then(response => response.json())
        .then(data => {
        if (data) {
            term = data.term;
            definition = data.definition;
            termParagraph.textContent = term;
            defParagraph.textContent = definition;
            currentRow--;
        } else {
            alert("No previous rows in the database");
        }
        });
    });

    var score = 0; // Declare the score variable
    var total = <?php echo json_encode($total); ?>;
    const scoreParagraph = document.querySelector('.score'); // Reference the score element
    const totalRowsParagraph = document.querySelector('.totalRows'); // Add a new element for total rows

    function scoring() {
    score++; // Increment the score
    scoreParagraph.textContent = "Score: " + score + "/" + total; // Update the displayed score
    }

    </script>


    </body>


</html>