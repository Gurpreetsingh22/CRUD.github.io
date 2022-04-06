<?php
$inserted=false;
$update=false;

$delete=false;
// connection  to the database
$servername="localhost";
$username="root";
$password="";
$database="notes";

$con= mysqli_connect($servername,$username,$password,$database);

if(!$con){
  die("sorry we failed to connect:".mysqli_connect_error());

}
if(isset($_GET['delete'])){
  $sno1=$_GET['delete'];
  $delete=true;
  $sql="DELETE FROM `notes` WHERE `notes`.`srno` =$sno1 ";
  $result1=mysqli_query($con,$sql);
  
}


if($_SERVER['REQUEST_METHOD']== "POST"){
  if(isset($_POST['srnoEdit'])){
    // echo"yes";
    $sno=$_POST['srnoEdit'];
    $tittle=$_POST['tittleedit'];
    $description=$_POST['descriptionedit'];
  
    $sql="UPDATE `notes` SET `tittle` = '$tittle',`description` = '$description'   WHERE `notes`.`srno` = '$sno' ";
    $result1=mysqli_query($con,$sql);
    if($result1){
      $update=true;

    }

  }
  else{
   $tittle=$_POST['tittle'];
   $description=$_POST['description'];

    $sql="INSERT INTO `notes` ( `tittle`, `description`) VALUES ('$tittle','$description')";
    $result1=mysqli_query($con,$sql);
     if($result1){
      $inserted=true;
     } 
    else{
      echo"The record not inserted".mysqli_error($con);
    }
  }
}

  

  
?>



<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

  <title>CRUD</title>
</head>
<style>
  body {
    background-image: linear-gradient(rgb(69, 195, 233), rgb(85, 235, 55));
  }

  #tittle,
  #description,
    {
    background-color: rgba(0, 0, 0, 0.644);
    color: whitesmoke;
    font-weight: bold;
  }

  * {
    color: black;
  }
</style>

<body>
  <!--Edit Button trigger modal -->
  <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editmodal">
Edit Modal
</button> -->

  <!-- Edit Modal -->
  <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editmodallabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editmodallabel">Update Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/crud/index.php" method="post">
            <input type="hidden" name="srnoEdit" id="srnoEdit">

            <div class="form-group">
              <label for="exampleInputEmail1">Note Tittle</label>
              <input type="text" class="form-control" id="tittleedit" name="tittleedit" aria-describedby="tittleedit">

            </div>

            <div class="form-group">
              <label for="desc">Note Descriptions</label>
              <textarea class="form-control" id="descriptionedit" name="descriptionedit" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">PHP </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">

        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Dropdown
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
  <?php
    if($inserted){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>SUCCESSFULL!</strong>YOUR RECORD HAS BEEN INSERTED SUCCESSFULLY.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';

    }

    if($update){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>SUCCESSFULL!</strong>YOUR RECORD HAS BEEN UPDATED SUCCESSFULLY.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';

    }

    if($delete){
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>SUCCESSFULL!</strong>YOUR RECORD HAS BEEN deleted SUCCESSFULLY.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';

    }
    
    ?>
  <div class="container  my-4">
    <h2>Add a Note</h2>
    <form action="/crud/index.php" method="post">
      <div class="form-group">
        <label for="exampleInputEmail1">Note Tittle</label>
        <input type="text" class="form-control" name="tittle" id="tittle" aria-describedby="tittle">
        <small id="emailHelp" class="form-text text-muted">note tittle</small>
      </div>

      <div class="form-group">
        <label for="exampleFormControlTextarea1">Note Descriptions</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>

      <button type="submit" class="btn btn-primary">Add Note</button>
    </form>
  </div>
  <div class="container">

    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Sr.no</th>
          <th scope="col">Tittle</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
      $sql1="SELECT * FROM `notes`";
      $result=mysqli_query($con,$sql1);
      $srno=0;
      while($row=mysqli_fetch_assoc($result)){
        $srno+=1;
        echo"<tr>
          <th scope='row'>". $srno ."</th>
          <td>". $row['tittle'] ."</td>
          <td>". $row['description'] ."</td>
          <td> <button class=' edit btn btn-sm btn-primary ' id=".$row['srno'].">Edit</button>
          <button class=' delete btn btn-sm btn-primary ' id=d".$row['srno'].">Delete</button>
        </tr>";
        
      }
      
       
  ?>
      </tbody>
    </table>
    <hr>


  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
    crossorigin="anonymous"></script>

  <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>


  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ",);
        tr = e.target.parentNode.parentNode;
        tittle = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(tittle, description);
        tittleedit.value = tittle;
        descriptionedit.value = description;
        $('#editmodal').modal('toggle');
        srnoEdit.value = e.target.id;
        console.log(e.target.id);
      })
    })


    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {


        sno = e.target.id.substr(1,);
        if (confirm("press a button")) {
          console.log("yes");
          window.location = `/crud/index.php?delete=${sno}`;
        }
        else {
          console.log("no");
        }
      })
    })

  </script>

</body>

</html>