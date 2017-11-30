<!-- Edit Category Page Content -->


<!--gradtracker: add this code for adding a company or a title or a student-->

<div class="container">
    <h1 class="mt-4 mb-3">Edit Category</h1>

    <!-- mwilliams:  breadcrumb navigation -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="categories.php">Categories</a></li>
        <li class="breadcrumb-item active">Edit Category</li>            
    </ol>
    <!-- end breadcrumb -->
    <?php
        // 1.  must retrieve a url parameter called id
        // var_dump($_GET);
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            // for the get
            // if we are here, we have our id parameter and it is numeric
            // store it in a variable for later use
            $id = $_GET['id'];
            
        }
        elseif (isset($_POST['id']) && is_numeric($_POST['id'])) {
            // for the post
            // if we get here, the user has posted 
            // need to retrieve the id from the hidden field 
            $id = $_POST['id'];
        }
        else {
            // the parameter is missing or it's not numeric - kill the script
            // and show an error message
            echo '<div class="alert alert-danger" role="alert">
                This page has been accessed in error.
                <p><a class="btn btn-dark" href="categories.php">Select a Category</a></p>
            </div>';
            
            // complete the proper closing html
            echo '</div>';
            include './includes/footer.php';
            
            die;

        }

        // good to go - we have our id parameter
        // connect to the database
        require './includes/config.php';
        require MYSQL;

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // var_dump($_POST);
            $category = trim(filter_var($_POST['category'], FILTER_SANITIZE_STRING));
            // test if the user entered something
            if(!empty($category)) {
                // build the prepared statement for the update
                $stmt = $dbc->prepare("update categories set category = :category where id = :id limit 1");
                
                // bind the two parameters to the variables
                $stmt->bindValue(':category', $category, PDO::PARAM_STR);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                
                // execute the statement
                try {
                    $stmt->execute();
                    echo "<div class='alert alert-success' role='alert'>
                        The category <strong>$category</strong> has been updated.
                    </div>";
                    
                } catch (Exception $ex) {
                    echo "<div class='alert alert-danger' role='alert'>
                        Error updating the category <strong>$category</strong><br>".
                        $ex->getMessage().
                    "</div>";
                }
            }
            
            
            
            
        } // end of post processing
        
        $q = "select category from categories where id=$id";
        $stmt = $dbc->query($q);
        $row = $stmt->fetchColumn();
        
        // test if we have any rows
        if ($row) {
            // found our category
            // var_dump($row);
            // create the html form 
        ?>
    
        <form class="form-inline" method="post" action="editCategory.php">
            <div class="form-group mx-sm-3">
                <label for="category" class="sr-only">Category</label>
                <input type="text" class="form-control" 
                       id="category" name="category" 
                       value="<?php echo $row; ?>">
            </div>
<!--            adding a hidden field so we have a primary key (id) to use in a where clause later-->
            <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
            <button type="submit" class="btn btn-primary">Edit Category</button>
        </form>
    
        <?php
        } 
        else {
            // if we get here, the id was not found in the table
            // for example, user manually entered id=1000 in the url
            echo '<div class="alert alert-warning" role="alert">
                This is an invalid category.<br>
                <a href="categories.php">Select a Category</a>
            </div>';
        }
        // die;
        ?>

</div>