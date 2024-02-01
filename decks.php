<?php
  session_start();

  $servername = "localhost";
  $username = "admin"; 
  $password = "admin";
  $dbname = "410flashcards";
  $conn = new mysqli($servername, $username  , $password, $dbname);
  
  $result = $conn->query('show tables');
  
  if ($result) {
    // Characters to check for
    $targetCharacters = $_SESSION['Username'] . '_';

    $existingDeckArray = array();
    // Loop through the rows
    while ($row = $result->fetch_assoc()) {
        // Check if the table name contains the target characters
        if (strpos($row['Tables_in_' . $dbname], $targetCharacters) !== false) {
            // Print the table name
            $existingDeck = str_replace($targetCharacters, '', $row['Tables_in_' . $dbname]);
            $existingDeckArray[] = $existingDeck;
        }
    }

    // Free the result set
    $result->free();
    $jsArray = json_encode($existingDeckArray);
} else {
    // Print an error message if the query fails
    echo "Error executing query: " . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="author" content="writer">
<link rel="stylesheet" href="Style_sheet.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<title>Decks Menu</title>
</head>

  <div class="circle-buttons">
    <button class="circle-button">User Icon</button>
    <button class="circle-button">Home Icon</button>
  </div>

  <div class="center-decks">
      <button class="wide-button" id="createDeckButton" type="submit" onclick=makeDeckButton()>+</button>
      <div id="storedDecks">
      </div>
  </div>

  <script>
      let createDeckButton = document.getElementById('createDeckButton');
      let counter = 1; // will be changed to however many decks are in the user table
      
      function makeDeckButton() {
        var deckDiv = document.createElement('div');
        deckDiv.classList.add('deck-divs');

        let newDeck = document.createElement('input');
            newDeck.setAttribute('class', 'wide-button');
            newDeck.setAttribute('type', 'submit');
            newDeck.setAttribute('store', counter);
            newDeck.id = 'deck' + counter;
            newDeck.value = 'deckName' + newDeck.getAttribute('store');;
            console.log(newDeck.value);
        
            newDeck.addEventListener('click', function(event) {
              console.log('Test ' + newDeck.id)
              form.submit();
        });

        var outerForm = document.createElement('form');
            outerForm.setAttribute('method', 'post');
            outerForm.setAttribute('action', 'card.php');

        var outerHiddenInput = document.createElement('input');
            outerHiddenInput.type = 'hidden';
            outerHiddenInput.name = 'deckName';
            outerHiddenInput.value = 'deckName' + newDeck.getAttribute('store');;
            outerForm.append(outerHiddenInput);

        var form = document.createElement('form');
            form.setAttribute('method', 'post');
            form.setAttribute('action', 'sets.php');

        var hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'deckName';
            hiddenInput.value = 'deckName' + newDeck.getAttribute('store');;
            form.append(hiddenInput);

        let operationsDiv = document.createElement('div');
            operationsDiv.setAttribute('class','operations');

        let editButton = document.createElement('input');
            editButton.setAttribute('type', 'submit');

        let editImage = document.createElement('img');
            editImage.src = 'https://cdn-icons-png.flaticon.com/512/84/84380.png';
            editImage.alt = 'Edit Button';
            editButton.classList.add('edit-image', 'operation-button');
            editButton.appendChild(editImage);
            editButton.addEventListener('click', function(event) {
              event.stopPropagation();

              form.submit();
        });

        let trashButton = document.createElement('button');
        let trashImage = document.createElement('img');
        trashImage.src = 'https://cdn-icons-png.flaticon.com/512/484/484662.png';
        trashImage.alt = 'Trash Button';
        trashButton.classList.add('trash-image', 'operation-button');
        trashButton.appendChild(trashImage);
        trashButton.addEventListener('click', function() {
          event.stopPropagation();
          document.getElementById("storedDecks").removeChild(newDeck);
        });

        operationsDiv.appendChild(editButton);
        operationsDiv.appendChild(trashButton);
        form.appendChild(operationsDiv);
        deckDiv.appendChild(form);

        outerForm.appendChild(newDeck);
        deckDiv.appendChild(outerForm);
        document.getElementById("storedDecks").append(deckDiv);
        counter++;
      };
      
      function makeExistingDeckButton(element) {

        var deckDiv = document.createElement('div');
        deckDiv.classList.add('deck-divs');

        var outerForm = document.createElement('form');
            outerForm.setAttribute('method', 'post');
            outerForm.setAttribute('action', 'card.php');

        var outerHiddenInput = document.createElement('input');
            outerHiddenInput.type = 'hidden';
            outerHiddenInput.name = 'deckName';
            outerHiddenInput.value = element;
            outerForm.append(outerHiddenInput);
          
        let newDeck = document.createElement('input');
            newDeck.setAttribute('class', 'wide-button');
            newDeck.setAttribute('type', 'submit');
            newDeck.setAttribute('store', counter);
            newDeck.id = 'deck' + counter;
            newDeck.value = element;
            console.log(newDeck.value);
        
            newDeck.addEventListener('click', function(event) {
              console.log('Test ' + newDeck.id)
              form.submit();
        });

        var form = document.createElement('form');
            form.setAttribute('method', 'post');
            form.setAttribute('action', 'sets.php');

        var hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'deckName';
            hiddenInput.value = element;
            form.append(hiddenInput);

        let operationsDiv = document.createElement('div');
            operationsDiv.setAttribute('class','operations');

        let editButton = document.createElement('input');
            editButton.setAttribute('type', 'submit');

        let editImage = document.createElement('img');
            editImage.src = 'https://cdn-icons-png.flaticon.com/512/84/84380.png';
            editImage.alt = 'Edit Button';
            editButton.classList.add('edit-image', 'operation-button');
            editButton.appendChild(editImage);
            editButton.addEventListener('click', function(event) {
              event.stopPropagation();

              form.submit();
        });

        let trashButton = document.createElement('button');
        let trashImage = document.createElement('img');
        trashImage.src = 'https://cdn-icons-png.flaticon.com/512/484/484662.png';
        trashImage.alt = 'Trash Button';
        trashButton.classList.add('trash-image', 'operation-button');
        trashButton.appendChild(trashImage);
        trashButton.addEventListener('click', function() {
          event.stopPropagation();
          document.getElementById("storedDecks").removeChild(newDeck);
        });

        operationsDiv.appendChild(editButton);
        operationsDiv.appendChild(trashButton);
        form.appendChild(operationsDiv);
        deckDiv.appendChild(form);

        outerForm.appendChild(newDeck);
        deckDiv.appendChild(outerForm);
        document.getElementById("storedDecks").append(deckDiv);
        counter++;
      }
      
      var deckArray = <?php echo $jsArray; ?>;
      deckArray.forEach(makeExistingDeckButton);
  </script>

  </body>
</html>