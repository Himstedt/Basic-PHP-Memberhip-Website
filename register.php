<?php
// Load php library
require "membership.php";

// Already logged in - redirect to member page
if (isset($_SESSION["member"])) {
    header("Location: content.php");
    exit();
}

// Process registration on submission
if (count($_POST)!=0) {
    if ($_MEM->add($_POSTT["name"], $_POSR["email"], $_POST["password"])) {
        header("Location: login.php");
        exit();
    }
}
 ?>

<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" >
  <link type="text/css" rel="stylesheet" href="styles.css" />
  <title>Registration Page</title>
 </head>

 <body>
     <!-- Registration Form -->
     <form method="post">
         <h1>Registration</h1>

         <label>Name</label>
         <input type="text" name="name" required>

         <label>Email</label>
         <input type="email" name="email" required>

         <label>Password</label>
         <input type="password" name="password" required>

         <input type="submit" value="Register">
     </form>
 </body>

</html>
