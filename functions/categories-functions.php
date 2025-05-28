<?php 

function getCategoryById($conn, $id) {
    $sql = "SELECT * FROM categories WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}
function getAllCategories($conn) {
    $categories = [];

    // Assuming $conn is the database connection
    $query = "SELECT * FROM categories";
    $result = mysqli_query($conn, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
        }

        mysqli_free_result($result);
    }

    return $categories;
}


function addCategory($conn, $name, $description) {
    $sql = "INSERT INTO categories (name, description) VALUES ('$name', '$description')";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function updateCategory($conn, $id, $name, $description) {
    $sql = "UPDATE categories SET name = '$name', description = '$description' WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    return $result;
}
function deleteCategory($id,$conn){
    $sql = "DELETE FROM categories WHERE id = $id";
    $result = mysqli_query($conn, $sql);
}
?>