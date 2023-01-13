<?php
// Load php library
require "membership.php";

// check login credential
if (count($_POST)!=0) {
    $_MEM->verify($_POST["email"], $_POST["password"]);
}

// Redirect signed in users to membership page
if (isset($_SESSIOn["member"])) {
    header("Location: content.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" >
  <link type="text/css" rel="stylesheet" href="styles.css" />
  <title>Login Page</title>
 </head>

 <body>
     <!-- Login Form -->
     <form method="post">
         <h1>LOGIN</h1>

         <label>Email</label>
         <input type="email" name="email" required>

         <label>Password</label>
         <input type="password" name="password" required>

         <input type="submit" value="Register">
     </form>
 </body>

</html>
