<?php
  session_start();
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
      <button class="wide-button" id="createDeckButton" type="submit" onclick='makeDeckFunction()'>+</button>
      <div id="storedDecks">
      </div>
  </div>

  <script>
      let createDeckButton = document.getElementById('createDeckButton');
      let counter = 1; // will be changed to however many decks are in the user table
      
      function makeDeckButton() {
        let newDeck = document.createElement('button');
        newDeck.setAttribute('class', 'wide-button');
        newDeck.id = 'deck' + counter;
        newDeck.innerHTML = 'New Deck ' + counter;
        newDeck.setAttribute('store', counter);
        console.log(newDeck.store);
        newDeck.addEventListener('click', function() {
            console.log('Test ' + newDeck.id)
        });

        var form = document.createElement('form');
            form.setAttribute('method', 'post');
            form.setAttribute('action', 'sets.php');

        var hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'deckName';
            hiddenInput.value = 'deckName' + newDeck.getAttribute('store');
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
        newDeck.appendChild(form);
        document.getElementById("storedDecks").append(newDeck);
        counter++;
      };

      // createDeckButton.addEventListener('click', makeDeckButton());
  </script>

  </body>
</html>