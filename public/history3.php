<?php
	// เชื่อมต่อ MySQL database
	$servername = "containers-us-west-153.railway.app"; #hostname
	$username = "root";
	$password = "2z3BskkBbvcnhQN6h445";
	$dbname = "railway";
    $port = 6300;
	$conn = mysqli_connect($servername, $username, $password, $dbname, $port);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	// ดึงข้อมูลจากตาราง
	$sql = "SELECT * FROM device LIMIT 20 OFFSET 40";
	$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard RS485</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">

</head>

<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="./logo.png">
                    <h2>PRE<span class="danger">PROJECT</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">close</span>
                </div>
            </div>
            <div class="sidebar">
                <a href="index.php">
                    <span class="material-icons-sharp">dashboard</span>
                    <h3>Dashboard</h3>
                </a>

                <a href="history.php" class="active">
                    <span class="material-icons-sharp">history</span>
                    <h3>History</h3>
                </a>

                <a href="about.php">
                    <span class="material-icons-sharp">diversity_3</span>
                    <h3>About</h3>
                </a>

                <div class="theme" id="icon">
                    <span class="material-icons-sharp active">light_mode</span>
                    <span class="material-icons-sharp">dark_mode</span>
                </div>
            </div>
        </aside>

        <!--------เชื่อม script ----------->

        <script src="./index.js"></script>

        <!--------------จบ aside --------->
        <main>
            <div class="tophistory">

                <button class="number"><a href="history.php" >1</a></button>

                <button class="number"><a href="history2.php" >2</a></button>

                <button class="number"><a href="history3.php" class="activeclick">3</a></button>

                <button class="number"><a href="history4.php">4</a></button>
                
                <button class="point"><a href="">...</a></button>

                <button class="new"><a href="historynew.php">NEW</a></button>

            </div>
            <div class="history">
                <h1>HISTORY</h1>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>TEMPERATURE</th>
                            <th>HUMIDITY</th>
                            <th>UPTIME</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["temp"] . " °C</td>";
                            echo "<td>" . $row["humid"] . " %RH</td>";
                            echo "<td>" . $row["uptime"] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>    
                </table>
            </div>
        </main>
    </div>
</body>

</html>