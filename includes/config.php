<?php

/* 
 *  There are 2 ways to bring external scripts into existing: 
 *  1.  include
 *  2.  require
 * 
 *  note:  there is also an include_once and require_once
 * 
 *  the differences between each are: 
 *  
 *  failure to include a file results in a warning, but the script continues
 *  failure to require a file results in a fatal error and the script is halted
 * 
 *  typically use include for files like html header, footer, sidebar, etc.
 * 
 *  typically use require for files that are critical to the site functionality
 *  like database connections, configuration files, etc. 
 */

// retrieve the database info (outside of the root folder)
$root = dirname($_SERVER['DOCUMENT_ROOT']).'/dbconn';
// echo $root; // C:/xampp/dbconn

// create another constant to represent the final db connection file location 
define('MYSQL',$root.'/2017_pdo_connect.php');
// var_dump(MYSQL);

// giving the final path
// C:/xampp/dbconn/2017_pdo_connect.php

