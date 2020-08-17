<?php
  session_start();
    
    require_once 'login.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);

    $username = _SESSION['$username'];

   $userType = 102;

    if (isset($_SESSION['$userType'])){
        $userType = $_SESSION['$userType'];
    } else {
        $userType = 102;
    }

?>
<html>
    <head>
        <link href="http://denommeh.myweb.cs.uwindsor.ca/60334/Project/css/main.css" rel="stylesheet" type="text/css"> 
          <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
      
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart1);
            google.charts.setOnLoadCallback(drawChart2);
            google.charts.setOnLoadCallback(drawChart3);
            
            function drawChart1() {
                var data = google.visualization.arrayToDataTable([
                  ['author', 'Number of Books']
                  <?php
                    $query = "SELECT n.author, count(*) as cnt FROM classic n GROUP BY n.author;";
                    $result = $conn->query($query);

                    while($row = mysqli_fetch_array($result)){
                        printf(",\n['%s', %s]",$row[0],$row[1]);
                    }
                    ?>    
                ]);
                var options = {
                    title: 'Books by Author'            
                };
                var chart = new  google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
            }
            
            function drawChart2() {
                var data = google.visualization.arrayToDataTable([
                  ['Types of Users' ,'Number of Users']
                  <?php
                    $query = "SELECT n.userType, count(*) as cnt FROM account n GROUP BY n.userType;";
                    $result = $conn->query($query);
                    while($row = mysqli_fetch_array($result)){
                         printf(",\n['%s', %s]",$row[0],$row[1]);
                    }
                    ?>    
                ]);
                var options = {
                    title: 'Types of Users'
                };
                var chart = new   google.visualization.BarChart(document.getElementById('barchart'));
                chart.draw(data, options);
            }
            
            function drawChart3() {
                var data = google.visualization.arrayToDataTable([
                  ['year', 'Number of Books']
                  <?php
                    $query = "SELECT n.year, count(*) as cnt FROM classic n GROUP BY n.year;";
                    $result = $conn->query($query);

                    while($row = mysqli_fetch_array($result)){
                        printf(",\n['%s', %s]",$row[0],$row[1]);
                    }
                    ?>    
                ]);
                var options = {
                    title: 'Books by Year'            
                };
                var chart = new  google.visualization.PieChart(document.getElementById('piechart2'));
                chart.draw(data, options);
            }


            
           
    </script>
    </head>
     <h3 align=right id = signIn ><a href="SignIn.php"><b>Login</b></a></h3>
   
   <h1 class="header" align="center"><IMG id="logo" alt="Library Icon" src="../pictures/logo.jpg" align="left"> <a>The Library</a></h1>
        
    <body>
       
        <div class="content">
            <div class = "content-inside">
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
                    <h2>
                        <div id="piechart" style="width: 100%; height: 500px;"></div>
                        <br><br><br>
                        <div id="barchart" style="width: 100%; height: 500px;"></div>
                         <br><br><br>
                       <div id="piechart2" style="width: 100%; height: 500px;"></div>
                         
                       
                    </h2>
                 </div> 
         </div>
         </div>
         </div>
            
         <! footer of the web page!>
        <footer class="footer" align="center" >
            <p>Created by Hunter Denomme, Student Number: 110022336, Email: <a href="mailto: denommeh@uwindsor.ca">denommeh@uwindsor.ca</a></p>
         </footer>
            
    </body>
    
</html>