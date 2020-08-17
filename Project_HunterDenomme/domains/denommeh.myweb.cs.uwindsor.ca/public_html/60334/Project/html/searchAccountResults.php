<?php
    session_start();
    
    require_once 'login.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);

    function get_post($conn, $var)
    {
        return $conn->real_escape_string($_POST[$var]);
    }
        $firstName    = get_post($conn, 'firstName');
        $lastName = get_post($conn, 'lastName');
        $userType    = get_post($conn, 'userType');
        
            
            $query    = "select n.* from account n  WHERE n.firstName like '%$firstName%' AND n.lastName like '%$lastName%'";
        
          
            $query    = $query."";     
            
            if (strcmp($userType,"Any")!=0) {
                $query    = $query." AND n.userType like '$userType'";
            }
            else{
                $query    = $query." AND 1=1";
            }

          

            $query    = $query.";";
            $result   = $conn->query($query);

            if (!$result){		
                echo "SEARCH failed: $query<br>".$conn->error."<br><br>";
            } else {
                print '<script type="text/javascript">';
                print'alert ("The user has been found")';
                print'</script>';
            }

    $userType = 5;

    if (isset($_SESSION['$userType'])){
        $userType = $_SESSION['$userType'];
    } else {
        $userType = 5;
    }
?>
<html>
    <head>
        <link href="http://denommeh.myweb.cs.uwindsor.ca/60334/Project/css/main.css" rel="stylesheet" type="text/css">  
          <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </head>
     <h3 align=right id = signIn><a href="http://denommeh.myweb.cs.uwindsor.ca/60334/Project/html/SignIn.php"><b>Login</b></a></h3>
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
           
                        <?php 
                            foreach($result as $rows){
                                                  
                                $firstName = $rows['firstName'];
                                $lastName = $rows['lastName'];
                                $username = $rows['username'];
                                $userType = $rows['userType'];
                                
                                echo "<tr><td><table>
                                            <tr>First Name: $firstName<br></tr> 
                                            <tr>Last Name: $lastName<br></tr> 
                                            <tr>Username: $username<br></tr>
                                            <tr >Password: *********<br></tr>
                                            <tr>User Type: $userType<br></tr> 
                                            </br>
                                        </table>
                                    </td>
                                </tr>
                                "; 
                            }
                        ?>
                       </div> 
         </div>
            
                 <! footer of the web page!>
        <footer class="footer" align="center" >
            <p>Created by Hunter Denomme, Student Number: 110022336, Email: <a href="mailto: denommeh@uwindsor.ca">denommeh@uwindsor.ca</a></p>
         </footer>
            
    </body>
   
</html>