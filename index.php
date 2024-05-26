<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oceanographic Buoy for Multidomain Research - Home</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>

    <div class="navbar">
      <img src="../Images/feup_logo.png" class="logo" alt="Logo">
        <ul>
            <li><a href="../html/main.php">Home</a></li>
            <li><a href="../html/about.html">About</a></li>
            <li><a href="../html/access.php">Access</a></li>
        </ul>
    </div>

    <div class="main_text">
      <h1>Oceanographic Buoy</h1>
      <p>for Multidomain Research</p>
    </div>

    <?php
    $host = "db.fe.up.pt";
    $port = "5432";
    $dbname = "boiafeup01";
    $user = "boiafeup01";
    $password = "es-n-2024";

    $connection = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
    if(!$connection){
        exit('Connection failed.');
    }

    $query = "SELECT * FROM data.sensor_data ORDER BY time_stamp DESC LIMIT 1";
    $result = pg_query($connection, $query);

    if ($result && pg_num_rows($result) > 0) {
        $data = pg_fetch_all($result);
    } else {
        $data = [];
        echo '<p id="error-message" style="color:red;">No data.</p>';
    }
    pg_close($connection);
    ?>

    <div class="table-box">
        <h1>Live Sensor Data</h1>
        <table id="data-table">
            <thead>
                <tr>
                    <th>Pressão</th>
                    <th>Humidade</th>
                    <th>Temperatura Interna</th>
                    <th>Temperatura Água</th>
                    <th>Água</th>
                    <th>Hora</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($data)) {
                    foreach ($data as $row) {
                      echo '<tr>';
                      echo '<td>' . htmlspecialchars($row['pressao']) . 'Pa</td>';
                      echo '<td>' . htmlspecialchars($row['humidade']) . '%</td>';
                      echo '<td>' . htmlspecialchars($row['temp_interna']) . '°C</td>';
                      echo '<td>' . htmlspecialchars($row['temp_agua']) . '°C</td>';
                      echo '<td>' . htmlspecialchars($row['agua']) . '</td>';
                      echo '<td>' . htmlspecialchars($row['time_stamp']) . '</td>';
                      echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>


    <div class="button-box">
      <div class="graph_button">
        <button class="btn btn-graph" onclick="window.location.href='graphs.html'">View Graphs</button>
      </div>    
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
  </div>
  
</body>
</html>
