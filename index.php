<?php
$insert= false;
$update= false;
$delete= false;
$servername="localhost";
$username="root";
$password="";
$database="notes";
$conn= mysqli_connect($servername,$username,$password,$database);
if (!$conn) {
  die("Sorry we are not able to connect".mysqli_connect_error());
}
if(isset($_GET['delete'])){
  $sno= $_GET['delete'];
  $sql="DELETE FROM `notes` WHERE `notes`.`S.no` = $sno";
  $result= mysqli_query($conn, $sql);
  if($result){
    $delete=true;
  }
  else{
    echo "Not Deleted";
  }
}
if ($_SERVER['REQUEST_METHOD']=='POST') {
    if (isset( $_POST["snoEdit"])){
        $sno = $_POST["snoEdit"];
        $title = $_POST["titleEdit"];
        $description = $_POST["descriptionEdit"];

        $sqli ="UPDATE `notes` SET `Title` = '$title', `Description` = '$description' WHERE `notes`.`S.no` = $sno";
        $result=mysqli_query($conn,$sqli);
        if($result){
          $update = true;
        }
        else{
          echo "We could not update the record successfully";
        }
      }
    else{
    $title=$_POST['title'];
    $desc= $_POST['description'];
    $sql= " INSERT INTO `notes` (`S.no`, `Title`, `Description`, `timeStamp`) VALUES (NULL, '$title', '$desc', current_timestamp());";
    $result=mysqli_query($conn,$sql);
    if($result){
      $insert= true;
    }
    else{
      echo "Record is not added".mysqli_error($result);
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <!-- Jquery script  -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
   

    <title>iNotes</title>
  </head>
  <body>
<!-- Button trigger modal
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Edit Modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="./index.php" method="POST">
      <div class="modal-body">
          <input type="hidden" name="snoEdit" id="snoEdit">
          <!-- <form action="./New_project/index.php" method="POST"> -->
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
             </div>
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div>
          </div>
          
            <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
          </form>
    </div>
  </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">iNotes</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#"
                >Contact Us</a
              >
            </li>
          </ul>
          <form class="d-flex">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
            <button class="btn btn-outline-success" type="submit">
              Search
            </button>
          </form>
        </div>
      </div>
</nav>
    <?php
    if ($insert) {
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success</strong> Your note has been inserted successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    ?>
    <?php
      if ($update) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success</strong> Your note has been updated successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      }
    ?>
    <?php
      if ($delete) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success</strong> Your note has been deleted successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      }
    ?>
    <!-- <?php
      if (!$insert) {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Success</strong> Your note has not been inserted successfully there might be some error.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      }
    ?> -->
    <div class="container my-4">
      <h2>Add a note</h2>
      <form action="./index.php" method="POST">
      <!-- <form action="./New_project/index.php" method="POST"> -->
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Note Title</label>
          <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
         </div>
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">Description</label>
          <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
      
        <button type="submit" class="btn btn-primary">Add Note</button>
      </form>
      </div>
    </div>
    <div class="container">
    <table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.no</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
      $sql= "SELECT * FROM `notes`";
      $result= mysqli_query($conn, $sql);
      $sno=1;
      while($row=mysqli_fetch_assoc($result)){
        echo "
        <tr>
        <th scope='row'>$sno</th>
        <td>".$row['Title']."</td>
        <td>".$row['Description']."</td>
        <td><button type='button' class='btn edit  btn-primary' id=".$row['S.no'].">Edit</button><button type='button' class='btn my-1 mx-2 btn-primary delete' id=d".$row['S.no'].">Delete</button></td>
        </tr>";
        $sno++;
      }
  ?>

    </tbody>
    </table>

    </div>

<script>
  let edits= document.getElementsByClassName('edit');
Array.from(edits).forEach((element)=>{
element.addEventListener('click',(e)=>{
 tr= e.target.parentNode.parentNode;
  title=tr.getElementsByTagName('td')[0].innerText;
  desc=tr.getElementsByTagName('td')[1].innerText;
  descriptionEdit.value=desc;
  titleEdit.value=title;
  snoEdit.value=e.target.id;
  // console.log(title, desc);
 $('#exampleModal').modal('toggle');
  
})
})
let deletes= document.getElementsByClassName('delete');
Array.from(deletes).forEach((element)=>{
  element.addEventListener('click',(e)=>{
    sno=e.target.id.substr(1,);
    // console.log(sno);
    if(confirm("Do you want to delete it.?")){
      window.location=`./index.php?delete=${sno}`;
      /* this is a loop hole in my crud application.. 
      if somebody will go to this url even by mistake
      note will be deleted at that S.no..
      */
    }else{
      window.location=`./index.php`;
    }
  })
})
</script>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>

     <!-- //Data table's script -->
     <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
     $(document).ready( function () {
     $('#myTable').DataTable();
      } );
    </script>
  </body>
</html>
