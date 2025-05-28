<?php 
    include('./functions/authenticate.php');
    require_once('./functions/orders.php');
    require_once('./functions/db.php');

    isLoggedIn();   

    
    //Prevent direct accesss
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        // Redirect to the login page
        header("Location: ./index.php");
        exit();
    }

    
    $conn = openDatabaseConnection();

    $userId = $_SESSION['user']['user_id'];
    

    $jsonData = $_POST['data'];

    // Decode the JSON data
    $orderData = json_decode($jsonData, true);

    return saveOrder($orderData,$userId,$conn);
    
?>    


