<?php
session_start();

if(!$_SESSION['loggedUser']){
    header("Location:index.php");
}

$clientId = $_GET['id'];
//include

include("includes/connection.php");
include("includes/functions.php");
 
$query = "SELECT * from clients;";

$result = mysqli_query($conn,$query);
if(mysqli_num_rows($result)>0){
    while($data = mysqli_fetch_assoc($result)){
        $clientName = $data['name'];
        $clientEmail = $data['email'];
        $clientPhone = $data['phone'];
        $clientAddress = $data['address'];
        $clientCompany = $data['company'];
        $clientNotes = $data['notes'];
    }
}
 
 
if( isset ($_POST['update'] ) ){
    //user data
   
    $userName = validateFormData($_POST['clientName']);
    $userEmail = validateFormData($_POST['clientEmail']);
    $userPhone = validateFormData($_POST['clientPhone']);
    $userAddress = validateFormData($_POST['clientAddress']);
    $userCompany = validateFormData($_POST['clientCompany']);
    $userNotes = validateFormData($_POST['clientNotes']);

    //updating data
$update = " UPDATE clients SET 
name='$userName',
 email='$userEmail',
 phone='$userPhone',
 address='$userAddress',
 company='$userCompany',
 notes='$userNotes'
  WHERE id = '$clientId'; ";

if(mysqli_query($conn,$update)){

    header("Location:clients.php?user=updated");
}
else{
    $_SESSION['userUpdated']= "user not updated";
    echo mysqli_error($conn);
}

}

if(isset($_POST['delete'])){

    $del_sql = "DELETE FROM clients where id='$clientId'";
    if(mysqli_query($conn,$del_sql)){
        header("Location:clients.php?user=deleted");
    }
    else{
        header("Location:clients.php?alert=not");

    }
}

include('includes/header.php');
?>

<h1>Edit Client</h1>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>?id=<?php echo $clientId ?>" method="post" class="row">
    <div class="form-group col-sm-6">
        <label for="client-name">Name</label>
        <input type="text" class="form-control input-lg" id="client-name" name="clientName" value="<?php echo $clientName ?>" >
    </div>
    <div class="form-group col-sm-6">
        <label for="client-email">Email</label>
        <input type="text" class="form-control input-lg" id="client-email" name="clientEmail"  value="<?php echo $clientEmail ?>" >
    </div>
    <div class="form-group col-sm-6">
        <label for="client-phone">Phone</label>
        <input type="text" class="form-control input-lg" id="client-phone" name="clientPhone" value="<?php echo $clientPhone ?>"  >
    </div>
    <div class="form-group col-sm-6">
        <label for="client-address">Address</label>
        <input type="text" class="form-control input-lg" id="client-address" name="clientAddress"  value="<?php echo $clientAddress ?>" >
    </div>
    <div class="form-group col-sm-6">
        <label for="client-company">Company</label>
        <input type="text" class="form-control input-lg" id="client-company" name="clientCompany"  value="<?php echo $clientCompany ?>" >
    </div>
    <div class="form-group col-sm-6">
        <label for="client-notes">Notes</label>
        <textarea type="text" class="form-control input-lg" id="client-notes" name="clientNotes" value=""><?php echo $clientNotes ?></textarea>
    </div>
    <div class="col-sm-12">
        <hr>
        <button type="submit" class="btn btn-lg btn-danger pull-left" name="delete">Delete</button>
        <div class="pull-right">
            <a href="clients.php" type="button" class="btn btn-lg btn-default">Cancel</a>
            <button type="submit" class="btn btn-lg btn-success" name="update">Update</button>
        </div>
    </div>
</form>

<?php
include('includes/footer.php');
?>