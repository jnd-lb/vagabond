<?php 
    include('./functions/authenticate.php');
    isLoggedIn();   
    include('./functions/db.php');
    $conn = openDatabaseConnection();
?>


<?php 
    include('./includes/header.php')
?>

<section class="container">
    <h1 class=" fw-bold text-danger">Order History</h1>


    <?php

// Replace 8 with the actual user ID you want to fetch orders for
$userId = $_SESSION['user']['user_id'];

// Fetch orders for the given user ID
$sql = "SELECT * FROM orders WHERE user_id = $userId";
$result = mysqli_query($conn, $sql);

// Check if there are rows in the result
if (mysqli_num_rows($result) > 0) {
    echo '<table class="mt-4 table table-bordered table-striped">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Order ID</th>';
    echo '<th>Products</th>';
    echo '<th>Total</th>';
    echo '<th>Created At</th>';
    echo '<th>Is Complete</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';

        // Decode JSON in "products" field
        $decodedProducts = json_decode($row['products'], true);

        // Format and display products
        $formattedProducts = '';
        foreach ($decodedProducts as $productId => $product) {
            $formattedProducts .= "{$product['quantity']} x {$product['name']}<br>";
        }

        echo '<td>' . $formattedProducts . '</td>';
        echo '<td> $' . $row['total'] . '</td>';
        echo '<td>' . $row['created_at'] . '</td>';
        echo '<td>' .  (($row['is_complete']==1)?"Yes":"No") . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo "No orders found for user ID: $userId";
}

// Close the database connection
mysqli_close($conn);

?>
</section>



<?php 
    include('./includes/footer.php')
?>