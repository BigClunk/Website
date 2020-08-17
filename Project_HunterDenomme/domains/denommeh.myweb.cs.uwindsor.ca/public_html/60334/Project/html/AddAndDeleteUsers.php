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
  function get_post($conn, $var){
    return $conn->real_escape_string($_POST[$var]);
  }

    if(isset($_POST['firstName']) &&
       isset($_POST['lastName']) &&
       isset($_POST['username']) &&       
       isset($_POST['password']) &&
       isset($_POST['addUser']))
       {
         $firstName  = get_post($conn, 'firstName');
         $lastName  = get_post($conn, 'lastName');
         $username  = get_post($conn, 'username');
         $password  = get_post($conn, 'password');
         $userType  = get_post($conn, 'userType');
        $query = "INSERT INTO account(firstName, lastName, username, password, userType) VALUES('$firstName','$lastName','$username','$password', $userType);";
          $result = $conn->query($query);
          if ($result){ 
            print '<script type="text/javascript">';
            print'alert ("The user has been added")';
            print'</script>';
          }
          else{
             echo "INSERT failed: $query<br>" . $conn->error . "<br><br>";
          }
    }                   

   if(isset($_POST['username']) &&
      isset($_POST['deleteUser']))
    {
         $username  = get_post($conn, 'username');

          $query = "DELETE FROM account WHERE username like '$username';";
          $result = $conn->query($query);
          if ($result) {
            print '<script type="text/javascript">';
            print'alert ("The user has been deleted")';
            print'</script>';
          }
          else{
             echo "DELETE failed: $query<br>" .$conn->error . "<br><br>"; 
          }      
    }


?>
<html>
    <head>
        <link href="http://denommeh.myweb.cs.uwindsor.ca/60334/Project/css/main.css" rel="stylesheet" type="text/css">  
          <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </head>
    <h3 align=right id ="signIN"><a href="SignIn.php"><b>Login</b></a></h3>
   
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
           
            
                    <h2>Add User </h2>
                    <form id="addBook" action="AddAndDeleteUsers.php" method="post" ><pre>  
                        <input  placeholder = "First Name:"type="text" id="firstName" name="firstName" required>
                        <input placeholder = "Last Name:" type="text" id= "lastName" name="lastName" required>
                        <input placeholder = " User Type:" type="text" id="userType" name="userType" required>
                        <input placeholder = "User Name:" type="text" id="username" name="username" required>
                        <input placeholder = "Password:" type="text" id="password" name="password" required>
                        <input type="hidden" name="addUser" value="yes">                   
                        <input type="submit" value="Add User">
                    </pre>
                </form>

                    <h2>Delete User </h2>
                    <form id="addBook"  action="AddAndDeleteUsers.php" method="post"><pre> 
                    <input type="hidden" name="deleteUser" value="yes">
                    <input placeholder= "Username:" type="text" id = ""username" name="username" required>
                    <input type="submit" value="Delete User">
                    </pre>
                </form>
                     <br>                       

                    <?php
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