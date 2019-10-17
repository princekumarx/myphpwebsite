<?php
 require('../vendor/autoload.php');

//checking submit clicked or not
if(isset($_POST['login'])){
    
   //including validate function
   include("includes/functions.php");

   //user data validating 
   $userEmail = validateFormData($_POST['email']);
   $userPass = validateFormData($_POST['password']);

// query for data
    include("includes/connection.php");
    $checking = "select email , password , name from users where email = '$userEmail';";

//executing query
    $result = mysqli_query($conn,$checking); 
//checking num row greater than 0
  if(mysqli_num_rows($result) > 0){
      //getting data in associative array

      while($data = mysqli_fetch_assoc($result)){
          //getting data from database
          $name = $data['name'];
          $email = $data['email'];
          $hashPass = $data['password'];
          
     //checking password from user and databse
          if(password_verify($userPass,$hashPass)){
              //session storing data
              session_start();
              $_SESSION['loggedname'] = $name;
              $_SESSION['loggedUser'] = TRUE;
              header("Location:clients.php");

           }
          else{
              $loginError = "<div class='alert alert-danger alert-dismissible' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
              <strong>Warning!</strong> password or email id is wrong
            </div>";
          }

      }
  }
  else{
    $loginError =  "<div class='alert alert-danger alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Warning!</strong> No such user found try agian later
  </div>";
  }

}

// else{
// $loginError =  "<div class='alert alert-danger alert-dismissible' role='alert'>
// <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
// <strong>Warning!</strong> Form Not submitted
// </div>";
// }
mysqli_close($conn);

include('includes/header.php');

// $password = password_hash("12345",PASSWORD_DEFAULT);
// echo $password;
?>

<h1>Client Address Book</h1>
<p class="lead">Log in to your account.</p>
<?php echo $GLOBALS['loginError']; ?>

<form class="form-inline" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <div class="form-group">
        <label for="login-email" class="sr-only">Email</label>
        <input type="text" class="form-control" id="login-email" placeholder="email" name="email" value="<?php echo $userEmail;?>" required autofocus >
    </div>
    <div class="form-group">
        <label for="login-password" class="sr-only">Password</label>
        <input type="password" class="form-control" id="login-password" placeholder="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary" name="login">Login</button>
</form>

<?php
include('includes/footer.php');
?>