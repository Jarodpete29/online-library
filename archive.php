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
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="adminbooks.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  </head>

<body>


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
          <a class="nav-link" href="AdminAnnouncement.php">Announcement</a>
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



<!-- table start -->

   
<div class="pinakacontainer">

<div class="container5 container mt-5">

    <nav class="navbar ">
    
        
            <div class="card">
            <div class="card-jeff">
            <input type="text" class="form" id="search4" autocomplete="off" placeholder="Search..." >
            <a href="Adminbooks.php" id="cc" class="btn btn-primary float-end">Back</a>
            
    </form>      
</div>

        


<?php include('message.php')?>
<div class="card-body1">
    <div class="container">

      <div class="table-jeff">  
            <!-- <table class="table table-bordered striped table-hover"> -->

            <div id="searchresult"></div>


            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){

    $("#search4").keyup(function(){
      
      var input = $(this).val();
      //alert(input);

      if(input !=""){
        $.ajax({
          url:"search4.php",
          method:"POST",
          data:{input:input},

          success:function(data){
            $("#searchresult").html(data);
            $("#searchresult").css("display","block");
          }
        })
      }else{
        
          $("#searchresult").css("display","none");
          
      }
    });
  });


    
  
</script>





            <div class="container mt-5">
                
                <div class="row">
                    <div class="col-md-12">
                        
                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th><center>Book Cover</center></th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Course</th>
                            <th>Year Level</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query = "SELECT * FROM books WHERE archive= 0";
                          if(isset($_GET['query'])){
                            $query = "SELECT * FROM books WHERE Title LIKE '%".$_GET['query']."%' OR Author LIKE '%".$_GET['query']."%' OR Description LIKE '%".$_GET['query']."%' OR Category LIKE '%".$_GET['query']."%' OR Course LIKE '%".$_GET['query']."%' OR Year_lvl LIKE '%".$_GET['query']."%'";
                          }
                          
                          $query_run = mysqli_query($conn,$query);

                          if(mysqli_num_rows($query_run)>0){
                            foreach($query_run as $books)
                            {
                              ?>
                              <tr>
                                <td><?= $books['ID']; ?></td>
                                <td class="centers" style="max-width: 150px; "><img class="imahe" src=<?= $books['img']; ?>></td>
                                <td style="max-width: 20vw;  "><?= $books['Title']; ?></td>
                                <td style="max-width: 10vw; "><?= $books['Author']; ?></td>
                                <td style="max-width: 5vw; "><?= $books['Description']; ?></td>
                                <td style="max-width: 10vw; "><?= $books['Category']; ?></td>
                                <td style="max-width: 10vw; "><?= $books['Course']; ?></td>
                                <td><?= $books['Year_lvl']; ?></td>
                                <td class="btn-conts">
                                <form action="create.php" method="POST" class="d-inline">
                                    <button type ="submit" name="Undo_delete" value="<?=$books['ID'];?>" class="btn1 btn-success btn-sm">Restore</a>
                                  </form>
                                  <form action="create.php" method="POST" class="d-inline">
                                    <button type ="submit" name="real_delete" value="<?=$books['ID'];?>" class="btn1 btn-danger btn-sm">Delete</a>
                                  </form>
                                  
                                </td>
                          
                          </tr>
                          <?php
                            }
                          }
                          else{
                            echo "<h5> No Record Found</h5>";
                          }
                          ?>
                        </tbody>
                      </table>
                </div>
              </div>
          </div>


     </div>
   </div>
 </div>
      


 </div>


</body>
</html>