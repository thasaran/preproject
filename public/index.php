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
	$sql = "SELECT * FROM air_temp ORDER BY id DESC LIMIT 1";
    $sql2 = "SELECT * FROM rs485 ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($conn, $sql);
    $result2 = mysqli_query($conn, $sql);
    $result3 = mysqli_query($conn, $sql2);
    $result4 = mysqli_query($conn, $sql2);

    $result5 = mysqli_query($conn, $sql);
    $result6 = mysqli_query($conn, $sql);
    $result7 = mysqli_query($conn, $sql2);
    $result8 = mysqli_query($conn, $sql2);
    $result9 = mysqli_query($conn, $sql2);
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
            </div>
            <div class="sidebar">
                <a href="index.php" class="active">
                    <span class="material-icons-sharp">dashboard</span>
                    <h3>Dashboard</h3>
                </a>

                <a href="history.php">
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
        <div class="main">
            <h1>Dashboard</h1>

            <div class="clearfix"></div>

            <div class="sensor">
                <div class="box">
                    <?php
				    while($row = mysqli_fetch_assoc($result)) {
                        echo "<p>" . $row["temp"] . "<br />";
                        echo "<span>temp1</span></p>";
				    }
				    ?>
                    <span class="material-icons-sharp">thermostat</span>
                </div>
            </div>

            <div class="sensor">
                <div class="box">
                    <?php
				    while($row = mysqli_fetch_assoc($result2)) {
                        echo "<p>" . $row["humid"] . "<br />";
                        echo "<span>Humid1</span></p>";
				    }
				    ?>
                    <span class="material-icons-sharp">water_drop</span>
                </div>
            </div>

            <div class="sensor">
                <div class="box">
                    <?php
				    while($row = mysqli_fetch_assoc($result3)) {
                        echo "<p>" . $row["temp"] . "<br />";
                        echo "<span>Temp2</span></p>";
				    }
				    ?>
                    <span class="material-icons-sharp">thermostat</span>
                </div>
            </div>

            <div class="sensor">
                <div class="box">
                    <?php
				    while($row = mysqli_fetch_assoc($result4)) {
                        echo "<p>" . $row["humid"] . "<br />";
                        echo "<span>Humid2</span></p>";
				    }
				    ?>
                    <span class="material-icons-sharp">water_drop</span>
                </div>
            </div>

            <div class="status">
                <div class="boxstatus">
                    <div class="content-box">
                        <div class="contentstatus">
                            <h1>Status </h1> 
                            <div class="statuswater">
                                <?php
                                while($row = mysqli_fetch_assoc($result9)) {
                                    echo "<h2>Water Required : <span>" . $row["status"] . "</span>";
                                    echo " mL</h2>";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="img-tree"><img src="./tree.png"></div>
                    </div>
                </div>
            </div>

            <div class="value">
                <div class="boxvalue">
                    <div class="tablevalue">
                        <h1>value</h1>
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Value</th>
                                    <th>Unit</th>
                                    <th>Uptime</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($result5)) {
                                    echo "<tr>";
                                    echo "<td>Air Temperature</td>";
                                    echo "<td>" . $row["temp"] . "</td>";
                                    echo "<td>°C</td>";
                                    echo "<td>" . $row["uptime"] . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                                <?php
                                while($row = mysqli_fetch_assoc($result7)) {
                                    echo "<tr>";
                                    echo "<td>Air Humidity</td>";
                                    echo "<td>" . $row["humid"] . "</td>";
                                    echo "<td>%RH</td>";
                                    echo "<td>" . $row["uptime"] . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                                <?php
                                while($row = mysqli_fetch_assoc($result6)) {
                                    echo "<tr>";
                                    echo "<td>Soil Temperature</td>";
                                    echo "<td>" . $row["temp"] . "</td>";
                                    echo "<td>°C</td>";
                                    echo "<td>" . $row["uptime"] . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                                <?php
                                while($row = mysqli_fetch_assoc($result8)) {
                                    echo "<tr>";
                                    echo "<td>Soil Humidity</td>";
                                    echo "<td>" . $row["humid"] . "</td>";
                                    echo "<td>%RH</td>";
                                    echo "<td>" . $row["uptime"] . "</td>";
                                    echo "</tr>";
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>

</html>