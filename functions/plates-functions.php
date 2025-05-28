<?php
function getAllPlates($conn) {
    $plates = [];

    // Assuming $conn is the database connection
    $query = "SELECT plates.*, categories.name AS category_name
        FROM plates
        LEFT JOIN categories ON plates.category_id = categories.id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $plates[] = $row;
        }

        mysqli_free_result($result);
    }

    return $plates;
}

function getPlateById($conn, $id) {
    $sql = "SELECT * FROM plates WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

function getPlatesByCategory($conn, $category_id) {
    $sql = "SELECT * FROM plates WHERE category_id = $category_id";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


function updatePlate($conn, $id, $name, $description, $image, $price, $category_id) {
    $sql = "UPDATE plates SET name = '$name', description = '$description', image = '$image', price = '$price', category_id = '$category_id' WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function getPlatesCount($conn){
    $sql = "SELECT COUNT(*) AS count FROM plates";

    $result = mysqli_query($conn, $sql);

 
    $row = mysqli_fetch_assoc($result);

    mysqli_free_result($result);

    return $row['count'];
}

function deletePlate($id,$conn){
    $sql = "DELETE FROM plates WHERE id = $id";
    $result = mysqli_query($conn, $sql);
}


function addPlate($conn, $name, $description, $image, $price) {
    // Sanitize inputs to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $name);
    $description = mysqli_real_escape_string($conn, $description);
    $image = mysqli_real_escape_string($conn, $image);
    $price = mysqli_real_escape_string($conn, $price);

    // Build the SQL query to insert a new plate
    $sql = "INSERT INTO plates (name, description, image, price) 
            VALUES ('$name', '$description', '$image', '$price')";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check for errors
    if (!$result) {
        // If there is an error, you might want to log or handle it accordingly
        // For now, we'll just return false
        return false;
    }

    // If the query was successful, return true
    return true;
}



function uploadImage($target) {



    $target_dir = $target;
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        //echo "File is not an image.";
        $uploadOk = 0;
    }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
    //echo "Sorry, file already exists.";
    $uploadOk = 0;
    }

    // // Check file size
    // if ($_FILES["fileToUpload"]["size"] > 500000) {
    // //echo "Sorry, your file is too large.";
    // $uploadOk = 0;
    // }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";            
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        return basename($target_file) ;
        //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    } else {
        return null;
        //echo "Sorry, there was an error uploading your file.";
    }
    }
}

?>
