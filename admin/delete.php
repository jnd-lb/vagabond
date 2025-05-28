<?php 

include('../functions/authenticate.php');
require_once('../functions/plates-functions.php');
require_once('../functions/users.php');
require_once('../functions/orders.php');
require_once('../functions/db.php');
require_once('../functions/categories-functions.php');
$conn = openDatabaseConnection();

isLoggedIn();   

isAdmin();

//Prevent direct accesss
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Redirect to the login page
    header("Location: ../index.php");
    exit();
}

$id = isset($_GET['id']) ? $_GET['id'] : null;
$page = isset($_GET['page']) ? $_GET['page'] : null;


    switch($page){
        case 'user':{
            deleteUser($id,$conn);
            break;
        }
        case 'plate':{
            deletePlate($id,$conn);
            break;
        }
        case 'order':{
            deleteOrder($id,$conn);
            break;
        }
        case 'category':{
            deleteCategory($id,$conn);
            break;
        }
    }

?>