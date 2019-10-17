<?php
session_start();
if(! $_SESSION['loggedUser']){
    
    header("Location:index.php");
}
//connect to database
include("includes/connection.php");

//query & result
$query = "SELECT * from clients;";

$result = mysqli_query($conn,$query);

mysqli_close($conn);
include('includes/header.php');
?>

<h1>Client Address Book</h1>
<?php
if($_GET['user'] =="added"){
    echo "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Warning!</strong>  New User Added!
  </div>";
}
elseif($_GET['user'] =="updated"){
    echo "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Warning!</strong> User updated!
  </div>";
}
elseif($_GET['user'] =="deleted"){
    echo "<div class='alert alert-danger alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Warning!</strong> User Deleted!
  </div>";;
}

?>
<table class="table table-striped table-bordered">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Company</th>
        <th>Notes</th>
        <th>Edit</th>
    </tr>
    <?php  
    if(mysqli_num_rows($result) > 0){

    while($data = mysqli_fetch_assoc($result))
    {

    
    
    ?>
    <tr>
        <td><?php echo $data['name']?></td>
        <td><?php echo $data['email']?></td>
        <td><?php echo $data['phone']?></td>
        <td> <?php echo $data['address']?></td>
        <td> <?php echo $data['company']?></td>
        <td><?php echo $data['notes']?></td>
        <td> <?php $id = $data['id']; echo "<a href='edit.php?id=$id'  type='button' class='btn btn-default btn-primary btn-sm'><span class='glyphicon glyphicon-edit'></span></a>"  ?> </td>
    </tr>
  
    <?php  

}
}else{
echo "<div class='alert alert-danger'>You don't Clients  </div> ";
}
mysqli_close($conn);
?>
    <tr>
        <td colspan="7"><div class="text-center"><a href="add.php" type="button" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Add Client</a></div></td>

    </tr>
       
  
</table>

<?php
include('includes/footer.php');
?>