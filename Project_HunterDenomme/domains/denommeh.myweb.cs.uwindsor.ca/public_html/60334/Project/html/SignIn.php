<html>
<?php
    session_start();
    
    require_once 'login.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);

    function get_post($conn, $var)
      {
        return $conn->real_escape_string($_POST[$var]);
      }
    
      if (isset($_POST['username'])   &&
          isset($_POST['password']))
      {
            $username = get_post($conn, 'username');
            $password = get_post($conn, 'password');
            $query    = "SELECT * FROM account WHERE username like '$username' and password like '$password';";
            $result   = $conn->query($query);
            $rows = $result->num_rows;
            if ($rows==0){		
                echo "<h3>Either wrong username or password entered.<br></h3>";
            } 
          
            if ($rows==1){        
                foreach($result as $row){
                    $userType = $row['userType'];
                    $_SESSION['$userType'] = $userType;
                    $_SESSION['$username'] = $username;

                    if($userType == 100){
                        echo "<h3>Welcome Teacher: ".$row['fname']." ".$row['lname'].".<br></h3>";
                    }

                    if($userType == 101){
                        echo "<h3>Welcome Student: ".$row['fname']." ".$row['lname'].".<br></h3>";
                    }
                }
            }
            
            if($rows>1){
                echo "<h3>Error: Multiple users match this username.<br></h3>";
            } 
       }

    if (isset($_POST['logout'])){
        $_SESSION = array();       
    }       
 
    $userType = 102;

    if (isset($_SESSION['$userType'])){
        $userType = $_SESSION['$userType'];
    } else {
        $userType = 102;
    }
?>

    <head>
        <link href="http://denommeh.myweb.cs.uwindsor.ca/60334/Project/css/main.css" rel="stylesheet" type="text/css">  
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </head>
    <h3 align=right id = "signIn"><a href="SignIn.php"><b>Login</b></a></h3>
   
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
         
                    <h2>
                        <?php
                            if (($userType != 100)&&($userType!= 101)){
                        ?>
                                <form action="SignIn.php" method="post"><pre>
                                    Username: <input type="text" name="username">
                                    Password: <input type="password" name="password">
                                    <input type="submit" value="Log In">
                                </pre></form>
                                <br><br><br>
                        <?php 
                            }else{
                        ?>
                                <form action="SignIn.php" method="post"><pre>
                                <input type="submit" name="logout" value="Log Out" onclick="">
                                </pre>
                                </form>
                        <?php
                            }
                          $result->close();
                          $conn->close();
                        ?>
                    </h2>
                </div> 
         </div>
                
              <! footer of the web page!>
        <footer class="footer" align="center" >
            <p>Created by Hunter Denomme, Student Number: 110022336, Email: <a href="mailto: denommeh@uwindsor.ca">denommeh@uwindsor.ca</a></p>
         </footer>
       
    </body>
   
</html>