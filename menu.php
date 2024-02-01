<html>

    <?php
    session_start();
    $user = $_SESSION["Username"];
    ?>
                
    <header id=bar_up>
        <h1>
            <div id=menu>
                <ul>
                <li class="nav-item"><a class="nav-link" href="decks.php">home</a></li>
                <li class="nav-item"><a class="nav-link" href="login.php">logout</a></li>
                </ul>
            </div>
        </h1>
    </header>
 
</html>