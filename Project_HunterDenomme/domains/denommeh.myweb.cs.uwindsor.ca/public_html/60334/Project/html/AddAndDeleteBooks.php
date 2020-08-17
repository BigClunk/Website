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

  function get_post($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }

    if(isset($_POST['category']) &&
      isset($_POST['isbn']) &&
      isset($_POST['addBook']))
    {
         $author  = get_post($conn, 'author');
         $title  = get_post($conn, 'title');
         $category  = get_post($conn, 'category');
         $year  = get_post($conn, 'year');
         $isbn  = get_post($conn, 'isbn');
        
         

          $query = "INSERT INTO classic(author, title, category, year, isbn) VALUES('$author','$title','$category',$year, '$isbn');";
          $result = $conn->query($query);
          if ($result){ 
            print '<script type="text/javascript">';
            print'alert ("Your book has been added")';
            print'</script>';
          }else{
             echo "INSERT failed: $query<br>" . $conn->error . "<br><br>";
          }
          
          
    }


    if(isset($_POST['author']) &&
      isset($_POST['title']) &&
      isset($_POST['Title_delete']))
    {
         $author  = get_post($conn, 'author');
         $title  = get_post($conn, 'title');

          $query = "DELETE FROM classic WHERE author like '$author' AND title like '$title';";
          $result = $conn->query($query);
          if ($result) {
            print '<script type="text/javascript">';
            print'alert ("Your book has been Deleted")';
            print'</script>';
          }else{
            echo "DELETE failed: $query<br>" .$conn->error . "<br><br>";
          }     
    }


if(isset($_POST['isbn']) &&
      isset($_POST['ISBN_delete']))
    {
         $isbn  = get_post($conn, 'isbn');

          $query = "DELETE FROM classic WHERE isbn like '$isbn';";
          $result = $conn->query($query);
          if ($result){
             print '<script type="text/javascript">';
            print'alert ("Your book has been Deleted")';
            print'</script>';
          }else{
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
                
                    <h2 > Add book</h2>
                        <form id = "addBook" action="AddAndDeleteBooks.php" method="POST" ><pre>
                            <input placeholder="Author" type="text" id = "author" name="author"  required>
                            <input placeholder = "Title" type="text" if = "title" name="title" required>
                            <input placeholder = "Category" type="text" id = "category" name="category" required>
                            <input  placeholder = "Year" type="text" id = "year" name="year" required>
                            <input placeholder = "ISBN" type="text"  ISBN = "ISBN" name="isbn" required>
                            <input type="hidden" name="addBook" value="yes">
                            <input type="submit" value="Add Book">
                        </pre>
                    </form>
              
                        </br>  
                        
                         <h2>Delete by Title and Author</h2>
                        <form id = "addBook" action="AddAndDeleteBooks.php" method="POST" align="center"><pre>                           
                            <input type="hidden" name="Title_delete" value="yes">
                            <input  placeholder = "Author"  type="text"  id = "author" name="author" required>
                            <input  placeholder = "Title" type="text" id = "title" name="title" required>
                            <input type="submit" value="Delete Book">
                       </pre>
                    </form>
                            </br>
           
                             <h2>Delete by ISBN  </h2>
                            <form id="addBook" action="AddAndDeleteBooks.php" method="post"><pre>    
                                <input type="hidden" name=" ISBN_delete" value="yes">
                                <input  placeholder = "ISBN" type="text" id = "isbn" name="isbn"  required>
                                <input type="submit" value="Delete Book">
                            </pre>
                            </form>
                            </br>       
                        
                        <?php 
                            $query    = "select n.* from classic n";
                            $result = $conn->query($query);
                            if (!$result) echo "SEARCH failed: $query<br>" . $conn->error . "<br><br>";
                            foreach($result as $rows){
                              
                                $authorString = $rows['author'];
                                $titleString = $rows['title'];
                                $categoryString = $rows['category'];
                                $yearString = $rows['year'];
                                $isbnString = $rows['isbn'];
                                
                               
                        
                                " <table>
                                            <tr><br>Author: $authorString<br></tr> 
                                            <tr>Title: $titleString<br></tr> 
                                            <tr>Category: $categoryString<br></tr> 
                                            <tr>Year: $yearString<br></tr> 
                                            <tr>ISBN: $isbnString<br></tr> 
                                </table>
                                    </td>
                                    </tr>
                                "; 
                            }
                        ?>
                        
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