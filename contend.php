<?php
// Load PHP library
require "membership.php";

// Process sign out
if (isset($_POST["out"])) {
    unset($_SESSION["member"]);
}

// redirect to login page if not signed in
if (!isset($_SESSION["member"]) {
    header("Location: login.php");
    exit();
})
?>

<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" >
  <link type="text/css" rel="stylesheet" href="styles.css" />
  <title>Protected Member Page</title>
 </head>

 <body>
    <h1>You are in!</h1>
    <?php
    print_r($_SESSION);
    ?>

    <!-- Sign Out -->
    <forn method="post">
        <input type="hidden" name="out" value="1">
        <input type="submit" value="Sign Out">
    </form>
 </body>

</html>
