

<?php


function saveOrder($orderData,$userId, $conn){

    // Prepare and execute the SQL statement to insert data into the orders table
    $sql = "INSERT INTO orders (user_id, products, total) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);


    // Calculate the total
    $total = 0;
    
    
    foreach ($orderData as $product) {
        $total += $product['quantity'] * $product['unitPrice'];
    }
    
    
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "iss", 
    $userId,
    json_encode($orderData,true),
    $total
);



    // Execute the statement
    mysqli_stmt_execute($stmt);
    
    // Check for success
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        return true;
    } else {
        return false;
    }
    
    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

function getUnhandeledOrdersCount($conn){
    $sql = "SELECT COUNT(*) AS unhandled_count FROM orders WHERE is_complete = false";

    $result = mysqli_query($conn, $sql);

 
    $row = mysqli_fetch_assoc($result);

    mysqli_free_result($result);

    return $row['unhandled_count'];
}

function deleteOrder($id,$conn){
    $sql = "DELETE FROM orders WHERE id = $id";
    $result = mysqli_query($conn, $sql);
}


function getOrders($conn) {
    $orders = array();

    $sql = "SELECT *, orders.id as order_id 
            FROM orders 
            LEFT JOIN users ON users.id = orders.user_id";
            
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $orders[] = $row;
        }
    }

    return $orders;
}


function formatProducts($products){

    // Decode JSON in "products" field
    $decodedProducts = json_decode($products, true);

    // Check if decoding was successful
    if ($decodedProducts === null) {
        return 'Invalid JSON';
    }

    // Format and display products
    $formattedProducts = '';
    foreach ($decodedProducts as $product) {
        $formattedProducts .= "{$product['quantity']} x {$product['name']}<br>";
    }

    return $formattedProducts;
}


function completeOrder($id,$conn){
    $orderID = mysqli_real_escape_string($conn, $id);
    // Build the SQL query to update the is_complete field
    $sql = "UPDATE orders SET is_complete = true WHERE id = '$orderID'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check for errors
    if (!$result) {
        die("Error updating order status: " . mysqli_error($conn));
    }

    // Optionally, you can check if any rows were affected
    $rowsAffected = mysqli_affected_rows($conn);

    if ($rowsAffected > 0) {
        
        echo "Order status updated successfully!";
        return true;
    } else {
        echo "No matching order found with ID $orderID";
        return false;
    }
}


?>
