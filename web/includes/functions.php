<?php

//function.php

// built in function used:
// trim();
// stripslashes();
// htmlspecialchars();
// strip_tags();
// str_replace();

 function validateFormData($formData)
{
  $userData = trim( stripcslashes( htmlspecialchars( strip_tags( str_replace( array('(',')'),'',$formData  ) ), ENT_QUOTES ) ) );

  return $userData;
}







?>