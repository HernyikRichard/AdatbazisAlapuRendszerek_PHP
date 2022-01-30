<?php
include_once "user/userS.php";
session_unset();
session_destroy();
header("Location: index.php");
?>