<html>
 
    <head>
        <link rel="stylesheet" href="style_sheet.css">
        <title>Login</title>
    </head>

    <body id ="blur">
        <div>
            <div id ="clear">
                <h1>Login</h1>
                <form method=POST>
                    <div>
                        <input id="user" type="text" name="user" placeholder="Username">
                    </div>
                    <div>
                        <input id="pass" type="password" name="pass" placeholder="Password">
                    </div>
                    <button name="sub" type="submit">Login</button>
                    <button name="submitNew" type="submit">Create New User</button>
                </form>
            </div>
        </div>

        <?php
            // Report all error information on the webpage
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            // submitting new user and pass
            if (isset($_POST["submitNew"])) {
                $servername = "localhost";
                $username = "admin"; // user name
                $password = "admin"; // password used to login MySQL server
                $dbname = "410flashcards";
        
                // Create connection
                $db = new mysqli($servername, $username, $password, $dbname);
                // db location, user, passwd, database
        
                if ($db->connect_errno > 0) {
                    die('Unable to connect to database [' . $db->connect_error . ']');
                } else {
                    $user = $_POST["user"]; // turn into string taken from https://www.geeksforgeeks.org/php-strval-function/#:~:text=The%20strval()%20function%20is,or%20double)%20to%20a%20string.
                    $pass = $_POST["pass"];
        
                    $check = 0; // if this is >0 then there is already a usersame with that user input
                    $sql = "SELECT Username FROM login";
                    $result = $db->query($sql);
        
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) { // info about query"https://www.w3schools.com/php/php_mysql_select.asp
                            if ($row["username"] == $user) {
                                $check = 1;
                                echo '<script>alert("Username already exists")</script>';
                            }
                        }
                    }
        
                    if ($check == 0) {
                        $sql_insert = "INSERT INTO login VALUES ('" . $user . "', '" . $pass . "')"; // syntax
                        $db->query($sql_insert) or die('Sorry, database operation was failed');
                        session_start();
                        $_SESSION["Username"] = $user;
                        echo '<script>alert("Account created :D")</script>';
                        header("Location:decks.php");
                        exit();
                    }
                }
                $db->close();
            }
        
            if (isset($_POST['sub'])) {
                $servername = "localhost";
                $username = "admin"; 
                $password = "admin"; 
                $dbname = "410flashcards";
        
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                $check = 0;

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
        
                // Use prepared statement in SQL
                $name = $_POST['user'];
                $pass = $_POST['pass'];
                $sql = "SELECT * FROM login";
        
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) { // info about query"https://www.w3schools.com/php/php_mysql_select.asp
                        if ($row["username"] == $name) {
                            $check = 1;
                            if ($row["password"] != $pass) {
                                echo '<script>alert("Username does not match password")</script>';
                            } else {
                                echo "connected";
                                session_start();
                                $_SESSION["Username"] = $name;
                                header("Location: decks.php");
                                exit();
                            }
                        }
                    }
                    if ($check == 0) {
                        echo '<script>alert("Username does not exist")</script>';
                    }
                }
                $result->close();
                $conn->close();
            }
        ?>

    </body>
</html>