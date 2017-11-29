<!-- Single Article Page Content -->
<div class="container">
    <h1 class="mt-4 mb-3">Article</h1>
    
    <?php
        // var_dump($_GET);
        // 1.  retrieve the id parameter from the url querystring
        if ( isset($_GET['id']) && is_numeric($_GET['id']) ) {
           $id = $_GET['id']; 
           
           // 2.  get the database configuration file
           require './includes/config.php';
        
           // 3.  connect to the database
           require MYSQL;
        
           // 4.  build the sql query using a prepared statement
           $stmt = $dbc->prepare("SELECT id, title, content 
                                  FROM pages 
                                  WHERE id=:id");
           
           // using pdo prepared statement with the following named parameter :id
           
           // bind the parameter
           $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
           // 5.  execute the query
           $stmt->execute();
           
           // 6.  fetch the records
           $article = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
           // var_dump($article);
           
           // 7.  display the article
           foreach($article as $row) {
                echo "<ol class='breadcrumb'>
                        <li class='breadcrumb-item'><a href='index.php'>Home</a></li>
                        <li class='breadcrumb-item'><a href='articles.php'>Articles</a></li> 
                        <li class='breadcrumb-item active'>{$row['title']}</li>
                     </ol>";
                
                // show the title of the article under the breadcrumbs
                echo "<h2 class = 'mt-3 mb-3'>{$row['title']}</h2>";
                echo $row['content'];
           }
        }
    
        
        
        

    ?>
    

    
    
</div>