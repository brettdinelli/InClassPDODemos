    <!-- Categories Page Content -->
    <div class="container">
        <h1 class="mt-4 mb-3">Categories</h1>
        
        <!-- mwilliams:  breadcrumb navigation -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Categories</li>            
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
            $sql = 'SELECT COUNT(*) FROM categories';
            $stmt = $dbc->query($sql); // executes the query, returns the results in a variable (this is object oriented)
            $cnt = $stmt->fetchColumn(); // get one column result, useful because you don't have to loop
            
            // 4.  display the total number of categories
            echo "<h2>Total Categories: $cnt</h2>";
            
            // 5.  build the SQL query to retrieve all categories
            $q = "select id, category from categories order by 1";            
            
            // 6.  execute the query
            $stmt = $dbc->query($q);
            $category_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // var_dump($category_list);
            // start the list
            echo "<ul class='list-group'>";
            echo '<li class="list-group-item active">Select a Category</li>';
            
            // loop the array and display it in a ul list
            foreach($category_list as $row) {
                echo "<li class='list-group-item'>
                        <a href='articlesbycategory.php?id={$row['id']}'>{$row['category']}</a> 
                      </li>";
            }
            
            // end the list
            echo "</ul>";
            
            // review: 
            // =    assignment
            // ==   comparison
            // ===  comparison of data types
            // !=   not equal
            // !==  same, in case statements
            // =>   assignment in an array
            // ->   calling a method in object oriented

        ?>
    </div>