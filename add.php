<?php
session_start();

if(!$_SESSION['loggedUser']){
header("Location:index.php");
}


include("includes/connection.php");
include("includes/functions.php");

//checking add button clicked or not
if(isset($_POST['add'])){
     $userName = validateFormData($_POST['clientName']);
     $userEmail = validateFormData($_POST['clientEmail']);
     $userPhone = validateFormData($_POST['clientPhone']);
     $userAddress = validateFormData($_POST['clientAddress']);
     $userCompany = validateFormData($_POST['clientCompany']);
     $userNotes = validateFormData($_POST['clientNotes']);

     $insert = "INSERT INTO clients(name,email,phone,address,company,notes) VALUES ('$userName','$userEmail','$userPhone','$userAddress','$userCompany','$userNotes');";

     if( mysqli_query($conn,$insert)){
          header("Location:clients.php?user=added");
     }
     else{
         $_SESSION['newUser'] =  "new user not added";
         echo "Error: " . $insert . "<br>" . mysqli_error($conn);
     }
}
 


mysqli_close($conn);

 


include('includes/header.php');
?>

<h1>Add Client</h1>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="row">
    <div class="form-group col-sm-6">
        <label for="client-name">Name *</label>
        <input type="text" class="form-control input-lg" id="client-name" name="clientName" value="" required>
    </div>
    <div class="form-group col-sm-6">
        <label for="client-email">Email *</label>
        <input type="email" class="form-control input-lg" id="client-email" name="clientEmail" value="" required>
    </div>
    <div class="form-group col-sm-6">
        <label for="client-phone">Phone</label>
        <input type="text" class="form-control input-lg" id="client-phone" name="clientPhone" value="">
    </div>
    <div class="form-group col-sm-6">
        <label for="client-address">Address</label>
        <input type="text" class="form-control input-lg" id="client-address" name="clientAddress" value="">
    </div>
    <div class="form-group col-sm-6">
        <label for="client-company">Company</label>
        <input type="text" class="form-control input-lg" id="client-company" name="clientCompany" value="">
    </div>
    <div class="form-group col-sm-6">
        <label for="client-notes">Notes</label>
        <textarea type="text" class="form-control input-lg" id="client-notes" name="clientNotes"></textarea>
    </div>
    <div class="col-sm-12">
            <a href="clients.php" type="button" class="btn btn-lg btn-default">Cancel</a>
            <button type="submit" class="btn btn-lg btn-success pull-right" name="add">Add Client</button>
    </div>
</form>

<?php
include('includes/footer.php');
?>