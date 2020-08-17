<?php
    session_start();
    
    require_once 'login.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);

    $userType = 102;

    if (isset($_SESSION['$userType'])){
        $userType = $_SESSION['$userType'];
    }
    else {
        $userType = 102;
    }

?>
<html>
    <head>
        <link href="http://denommeh.myweb.cs.uwindsor.ca/60334/Project/css/main.css" rel="stylesheet" type="text/css">  
          <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </head>
    <h3 align=right id = "signIn" ><a href="SignIn.php"><b>Login</b></a></h3>
    <h1 class="header" align="center"><IMG id="logo" alt="Library Icon" src="../pictures/logo.jpg" align="left"> <a>The Library</a></h1>
    <body>
        <div class="content">
            <div class="content-inside">
                <?php
              if($userType == 102) {
                echo '<div class = "topnav" align=center>
                    <a class="active" href="http://denommeh.myweb.cs.uwindsor.ca//60334/Project/html/Home.php">Home</a>
                    <a class="active" href="http://denommeh.myweb.cs.uwindsor.ca//60334/Project/html/SearchBooks.php">Search Book</a>
                 </div>';
              }
               
                    if($userType == 101){
                        echo' <div class = "topnav">
                                <a class="active" href="http://denommeh.myweb.cs.uwindsor.ca//60334/Project/html/Home.php">Home</a>
                                <a class="active" href="http://denommeh.myweb.cs.uwindsor.ca//60334/Project/html/SearchBooks.php">Search Book</a>
                                <a class="active" href="http://denommeh.myweb.cs.uwindsor.ca//60334/Project/html/Stats.php">View Stats</a>
                                <a class="active" href="http://denommeh.myweb.cs.uwindsor.ca//60334/Project/html/searchAccount.php">Search Accounts</a>
                                </div>';
                    }
                       
                    if($userType == 100){    
                        echo '<div class = "topnav">
                            <a class="active" href="http://denommeh.myweb.cs.uwindsor.ca//60334/Project/html/Home.php">Home</a>
                            <a class="active" href="http://denommeh.myweb.cs.uwindsor.ca//60334/Project/html/SearchBooks.php">Search Book</a>
                            <a class="active" href="http://denommeh.myweb.cs.uwindsor.ca//60334/Project/html/Stats.php">View Stats</a>
                            <a class="active" href="http://denommeh.myweb.cs.uwindsor.ca//60334/Project/html/searchAccount.php">Search Accounts</a>
                            <a class="active" href = "http:///denommeh.myweb.cs.uwindsor.ca//60334/Project/html/AddAndDeleteBooks.php"> Add/Delete Books </a>
                            <a class="active" href = "http:///denommeh.myweb.cs.uwindsor.ca//60334/Project/html/AddAndDeleteUsers.php"> Add/Delete Users</a>
                            
                         </div>';
                    }
                ?>
                 </div> 
                   <h2>Welcome to The Library </h2>
                   <h3 algin=center id="locate"> Located at  Paul Martin Sr. Building, 185 Ouellette Avenue, Windsor, ON N9A 5S8</h3>
                   <center><IMG id="photo" alt="Library Icon" src="../pictures/photo.jfif" align="center" alt="front page picture"></center>
         </div>
        
            <! footer of the web page!>
        <footer class="footer" align="center" >
            <p>Created by Hunter Denomme, Student Number: 110022336, Email: <a href="mailto: denommeh@uwindsor.ca">denommeh@uwindsor.ca</a></p>
         </footer>
    </body>

</html>