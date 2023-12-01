
<?php
require 'Config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $data = file_get_contents("php://input");
    $decoded = json_decode($data, TRUE);

        $Email=  mysqli_real_escape_string($conn,$decoded['email']);
        $Password =  mysqli_real_escape_string($conn,$decoded['pwd']);
        $result = mysqli_query($conn, "SELECT * FROM users WHERE Email = '$Email'");
        $row = mysqli_fetch_assoc($result);

        if(mysqli_num_rows($result)>0){

            if($Password == $row["Password"]){
                
                if($row['verified'] == 1){
                    if($row['Account_type'] == 'student'){
                        $_SESSION["user"] = $row['ID'];
                        mysqli_query($conn, "UPDATE visitors SET active_user=active_user+1;");
                        die("homepage.php");
                    }else{
                        $_SESSION["admin"] = $row['ID'];
                        die("Adminhome.php");
                    }
                }else{
                    die("Account not verified");
                }
            }else{
                die("Wrong Password");
            }
        }
        else{
            die("User Not Registered");
        }
}


?>