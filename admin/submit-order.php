<?php
include('../functions/authenticate.php');
isLoggedIn();
isAdmin();
include('../functions/db.php');
$conn = openDatabaseConnection();

$table = $_POST['table'] ?? '';
$cartJson = $_POST['cart'] ?? '';

if (!$table || !$cartJson) {
    die("Invalid order data");
}

$cart = json_decode($cartJson, true);
if (!$cart || !is_array($cart)) {
    die("Invalid cart format");
}

// Reformat cart to match old structure
$formattedCart = [];
$total = 0;

foreach ($cart as $plateId => $item) {
    $formattedCart[$plateId] = [
        "name" => $item['name'],
        "image" => $item['image'],
        "quantity" => $item['qty'],
        "unitPrice" => $item['price']
    ];
    $total += $item['price'] * $item['qty'];
}

// Sanitize inputs
$table = mysqli_real_escape_string($conn, $table);
$productsJson = mysqli_real_escape_string($conn, json_encode($formattedCart));
$total = floatval($total);

// Build query (user_id is NULL for guests)
$sql = "INSERT INTO orders (user_id, table_name, products, total, created_at, is_complete) 
        VALUES (NULL, '$table', '$productsJson', $total, NOW(), 0)";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error submitting order: " . mysqli_error($conn));
}

header("Location: ./orders.php?success=1");
exit;
?>
