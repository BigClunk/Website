<?php
   session_start();
    
    require_once 'login.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);

    function get_post($conn, $var)
    {
        return $conn->real_escape_string($_POST[$var]);
    }

        $author    = get_post($conn, 'author');
        $title    = get_post($conn, 'title');
        $category = get_post($conn, 'category');
        $year    = get_post($conn, 'year');
        $isbn = get_post($conn, 'isbn');   
        $availablity = get_post($conn, 'availablity');
            
            if(strcmp($availablity, "")==0){
                $availablity= "Any";
            }

            if(strcmp($availablity, "Any")==0){
                $query    = "select b.* from classic b  WHERE";
            }
            
            if(strcmp($availablity, "Available")==0){
                $query    = "select b.* 
                from classic b
                where  b.isbn not in (select b.isbn 
                    from classic b, person p, withdrawal w 
                    WHERE w.person_id = p.person_id 
                    AND w.return_date is null)
                AND";                
            }
        
            if(strcmp($availablity, "Withdrawn")==0){
                $query    = "select b.*, w.withdraw_date, w.due_date, w.return_date, p.firstName, p.lastName 
                from classic b, person p, withdrawal w 
                WHERE w.person_id = p.person_id 
                AND w.return_date is null AND";
            }
          
            $query    = $query." b.author like '%$author%' AND b.title like '%$title%' AND b.isbn like '%$isbn%'";     
            
            if (strcmp($category,"Any")!=0) {
                $query    = $query." AND b.category like '$category'";
            }
            else{
                $query    = $query." AND 1=1";
            }

            if ($year != 0){
                $query    = $query." AND b.year = $year";
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
                print'alert ("Your file/files have been located")';
                print'</script>';
            }

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
                                $authorString = $rows['author'];
                                $titleString = $rows['title'];
                                $categoryString = $rows['category'];
                                $yearString = $rows['year'];
                                $isbnString = $rows['ISBN'];
                               
                                echo "<td><table>
                                            <tr>Author: $authorString<br></tr> 
                                            <tr>Title: $titleString<br></tr> 
                                            <tr>Category: $categoryString<br></tr> 
                                            <tr>Year: $yearString<br></tr> 
                                            <tr>ISBN: $isbnString<br></tr>
                                            </br>
                                        </table>
                                    </td>
                                "; 
                                
                                if(($userType ==1)&&(strcmp($availablity, "Withdrawn")==0)){
                                    $firstNameString = $rows['firstName'];
                                    $lastNameString = $rows['lastName'];
                                    $withdraw_dateString = $rows['withdraw_date'];
                                    $due_dateString = $rows['due_date'];
                                    echo "<td>This book was withdrawn by $firstNameString $lastNameString on $withdraw_dateString and is due by $due_dateString.</td>";
                                }
                                
                                echo "</tr>";
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