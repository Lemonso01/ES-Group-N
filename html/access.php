<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oceanographic Buoy for Multidomain Research - Home</title>
    <link rel="stylesheet" href="../css/access_style.css">
</head>
<body>

    <div class="navbar">
      <img src="../Images/feup_logo.png" class="logo" alt="Logo">
        <ul>
            <li><a href="main.php">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="access.php">Access</a></li>
        </ul>
    </div>

    <div class="main_text">
      <h1>Oceanographic Buoy</h1>
      <p>for Multidomain Research</p>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $host = "db.fe.up.pt";
        $port = "5432";
        $dbname = "boiafeup01";
        $user = "boiafeup01";
        $password = "es-n-2024";

        $connection = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
        if(!$connection){
            header('Location: main.php');
            exit();
        }
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        // It's important to use parameterized queries to prevent SQL injection
        $query = "SELECT * FROM data.credentials WHERE username = $1 AND password = $2";
        $result = pg_query_params($connection, $query, array($username, $password));

        if ($result && pg_num_rows($result) > 0) {
            header("Location: restricted.php");
            exit();
        } else {
            echo '<p id="error-message" style="color:red;">Invalid username or password</p>';
        }
    }
    ?>

    <div class="login-container">
        <h2>Login</h2>
        <form id="login-form" method="POST" action="access.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" id="login_button">Login</button>
        </form>
    </div>

    <div class="footer">
      <div class="f_navbar">
        <ul>
            <li><a href="cookies.html">Cookies</a></li>
            <li><a href="privacy.html">Privacy</a></li>
            <li><a href="terms.html">Terms & Conditions</a></li>
        </ul>
      </div>
      <p>&copy; 2024 FEUP - [ES] - Grupo N. All rights reserved.</p>  
    </div>
  
</body>
</html>
