<!-- Articles Page Content -->
<div class="container">
    <h1 class="mt-4 mb-3">Articles</h1>

    <!-- mwilliams:  breadcrumb navigation -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Articles</li>            
    </ol>
    <!-- end breadcrumb -->

    <?php
        // these two lines are required anytime you need to connect to the database
        // 1.  get the configureation file (holds the connection info)
        require './includes/config.php';

        // 2.  connect to the database
        require MYSQL;
        // var_dump($dbc);
        
        // 3.  get the total number of records from the categories table
        $sql = 'SELECT COUNT(*) FROM pages';
        $stmt = $dbc->query($sql); // executes the query, returns the results in a variable (this is object oriented)
        $cnt = $stmt->fetchColumn(); // get one column result, useful because you don't have to loop

        // 4.  display the total number of categories
        echo "<h2>Total Articles: $cnt</h2>";

        // 5.  build the sql query to retrieve all articles
        $q = "SELECT id, title, description FROM pages;";

        // 6.  execute the query
        $stmt = $dbc->query($q);
        
        // 7.  fetch all the records from the statement above
        $article_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // 8.  loop and display the article pages in an html table
        // start the table
                echo "<table class='table table-striped table-bordered'>"

                . "<thead class='thead-dark'>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                    </tr>
                   </thead>
                   <tbody>";
                
                foreach($article_list as $row) {
                    echo "<tr>
                            <td><a href='article.php?id={$row['id']}'>{$row['title']}</a></td>
                            <td>{$row['description']}</td>
                          </tr>";
                }
                
                // hyperlink will look like this
                // <a href='article.php?id=3'>Quick Guide to Common Attacks</a>
                
                
        // end the table
                echo "</tbody></table>";
    
    
    ?>
</div>

