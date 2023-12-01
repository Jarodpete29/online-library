<?php

require 'Config.php';
if(!isset($_SESSION['admin'])){
  header("location: login.php");
  die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="editbooks.css">
  </head>
<body>

<body>
<div >
  <?php include('message.php')?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="Adminhome.php"><img src="logo2.png"><span class="text">IETI</span> E-Library</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="AdminHome.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="AdminBooks.php">Books</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="accounts.php">Accounts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="AdminAnnouncement.php">Announcement</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Profile
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item"  href=<?= "AdminAbout.php?ID=".$_SESSION["admin"] ?>>About me</a></li>
           
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
        </li>
        
      </ul>
    
    </div>
  </div>
</nav>
<br>
<div class="container mt-5">
    <?php include('message.php'); 
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">
                <h4>EDIT BOOKS
                <a href="Adminbooks.php" class="btn btn-danger float-end">Back</a>
                </h4>
                </div> 
                <div class="card-body">
                  <?php
                  if(isset($_GET['ID'])){
                    $ID = mysqli_real_escape_string($conn, $_GET['ID']);
                    $query = "SELECT * FROM books WHERE ID ='$ID'";
                    $query_run = mysqli_query($conn,$query);

                    if(mysqli_num_rows($query_run)>0){
                      $books = mysqli_fetch_array($query_run);
                      ?>
                   
                  
                
                    <form action="create.php" method ="POST">
                      <input type="hidden" name="ID" value="<?= $ID ?>">
                        <div class="mb-3">
                            <label>Book Title</label>
                            <input type="text" name="title" value="<?=$books['Title'];?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Book Author</label>
                            <input type="text" name="author" value="<?=$books['Author'];?>"  class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <input type="text" name="description" value="<?=$books['Description'];?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Category</label>
                            <input type="text" name="category" value="<?=$books['Category'];?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Course</label>
                            <input type="text" name="course"value="<?=$books['Course'];?>"  class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Year Level</label>
                            <input type="text" name="year" value="<?=$books['Year_lvl'];?>" class="form-control">
                        </div>
                       
                        <div class="mb-3">
                            <center><button type="submit" name="update_books" class="btn btn-primary">Save</button></center>
                        </div>
                    </form>
                    <?php
                    }
                    else{
                      echo "<h4>No Such ID found</h4>";
                    }
                  }
                  ?>
                </div> 
            </div>
                
        </div>
    </div>
</div>