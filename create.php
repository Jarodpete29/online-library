
<?php

require 'Config.php';
if(!isset($_SESSION['admin'])){
    header("location: login.php");
    die();
  }

  

  if(isset($_POST["delete_ann"])){

    $ID = mysqli_real_escape_string($conn,$_POST['delete_ann']);

    $query ="DELETE FROM announcement WHERE ID='$ID'  ";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        $_SESSION['message'] = "Deleted Successfully";
        header("location: AdminAnnouncement.php");
        exit();
    }
    else{
        $_SESSION['message'] = "Delete Failed";
        header("location: AdminAnnouncement.php");
        exit();
    }
}






if(isset($_POST["delete_books"])){

    $ID = mysqli_real_escape_string($conn,$_POST['delete_books']);

    $query ="DELETE FROM books WHERE ID='$ID'  ";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        $_SESSION['message'] = "Deleted Successfully";
        header("location: Adminbooks.php");
        exit();
    }
    else{
        $_SESSION['message'] = "Delete Failed";
        header("location: Adminbooks.php");
        exit();
    }
}


if(isset($_POST["delete_account"])){

  $ID = mysqli_real_escape_string($conn,$_POST['delete_account']);

  $query ="DELETE FROM users WHERE ID='$ID'  ";
  $query_run = mysqli_query($conn, $query);

  if($query_run){
      $_SESSION['message'] = "Deleted Successfully";
      header("location: accounts.php");
      exit();
  }
  else{
      $_SESSION['message'] = "Delete Failed";
      header("location: accounts.php");
      exit();
  }
}





if(isset($_POST["update_books"])){
    $ID = mysqli_real_escape_string($conn,$_POST['ID']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $author = mysqli_real_escape_string($conn,$_POST['author']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);
    $category = mysqli_real_escape_string($conn,$_POST['category']);
    $course= mysqli_real_escape_string($conn,$_POST['course']);
    $year= mysqli_real_escape_string($conn,$_POST['year']);


    
    $query ="UPDATE books SET Title='$title',Author='$author',Description='$description',Category='$category',Course='$course',Year_lvl='$year'  WHERE ID='$ID'";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        $_SESSION['message'] = "Updated Successfully";
        header("location: Adminbooks.php");
        exit();
    }
    else{
        $_SESSION['message'] = "Book not Updated";
        header("location: Adminbooks.php");
        exit();
    }
}



if(isset($_POST["update_accounts"])){
  $ID = mysqli_real_escape_string($conn,$_POST['ID']);
  $Name = mysqli_real_escape_string($conn,$_POST['Name']);
  $Course_Yrlevel = mysqli_real_escape_string($conn,$_POST['Course_Yrlevel']);
  $ID_Number = mysqli_real_escape_string($conn,$_POST['ID_Number']);
  $Email = mysqli_real_escape_string($conn,$_POST['Email']);
  $Password= mysqli_real_escape_string($conn,$_POST['Password']);
  


  
  $query ="UPDATE users SET Name='$Name',Course_Yrlevel='$Course_Yrlevel',ID_Number='$ID_Number',Email='$Email',Password='$Password'  WHERE ID='$ID'";
  $query_run = mysqli_query($conn, $query);

  if($query_run){
      $_SESSION['message'] = "Updated Successfully";
      header("location: accounts.php");
      exit();
  }
  else{
      $_SESSION['message'] = "Account not Updated";
      header("location: accounts.php");
      exit();
  }
}


if(isset($_POST["search_delete"])){
    $ID = mysqli_real_escape_string($conn,$_POST['search_delete']);
     
    $query = "UPDATE books SET archive=0 WHERE ID='$ID'";
    $query_run = mysqli_query($conn, $query);
  
    if($query_run){
        $_SESSION['message'] = "Deleted Successfully";
    }
    else{
        $_SESSION['message'] = "Book not Deleted";
    }

    
    header("location: Adminbooks.php");
    exit();
  }



if(isset($_POST["delete"])){
    $ID = mysqli_real_escape_string($conn,$_POST['delete']);
     
    $query = "UPDATE books SET archive=0 WHERE ID='$ID'";
    $query_run = mysqli_query($conn, $query);
  
    if($query_run){
        $_SESSION['message'] = "Deleted Successfully";
    }
    else{
        $_SESSION['message'] = "Book not Deleted";
    }

    
    header("location: Adminbooks.php");
    exit();
  }



if(isset($_POST["Undo_delete"])){
    $ID = mysqli_real_escape_string($conn,$_POST['Undo_delete']);
    
    $query ="UPDATE books SET archive=1 WHERE ID='$ID'";
    $query_run = mysqli_query($conn, $query);
  
    if($query_run){
        $_SESSION['message'] = "Restored Successfully";
    }
    else{
        $_SESSION['message'] = "Not Restored";
        
    }
    header("location: archive.php");
    exit();
  }

  


  if(isset($_POST["real_delete"])){
    $ID = mysqli_real_escape_string($conn,$_POST['real_delete']);
    
    $query ="DELETE from books WHERE ID='$ID'";
    $query_run = mysqli_query($conn, $query);
  
    if($query_run){
        $_SESSION['message'] = " Permanently Deleted";
    }
    else{
        $_SESSION['message'] = "Delete Failed";
        
    }
    header("location: archive.php");
    exit();
  }






if(isset($_POST["add_books"])){
   
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $author = mysqli_real_escape_string($conn,$_POST['author']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);
    $category = mysqli_real_escape_string($conn,$_POST['category']);
    $course= mysqli_real_escape_string($conn,$_POST['course']);
    $year= mysqli_real_escape_string($conn,$_POST['year']);
    
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png','pdf','xlsx');

    

    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 10000000){
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'Uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                
            }
            else{
                echo "Your file is too big!"; 
            }
        }
        else{
            echo "There was an error uploading your file!"; 
        }
    }
    else{
        echo "Cannot upload files of this type!";
    }
    
    $upload = $_FILES['upload'];
    $fileName = $_FILES['upload']['name'];
    $fileTmpName = $_FILES['upload']['tmp_name'];
    $fileSize = $_FILES['upload']['size'];
    $fileError = $_FILES['upload']['error'];
    $fileType = $_FILES['upload']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png','pdf','xlsx');

    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 10000000000){
                $fileNameNew1 = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'FileUploads/'.$fileNameNew1;
                move_uploaded_file($fileTmpName, $fileDestination);
                
            }
            else{
                echo "Your file is too big!"; 
            }
        }
        else{
            echo "There was an error uploading your file!"; 
        }
    }
    else{
        echo "Cannot upload files of this type!";
    }

    $query ="INSERT INTO books (Title, Author, Description, Category, Course, Year_lvl, img, file) VALUES('$title', '$author','$description','$category','$course','$year','/elibrary/Uploads/$fileNameNew' ,'/elibrary/FileUploads/$fileNameNew1')";
    $query_run = mysqli_query($conn, $query);
      
    if($query_run){
        $_SESSION['message'] = "Added Successfully";
        header("location: addbooks.php");
        exit();
    }
    else{
        $_SESSION['message'] = "Book Not Added";
        header("location: addbooks.php");
        exit();
    }
  }
    
 
    




    if(isset($_POST["add_announcement"])){
   
      $txt = mysqli_real_escape_string($conn,$_POST['txt']);
      
      
  
      $file = $_FILES['picture'];
      $fileName = $_FILES['picture']['name'];
      $fileTmpName = $_FILES['picture']['tmp_name'];
      $fileSize = $_FILES['picture']['size'];
      $fileError = $_FILES['picture']['error'];
      $fileType = $_FILES['picture']['type'];
  
      
      $fileExt = explode('.', $fileName);
      $fileActualExt = strtolower(end($fileExt));
      $allowed = array('jpg', 'jpeg', 'png','pdf','xlsx');
  
      
  
      if(in_array($fileActualExt, $allowed)){
          if($fileError === 0){
              if($fileSize < 10000000000){
                  $fileNameNew = uniqid('', true).".".$fileActualExt;
                  $fileDestination = 'pics-announcement/'.$fileNameNew;
                  move_uploaded_file($fileTmpName, $fileDestination);
                  
              }
              else{
                  echo "Your file is too big!"; 
              }
          }
          else{
              echo "There was an error uploading your file!"; 
          }
      }
      else{
          echo "Cannot upload files of this type!";
      }

      $query ="INSERT INTO announcement (text, picture) VALUES('$txt','/elibrary/pics-announcement/$fileNameNew')";
      $query_run = mysqli_query($conn, $query);
        
      if($query_run){
          $_SESSION['message'] = "Added Successfully";
          header("location: addAnnouncement.php");
          exit();
      }
      else{
          $_SESSION['message'] = "Book Not Added";
          header("location: addAnnouncement.php");
          exit();
      }


      


               
      






}
if(isset($_POST["read"])){

$select = "SELECT * FROM books WHERE ID=".$_POST["read"];
$result = $conn->query($select);
while($row = $result->fetch_object()){
  $pdf = $row->Title;
  $path = $row->file;
  
}
?>

<?php

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="homepage.css">
</head>

<body id="bb">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="bb">
  <div class="container-fluid" id="cc">
    <a class="navbar-brand" href="homepage.php"><img src="logo2.png"><span class="text">IETI</span> E-Library</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="Adminhome.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="Adminbooks.php">Books</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="accounts.php">Accounts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="AdminAnnouncement.php">Announcement</a>
        </li>
        
    
    </div>
  </div>
</nav>

    <object data="<?php echo $path; ?>" type="application/pdf" width="100%" height="800px" >
        <iframe src="<?php echo $path; ?>" width="100%" height="750px"></iframe>
    </object> 

</body>
</html>















    