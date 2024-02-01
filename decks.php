<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="author" content="writer">
<link rel="stylesheet" href="Style_sheet.css">
<title>Decks Menu</title>
</head>

  <div class="circle-buttons">
    <button class="circle-button">User Icon</button>
    <button class="circle-button">Home Icon</button>
  </div>

  <div class="center-decks">
      <button class="wide-button" id="createDeckButton" type="submit">+</button>
    <div id="storedDecks">
    </div>
  </div>

  <script>
      let createDeckButton = document.getElementById('createDeckButton');
      let counter = 0;

      createDeckButton.addEventListener('click', function() {
        let newDeck = document.createElement('button');
        newDeck.setAttribute('class', 'wide-button');
        newDeck.id = 'deck' + counter;
        newDeck.innerHTML = 'New Deck ' + counter;
        counter++;

        newDeck.addEventListener('click', function() {
            console.log('Test ' + newDeck.id)
        });

        let operationsDiv = document.createElement('div');
        operationsDiv.setAttribute('class','operations');

        let editButton = document.createElement('button');
        let editImage = document.createElement('img');
        editImage.src = 'https://cdn-icons-png.flaticon.com/512/84/84380.png';
        editImage.alt = 'Edit Button';
        editButton.classList.add('edit-image', 'operation-button');
        editButton.appendChild(editImage);
        editButton.addEventListener('click', function() {
          event.stopPropagation();
          alert('Edit image clicked for deck: ' + newDeck.id);
        });

        let trashButton = document.createElement('button');
        let trashImage = document.createElement('img');
        trashImage.src = 'https://cdn-icons-png.flaticon.com/512/484/484662.png';
        trashImage.alt = 'Trash Button';
        trashButton.classList.add('trash-image', 'operation-button');
        trashButton.appendChild(trashImage);
        trashButton.addEventListener('click', function() {
          event.stopPropagation();
          alert('Trash image clicked for deck: ' + newDeck.id);
        });

        operationsDiv.appendChild(editButton);
        operationsDiv.appendChild(trashButton);
        newDeck.appendChild(operationsDiv);
        document.getElementById("storedDecks").append(newDeck);
      });
  </script>

  </body>
</html>