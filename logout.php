<?php 
session_start();

unset ($_SESSION['accountCustomer']);
header('Location: index.php');

?>