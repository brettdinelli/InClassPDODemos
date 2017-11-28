<ul class="navbar-nav ml-auto">


    <?php
            // convert above static menu to a dynamic menu using an array of labels
            // of pages to allow us to dynamically set the active menu item based on 
            // the current page the user is currently visiting

        $pages = array(
            'Home'=>'/InClassPDODemos/index.php',
            'Categories'=>'/InClassPDODemos/categories.php',
            'Articles'=>'/InClassPDODemos/articles.php',
            'About'=>'/InClassPDODemos/about.php',
            'Services'=>'/InClassPDODemos/services.php',
            'Contact'=>'/InClassPDODemos/contact.php',
        );
        
        // find out which page the user is viewing
        $this_page = $_SERVER['REQUEST_URI'];
        // test
        // echo $this_page;
        // exit();
        // end test
        
        // loop the array and check if the array page matches $this_page
        foreach($pages as $k=>$v):
            echo '<li class="nav-item';
            
                if($this_page==$v) {
                    echo ' active">';
                }
                else {
                    echo '">';
                }
            echo '<a class="nav-link" href="'.$v.'">'. $k.'</a>
                    </li>';
        endforeach;
                    
        
        
    ?>

</ul>