<html>

    <?php
    session_start();
    $user = $_SESSION["Username"];
    ?>
                
    <header id=bar_up>
    <h1>
        <div id=menu>
            <ul>
               <li class="nav-item"><a class="nav-link" href="library.php">Search</a></li>
               <li class="nav-item"><a class="nav-link" href="login.php">Postings</a></li>
            </ul>
        </div>
    </h1>
 
        <p id = "content"> </p>
    </header>
 
</html>