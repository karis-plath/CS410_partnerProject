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
                <li class="nav-item"><a class="nav-link" href="javascript:logout();">logout</a></li>
                </ul>
            </div>
        </h1>

        <script>
            function logout() {
            sessionStorage.clear();
            window.location.href = "login.php"; // Redirect to login page
            }
        </script>
    </header>
 
</html>