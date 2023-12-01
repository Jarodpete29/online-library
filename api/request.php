<?php 
    require '../Config.php';

    if($_SERVER['REQUEST_METHOD'] == "GET"){
        $query = mysqli_query($conn, "SELECT * FROM users WHERE verified IS NULL");
        echo json_encode(mysqli_fetch_all($query, MYSQLI_ASSOC));
    }

    if($_SERVER['REQUEST_METHOD'] == "DELETE"){
        $id = $_GET["id"];

        if(mysqli_query($conn, "DELETE FROM users WHERE ID='".$id."'")){
            echo 1;
        }else{
            echo 0;
        }
    }

    if($_SERVER['REQUEST_METHOD'] == "PUT"){
        $id = $_GET["id"];

        if(mysqli_query($conn, "UPDATE users SET verified=1 WHERE ID='".$id."'")){
            echo 1;
        }else{
            echo 0;
        }
    }
?>