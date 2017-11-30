<!-- Articles Page Content -->


<!--gradtracker: add this code for adding a company or a title or a student-->

<div class="container">
    <h1 class="mt-4 mb-3">Add New Category</h1>

    <!-- mwilliams:  breadcrumb navigation -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Add Category</li>            
    </ol>
    <!-- end breadcrumb -->
<?php
    // 1.  check if the form was submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // var_dump($_POST);
        $category = trim(filter_var($_POST['category'], FILTER_SANITIZE_STRING));
        
        // test if the user entered something
        if(!empty($category)) {
            // 1.  get the configuration file (holds the connection info)
            require './includes/config.php';

            // 2.  connect to the database
            require MYSQL;
            
            // build the insert statement using prepared statements
            $stmt = $dbc->prepare("INSERT INTO categories(category) VALUES (:category)");
            
            // bind the named parameter :category to user input value
            $stmt->bindValue(':category', $category, PDO::PARAM_STR);
            
            try {
                // try to execute the query
                $stmt->execute();
                echo "<div class='alert alert-success' role='alert'>
                    The category <strong>$category</strong> has been inserted.
                </div>";
            } catch (Exception $ex) {
                $code = $ex->getCode();
                $message = 'Unknown system error';
                
                if($code == 23000) {
                    $message = 'You may not insert a duplicate category';
                }
                // if an error occurs, it will be trapped here
                echo "<div class='alert alert-danger' role='alert'>
                    The category <strong>$category</strong> was not inserted due to a system error.<br>"
                        . $message 
                        . "<p><a href=''>Please try again.</a></p>
                </div>";
            }
        } 
        
    } else {

        ?>

        <form class="form-inline" method="post" action="addCategory.php">
            <div class="form-group mx-sm-3">
                <label for="category" class="sr-only">Category</label>
                <input type="text" class="form-control" 
                       id="category" name="category" 
                       placeholder="Enter new category">
            </div>
            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>

        <?php
         }
        ?>

</div>