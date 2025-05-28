<?php

function getUsersCount($conn){
    $sql = "SELECT COUNT(*) AS count FROM users";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $row['count'];
}

function getUsers($conn){
    
    $users = array();

    $sql = "SELECT * FROM users;";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
    }
    return $users;
}

function deleteUser($id,$conn){
    $sql = "DELETE FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);
}

?>