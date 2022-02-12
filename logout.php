<?php   
session_start(); //to ensure you are using same session
session_destroy(); //destroy the session
header("Refresh:0;url=index.php"); //to redirect back to "index.php" after logging out
exit();
