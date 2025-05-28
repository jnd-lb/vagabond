<?php 

include('../functions/authenticate.php');
require_once('../functions/plates-functions.php');
require_once('../functions/users.php');
require_once('../functions/orders.php');
require_once('../functions/db.php');
$conn = openDatabaseConnection();

isLoggedIn();   

isAdmin();

//Prevent direct accesss
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    // Redirect to the login page
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    
    echo completeOrder($id,$conn);
   
}


?>