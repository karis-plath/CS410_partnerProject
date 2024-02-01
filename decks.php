<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="author" content="writer">
<link rel="stylesheet" href="Style_sheet.css">
<title>Decks Menu</title>
</head>
  <style>
    .wide-button {
      width: 75%;
      padding: 10px;
      margin: 10px 0;
      border: none;
      border-radius: 5px;
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
      line-height: 200px;
    }
  </style>

  <div class="circle-buttons">
    <button class="circle-button">User Icon</button>
    <button class="circle-button">Home Icon</button>
  </div>

  <div class="center-decks">
    <form method=POST>
      <button class="wide-button" name="createDeck" type="submit">+</button>
    </form>
    <?php
      // Report all error information on the webpage
      error_reporting(E_ALL);
      ini_set('display_errors', 1);

      if (isset($_POST["createDeck"])) {
          $count = 0;
          echo '<button class="wide-button" name="createDeck" type="submit">Sample Deck {$count} </button>';
          $count++;
          // session_start();
          // header("Location:sets.php")
      }
    ?>
  </div>
  </body>
</html>