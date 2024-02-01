<html>
    <head>
        <link rel="stylesheet" href="style_sheet.css">
        <script src="https://kit.fontawesome.com/a6b9663541.js" crossorigin="anonymous"></script>
    </head>

    <?php
    session_start();
    $user = $_SESSION["Username"];
    ?>
                
    <header id=bar_up>
        <div id=menu>
            <ul>
                <li id="circle"><a href="decks.php"><i class="fa-solid fa-house"></i></a></li>
                <li id="circle"><a href="javascript:logout();"><i class="fa-solid fa-right-from-bracket"></i></a></li>
            </ul>
        </div>

        <script>
            // ends session and bring user to login page
            function logout() {
            sessionStorage.clear();
            window.location.href = "login.php"; 
            }
        </script>
    </header>
 
</html>