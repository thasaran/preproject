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

                <a href="history.php">
                    <span class="material-icons-sharp">history</span>
                    <h3>History</h3>
                </a>

                <a href="about.php" class="active">
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

            <div class="topicmember">
                <h1>MEMBERS</h1>
            </div>

            <div class="member">

                <div class="img">
                    <img src="./song1.jpg" alt="">
                </div>

                <div class="content">
                    <div class="center">

                        <h2>Chayanon Wongnammai<br></h2>
                        <h3>ID 63010175<br></h3>
                        <p>
                            FB : Chayanon Wongnammai<br>
                            Line : songzee1955<br>
                            IG : song_cyn<br>
                            Call : 09 6043 2709
                        </p>

                    </div>
                </div>

            </div>

            <div class="member">

                <div class="img">
                    <img src="./rat1.jpg" alt="">
                </div>

                <div class="content">
                    <div class="center">
                        <h2>Thammarat Trisaranaapirak<br></h2>
                        <h3>ID 63010448<br></h3>
                        <p>
                            FB : Thammarat Trisaranaapirak<br>
                            Line : ratzamahoad<br>
                            IG : rat_tmr<br>
                            Call : 09 5525 3050
                        </p>
                    </div>
                </div>

            </div>

            <div class="member">

                <div class="img">
                    <img src="./firm1.jpg" alt="">
                </div>

                <div class="content">
                    <div class="center">
                        <h2>Thasaran Wongsuphachaipreecha<br></h2>
                        <h3>ID 63010450<br></h3>
                        <p>
                            FB : Thasaran Wongsuphachaipreecha<br>
                            Line : holyfirm<br>
                            IG : thasaran<br>
                            Call : 06 1842 9151
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>