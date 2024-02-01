<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="author" content="writer">
<link rel="stylesheet" href="Style_sheet.css">
<title>Decks Menu</title>
</head>

<?php include ("menu.php");?>

  <style>
    .wide-button {
      position: relative;
      width: 75%;
      height: 64px;
      padding: 25px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .three-dots {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%) rotate(90deg);
      font-size: 18px;
      cursor: pointer;
    }

    .circle-buttons {
      display: flex;
      flex-direction: column;
    }
    .circle-button {
      width: 40px;
      height: 40px;
      margin: 10px;
      border: none;
      border-radius: 50%;
      cursor: pointer;
    }

    .center-decks {
      text-align: center;
      line-height: 100px;
    }
  </style>

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

        let threeDots = document.createElement('span');
        threeDots.innerHTML = '. . .';
        threeDots.setAttribute('class', 'three-dots');

        threeDots.addEventListener('click', function () {
          event.stopPropagation();
          alert('Three dots clicked for deck: ' + newDeck.id);
        });

        newDeck.appendChild(threeDots);
        document.getElementById("storedDecks").append(newDeck);
      });
  </script>

  </body>
</html>